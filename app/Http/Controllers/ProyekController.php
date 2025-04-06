<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Obrolan;
use App\Models\Proyek;
use App\Models\TestProject;
use App\Models\Tukang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $nama_proyek = $request->nama_proyek;
        $tanggal_mulai=$request->tanggal_mulai;
        $deadline_proyek= $request->deadline_proyek;
        $status_proyek = "pending";
        $id_klien = $request->id_klien;

        Proyek::create([
            'nama_proyek' => $nama_proyek,
            'tanggal_mulai' => $tanggal_mulai,
            'deadline_proyek' => $deadline_proyek,
            'status_proyek' => $status_proyek,
            'id_klien' => $id_klien
        ]);

        return redirect()->intended('/dashboard/proyek/overview/1');


        
    }
    public function show(Proyek $project){
       
        return view('dashboard.karyawan.proyeks.detail',compact('project'));

        
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
        
        
        return redirect()->intended('/dashboard/proyek/overview/');


        
    }

    public function delete(Request $request, Proyek $proyek){
        $proyek->delete();
        return redirect()->intended('/dashboard/proyek/overview/');

    }

    public function createView(){
        $kliens = Klien::all();
        return view('dashboard.karyawan.proyeks.create',compact('kliens'));
    }

    public function getObrolansByProyek(Proyek $proyek){
        if(Auth::guard('karyawans')->check()){
            $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.karyawan.obrolans.index',compact('obrolans','projects','proyek'));
        

        }
        if(Auth::guard('tukangs')->check()){
            // $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.tukang.obrolans.index',compact('obrolans','proyek'));
        

        }
        if(Auth::guard('kliens')->check()){
            // $projects = Proyek::all();
            $obrolans = $proyek->messages()->get();
            return view('dashboard.klien.obrolans.index',compact('obrolans'));
        

        }
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
        $proyeks = Proyek::all();
        // $check_done = $proyeks->testProject()->where('is_checked',true)->count();
        return view('dashboard.karyawan.testing.index',compact('proyeks'));
    }

    public function testProyekShow(Proyek $proyek){
        $proyeks = Proyek::all();
        $check_done = $proyek->testProject()->where('is_checked',true)->count();
        $check_undone = $proyek->testProject()->where('is_checked',false)->count();

        return view('dashboard.karyawan.testing.show',compact('proyek','check_done','check_undone','proyeks'));
    }

    public function CheckQuality(Request $request){
        $id_test = $request->id_test;
        $is_checked = $request->is_checked == 'on' ? true : false;
        // dd( $id_test,$is_checked);
        
        $TestProyek = TestProject::findOrFail($id_test);

            // Update atau ganti tukang
            $TestProyek->update([
                'is_checked'=>$is_checked
                // 'status_sub_task' => 'pending' // Reset status jika perlu
            ]);

            return back()->with('success', 'Tukang berhasil ditugaskan ke subtask');



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
}

