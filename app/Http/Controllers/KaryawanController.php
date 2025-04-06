<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index(){

        $data = Proyek::all();
        return view('dashboard.proyeks',compact('data'));

    }
   
    public function show(Proyek $proyek){
        $proyeks = Proyek::all();
        return view('dashboard.proyeks.show',  ['selectedProject' => $proyek,
        'projects' => $proyeks]);
    }

    public function create(){
        if (Auth::guard('karyawans')->check() && Auth::guard('karyawans')->user()->role == 'superadmin') {
            return view('dashboard.karyawan.create');
        }
    }
    public function store(Request $request){
        if (Auth::guard('karyawans')->check() && Auth::guard('karyawans')->user()->role == 'superadmin') {
            // return view('dashboard.karyawan.create');
            $username = $request->username;
            $email = $request->email;
            $password = $request->password;

            Karyawan::create([
                'name' => $username,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect('/dashboard/create-karyawan')->with('success', 'success membuat karyawan.');

        
        }
    }
}
