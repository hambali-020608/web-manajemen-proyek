<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubTaskController extends Controller
{

    public function create(Request $request){
        if (Auth::guard('karyawans')->check()){
            $id_task = $request->id_task;
            $id_tukang = $request->id_tukang;
            $nama_sub_task = $request->nama_sub_task;
            $deadline_sub_task = $request->deadline_sub_task;
            // dd( $id_task, $id_tukang, $nama_sub_task, $deadline_sub_task);
            SubTask::create([
                'id_task' => $id_task,
                'id_tukang' => $id_tukang,
                'nama_sub_task' => $nama_sub_task,
                'deadline_sub_task' => $deadline_sub_task,
    
            ]);

            return redirect()->back()->with('success_create_subtask','Success to create subtask');
          
        }
        
    }

    public function updateStatus(Request $request){
        // dd($request);
        $id_subtask = $request->id_subtask;
        $is_checked = $request->is_checked == 'on' ? 'completed' : 'pending';
        $subtask = Subtask::findOrFail($id_subtask);
        // dd($id_subtask);
        $subtask->update([
            'status_sub_task'=>$is_checked
            // 'status_sub_task' => 'pending' // Reset status jika perlu
        ]);
        // $subtask->updateStatus($is_checked);
        return redirect()->back()->with('success', 'Subtask berhasil di update');
    }

    
     public function assignTukang(Request $request)
    {
        if(Auth::guard('karyawans')->check()){
            // $validated = $request->validate([
            //     'id_tukang' => 'required|exists:tukangs,id',
            //     'id' => 'required|exists:sub_tasks,id'
            // ]);
            $id_subtask = $request->id_subtask;
            $id_tukang = $request->id_tukang;
            
     $subtask = SubTask::findOrFail($request->id_subtask);
            // Update atau ganti tukang
            $subtask->update([
                'id_tukang' => $id_tukang,
                // 'status_sub_task' => 'pending' // Reset status jika perlu
            ]);

            return back()->with('success', 'Tukang berhasil ditugaskan ke subtask');

        }
        
           
        
    }   
}
