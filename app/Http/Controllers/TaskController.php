<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PDO;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        $proyeks = Proyek::all();
        return view('dashboard.proyeks.task', compact('tasks','proyeks'));

    }
    public function taskDetail(Task $task){
        return view('dashboard.karyawan.proyeks.task_show',compact('task'));
    }
    public function create(Request $request){
        
        $nama_task = $request->nama_task;
        $deadline_task = $request->deadline_task;
        $id_proyek = $request->id_proyek;
            
        Task::create([
            'nama_task'=>$nama_task,
            'deadline_task'=>$deadline_task,
            'id_proyek'=>$id_proyek,
        
        ]);
    
        return redirect()->back()->with('success_task','Success to create task');
    }
    public function update(Request $request, Task $task){
        $nama_task = $request->nama_task;
        $deadline_task = $request->deadline_task;
        $id_proyek = $request->id_proyek;
        $task->update([
            'nama_task'=>$nama_task,
            'deadline_task'=>$deadline_task,
            'id_proyek'=>$id_proyek,
            ]);
            return redirect()->intended("/dashboard/proyek/task");
            
    }
    public function updateStatus(Request $request){
        $task = Task::findOrFail($request->id_task);
        $status = $request->status_task;
        $task->update([
            'status_task'=>$status,
            
            ]);
            return redirect()->back()->with('success_update_status','Success for updating task status');
            
    }

    public function delete(Task $task){

        $task->delete();
        return redirect()->back()->with('success_delete_task','Success to delete the task');
    }
}
