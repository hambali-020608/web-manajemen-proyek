<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Proyek;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\Tukang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }
    public function logout(Request $request)
    {
        // Logout dari semua guard
        Auth::guard('tukangs')->logout();
        Auth::guard('karyawans')->logout();
        Auth::guard('kliens')->logout();

        // Hapus sesi user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau home
        return redirect('/')->with('success', 'Anda telah logout.');
    }
    public function auth(Request $request)
    { 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Coba login dari berbagai tabel
        if (Auth::guard('tukangs')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        if (Auth::guard('karyawans')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        if (Auth::guard('kliens')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    
    }
    public function dashboardView()
{ 

    $done_proyeks = Proyek::where('status_proyek','done')->count();
    $done_tasks = Task::where('status_task','done')->count();
    $new_tasks_count = Task::where('status_task','todo')->count();
    $tasks = Task::all();
    $done_sub_tasks = SubTask::where('status_sub_task','completed')->count();
    
        if (Auth::guard('tukangs')->check()) {
            return view('dashboard.tukang.index');
        }
        if (Auth::guard('karyawans')->check()) {
            return view('dashboard.karyawan.index',compact('done_proyeks','done_tasks','done_sub_tasks','tasks','new_tasks_count'));
        }
        if (Auth::guard('kliens')->check()) {
            return view('dashboard.klien.index');
        }
    
        return redirect('/')->withErrors(['message' => 'Anda belum login']);
    }
    public function index(){

        $data = Proyek::all();
        return view('dashboard.proyeks',compact('data'));

    }
   
    public function ProyekShow(Proyek $proyek){
        $kliens = Klien::all();
        if (Auth::guard('karyawans')->check()) {
            $proyeks = Proyek::all();
            $availableTukangs=Tukang::all();
            $null_tukangs = SubTask::whereNull('id_tukang')->get();

        return view('dashboard.karyawan.proyeks.show',  ['selectedProject' => $proyek,
        'projects' => $proyeks,'tukangs'=>$null_tukangs,'availableTukangs'=>$availableTukangs,'kliens'=>$kliens]);
        }
        
        if (Auth::guard('kliens')->check()) {
            return view('dashboard.klien.proyeks.show', ['selectedProject' => $proyek]);

        }

        if (Auth::guard('tukangs')->check()) {
            $user = Auth::guard('tukangs')->user();
            $proyeks = $user->subTask->map(function($subtask){
                return $subtask->task->proyek;
            })->unique();

            return view('dashboard.tukang.proyeks.show', ['selectedProject' => $proyek,'proyeks'=>$proyeks]);

        }

    }  
    
    

    public function TaskShow(Proyek $proyek){
    if(Auth::guard('karyawans')->check()){
            $tasks = Task::all();
            $proyeks = Proyek::all();
            $tukangs = Tukang::all();
            return view('dashboard.karyawan.proyeks.task_show', compact('tasks','proyeks','tukangs','proyek'));
    
        }
    if(Auth::guard('tukangs')->check()){
            // $tasks = Task::all();
            $user = Auth::guard('tukangs')->user();
            $subtasks = $user->subTask();
            $tasks = $subtasks
            ->with(['task' => function($query) use ($proyek) {
                $query->where('id_proyek', $proyek->id);
            }])
            ->get()
            ->pluck('task')
            ->filter()
            ->unique();

            // dd($tasks);

            $tukangs = Tukang::all();
        // Jika ingin mengambil proyek terkait tasks
        $proyeks = $tasks->map->proyek->unique();
        
        return view('dashboard.tukang.proyeks.task_show', compact('proyek','proyeks','tukangs','tasks'));
    
        }
    
    }
    public function TaskIndex(){
    if(Auth::guard('karyawans')->check()){
        $tukangs = Tukang::all();
        $tasks = Task::all();
        $proyeks = Proyek::all();
        // dd($proyeks);

            return view('dashboard.karyawan.proyeks.task_index', compact('tasks','proyeks','tukangs'));
    
        }
    if(Auth::guard('tukangs')->check()){
            $user = Auth::guard('tukangs')->user();
            $tasks = $user->subTask->map(function($subtask){
                return $subtask->task;
            })->unique();
            $proyeks = $tasks->map(function($task){
                return $task->proyek;
            })->unique();
            // dd($proyeks);

            $tukangs = Tukang::all();
            
            return view('dashboard.tukang.proyeks.task_index', compact('tasks','proyeks','tukangs'));
    
        }
    }
    public function TaskKanbanView(){
    $proyeks=Proyek::all();

    if(Auth::guard('karyawans')->check()){
            $tasks_todo = Task::where('status_task','todo')->get();
            $tasks_progress = Task::where('status_task','in_progress')->get();
            $tasks_done = Task::where('status_task','done')->get();
            return view('dashboard.karyawan.tasks.index', compact('tasks_todo','tasks_progress','tasks_done','proyeks'));
    
        }
    }
    public function TaskKanbanShow(Proyek $proyek){
    $proyeks=Proyek::all();

    if(Auth::guard('karyawans')->check()){
            $tasks_todo = $proyek->task->where('status_task','todo');
            $tasks_progress = $proyek->task->where('status_task','in_progress');
            $tasks_done = $proyek->task->where('status_task','done');
            return view('dashboard.karyawan.tasks.show', compact('tasks_todo','tasks_progress','tasks_done','proyeks','proyek'));
    
        }
    }


}
