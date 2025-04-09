<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TukangController extends Controller
{
    public function terimaProyek($proyek_id, $tukang_id)
{
    $tukang = \App\Models\Tukang::findOrFail($tukang_id);

    // Auto login sebagai tukang
    Auth::login($tukang); // kalau tukang punya relasi ke model User

    $anggota = \App\Models\Anggota::where('proyek_id', $proyek_id)
        ->where('tukang_id', $tukang_id)
        ->first();

    if ($anggota && $anggota->status !== 'accept') {
        $anggota->status = 'accept';
        $anggota->save();

        return redirect('/dashboard/proyek/')->with('success', 'Proyek berhasil diterima!');
    }

    return redirect('/')->with('error', 'Proyek tidak ditemukan atau sudah diterima.');
}
}
