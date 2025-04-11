<?php

namespace App\Http\Controllers;

use App\Mail\TukangNotifikasi;
use App\Models\Anggota;
use App\Models\ConfirmationProyek;
use App\Models\Klien;
use App\Models\Obrolan;
use App\Models\Proyek;
use App\Models\Quality;
use App\Models\TestProject;
use App\Models\Tukang;
use Database\Seeders\ProyekSeeder;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProyekController extends Controller
{
    public function index(){
        if(Auth::guard('karyawans')->check()){
            $proyeks = Proyek::all();
            $kliens = Klien::all();
            return view('dashboard.karyawan.proyeks.index',compact('proyeks','kliens'));

        }
        if(Auth::guard('tukangs')->check()){
            $user = Auth::guard('tukangs')->user();
            $tasks = $user->subTask->map(function($subtask){
                return $subtask->task;
            });
            return view('dashboard.tukang.proyeks.index',compact('tasks'));

        }
    }

    public function store(Request $request){
        
        $tukangIds = $request->input('tukang_id', []);
        
        
        $nama_proyek = $request->nama_proyek;
        $tanggal_mulai=$request->tanggal_mulai;
        $deadline_proyek= $request->deadline_proyek;
        $status_proyek = "pending";
        $id_klien = $request->id_klien;

       $proyek =  Proyek::create([
            'nama_proyek' => $nama_proyek,
            'tanggal_mulai' => $tanggal_mulai,
            'deadline_proyek' => $deadline_proyek,
            'status_proyek' => $status_proyek,
            'id_klien' => $id_klien
        ]);
        foreach($tukangIds as $tukangid){
            $tukang = Tukang::find($tukangid);
            Anggota::create([
                'tukang_id' => $tukangid,
                'proyek_id' => $proyek->id,
                'status' => 'pending',
            ]);
            // Mail::to($tukang->email)->send(new TukangNotifikasi($proyek, $tukang));
        }

        return redirect()->intended('/dashboard/proyek/overview/'.$proyek->id)->with('success','success to create a proyek');


        
    }
    public function show(Proyek $project){
        $proyeks= Proyek::all();
       
        return view('dashboard.karyawan.proyeks.detail',compact('project','proyeks'));

        
    }

    public function update( Request $request , Proyek $proyek){
        // $id_proyek = $request->id_proyek;
        $nama_proyek = $request->nama_proyek;
        // $tanggal_mulai = $request->tanggal_mulai;
        $deadline_proyek = $request->deadline_proyek;
        // $status_proyek = $request->status_proyek;
        $id_klien = $request->id_klien;
        // dd($tanggal);
        // $proyek = Proyek::findOrFail($id_proyek);
        $proyek->update([
            'nama_proyek' => $nama_proyek,
            // 'tanggal_mulai' => $tanggal_mulai,
            'deadline_proyek' => $deadline_proyek,
            // 'status_proyek' => $status_proyek,
            'id_klien' => $id_klien
            
        ]);
        
        
        return redirect()->back()->with('success_edit','Success to edit projects');


        
    }

    public function delete(Proyek $proyek){
        $proyek->delete();
        return redirect()->back()->with('success_delete','Success to delete the project');

    }

    public function createView(){
        $kliens = Klien::all();
        $tukangs = Tukang::all();
        return view('dashboard.karyawan.proyeks.create',compact('kliens','tukangs'));
    }

    public function getObrolansByProyek(Proyek $proyek){
        
        if(Auth::guard('karyawans')->check()){
            $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.karyawan.obrolans.show',compact('obrolans','projects','proyek'));
        

        }

    
        if(Auth::guard('tukangs')->check()){
            // $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.tukang.obrolans.show',compact('obrolans','proyek'));
        

        }
        if(Auth::guard('kliens')->check()){
            // $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.klien.obrolans.',compact('obrolans'));
        

        }
        
    }
public function obrolanIndex(){
    $projects = Proyek::all();
    return view('dashboard.karyawan.obrolans.index',compact('projects'));
}
    public function handOverShow(Proyek $proyek){
        $proyeks = Proyek::all();
        return view('dashboard.karyawan.handover.show',compact('proyek','proyeks'));


    }
    public function handOverIndex(){
        $proyeks = Proyek::all();
        return view('dashboard.karyawan.handover.index',compact('proyeks'));


    }
    public function testProyek(){
        $qualities = Quality::all();
        $proyeks = Proyek::all();
        // $check_done = $proyeks->testProject()->where('is_checked',true)->count();
        return view('dashboard.karyawan.testing.index',compact('proyeks','qualities'));
    }
    
    public function testProyekShow(Proyek $proyek){
        $proyeks = Proyek::all();
        $qualities = Quality::all();
        $check_done = $proyek->testProject()->where('is_checked',true)->count();
        $check_undone = $proyek->testProject()->where('is_checked',false)->count();

        return view('dashboard.karyawan.testing.show',compact('proyek','check_done','check_undone','proyeks','qualities'));
    }

    public function CheckQuality(Request $request){
        $tests = $request->tests;
        foreach ($tests as $test) {
            $id_test = $test['id'];
            $is_checked = isset($test['is_checked']) && $test['is_checked'] == 'on';
    
            $TestProyek = TestProject::findOrFail($id_test);
    
            $TestProyek->update([
                'is_checked' => $is_checked
            ]);
        }
    
        return back()->with('success_check', 'Tugas berhasil di checklist');    
        }
        
        public function storeChat(Request $request){
            if(Auth::guard('karyawans')->check()){
            $user = Auth::guard('karyawans')->user();
            $proyek_id = $request->proyek_id;
            $message = $request->message;
            // dd($proyek_id);
    
            Obrolan::create([
                'sender_id'=>$user->id,
                'proyek_id'=>$proyek_id,
                'message'=>$message,
                'sender_type'=>get_class($user)
            ]);
        }
        if(Auth::guard('tukangs')->check()){
            $user = Auth::guard('tukangs')->user();
            $proyek_id = $request->proyek_id;
            $message = $request->message;
            // dd($proyek_id);
    
            Obrolan::create([
                'sender_id'=>$user->id,
                'proyek_id'=>$proyek_id,
                'message'=>$message,
                'sender_type'=>get_class($user)
            ]);

        }
        if(Auth::guard('kliens')->check()){
            $user = Auth::guard('kliens')->user();
            $proyek_id = $request->proyek_id;
            $message = $request->message;
            // dd($proyek_id);
    
            Obrolan::create([
                'sender_id'=>$user->id,
                'proyek_id'=>$proyek_id,
                'message'=>$message,
                'sender_type'=>get_class($user)
            ]);

        }
      

        return redirect()->back();
    }
    public function confirmationProyeks(Request $request)
{
    $request->validate([
        'proyek_id' => 'required|exists:proyeks,id',
        'status_confirmation' => 'required|in:accepted,rejected', // Sesuaikan dengan nilai yang diizinkan
        'detail' => 'nullable|string'
    ]);

    // $proyek = Proyek::findOrFail($request->proyek_id);

    // Gunakan updateOrCreate untuk one-to-one relationship
    $confirmation = ConfirmationProyek::updateOrCreate(
        ['proyek_id' => $request->proyek_id],
        [
            'status_confirmation' => $request->status_confirmation,
            'detail' => $request->detail
        ]
    );

    return redirect()->back()->with('success', 'Status proyek berhasil diperbarui');
}

public function addTestProyek( Request $request){
    TestProject::create([
        'proyek_id'=>$request->proyek_id,
        'quality_id'=>$request->quality_id,
        
    ]);

    return redirect()->back()->with('success','Success to add the test');



    


}

public function StoreQuality(Request $request){
Quality::create([
    'quality_name'=>$request->quality_name
]);
return redirect()->back()->with('success_quality','Success to create a quality');
}

}

