<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obrolan extends Model
{
    use HasFactory;
    protected $fillable = ['sender_type','sender_id','proyek_id','message'];

    public function sender()
    {
        return $this->morphTo();
    }
}
