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
    public function create(Request $request){
        
        $nama_task = $request->nama_task;
        $deadline_task = $request->deadline_task;
        $id_proyek = $request->id_proyek;
            
        Task::create([
            'nama_task'=>$nama_task,
            'deadline_task'=>$deadline_task,
            'id_proyek'=>$id_proyek,
        
        ]);
        return redirect()->intended("/dashboard/proyek/task/$id_proyek");
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
}
