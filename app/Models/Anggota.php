<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable =['tukang_id','proyek_id','status'];

    public function tukang(){
        return $this->belongsTo(Tukang::class,'tukang_id');
    }
}
