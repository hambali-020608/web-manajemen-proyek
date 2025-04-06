<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_tukang',
        'id_proyek',
        'nama_task',
        'deadline_task',
        'status_task'
    ];

    public function tukang(){

    }
    
    public function proyek(){
        return $this->belongsTo(Proyek::class, 'id_proyek');
    }
    public function sub_task(){
        return $this->hasMany(SubTask::class, 'id_task');
    }
}
