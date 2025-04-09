<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationProyek extends Model
{
    protected $fillable = ['proyek_id','status_confirmation','detail'];
    public function proyek(){
        return $this->belongsTo(Proyek::class,'proyek_id');
    }
}
