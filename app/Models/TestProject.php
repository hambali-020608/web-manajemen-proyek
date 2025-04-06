<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestProject extends Model
{
    protected $fillable= ['proyek_id','quality_id','is_checked'];

    public function quality(){
        return $this->belongsTo(Quality::class,'quality_id');

    }
    
}
