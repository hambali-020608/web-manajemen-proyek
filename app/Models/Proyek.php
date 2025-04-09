<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyek extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_tukang',
        'id_klien',
        'id_task',
        'nama_proyek',
        'tanggal_mulai',
        'deadline_proyek',
        'status_proyek'
        
    ];

    public function klien():BelongsTo{
        return $this->BelongsTo(Klien::class,'id_klien');
    }
    
    public function task():HasMany{
        return $this->hasMany(Task::class,'id_proyek');
    }
    public function uniqueTukangs()
{
    return $this->hasManyThrough(
        Tukang::class,
        SubTask::class,
        'id_task', // Foreign key pada subtask
        'id', // Foreign key pada tukang
        'id', // Local key pada project
        'id_tukang' // Local key pada task
    )->distinct();
}
public function messages()
{
    return $this->hasMany(Obrolan::class);
}
public function testProject(){
    return $this->hasMany(TestProject::class,'proyek_id');
}
public function confirmation_proyek(){
    return $this->hasOne(ConfirmationProyek::class,'proyek_id');
}
public function anggota(){
    return $this->hasMany(Anggota::class,'proyek_id');
}    


}
