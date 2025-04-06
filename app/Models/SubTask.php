<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    protected $fillable = ['id_task', 'nama_sub_task', 'deadline_sub_task', 'id_tukang', 'status_sub_task'];
    public function updateStatus($newStatus)
    {
        $validStatuses = ['pending',  'completed'];
        if (!in_array($newStatus, $validStatuses)) {
            throw new \Exception("Status tidak valid!");
        }

    $this->status_sub_task = $newStatus;
        $this->save();

        // 🔹 Setelah subtask diperbarui, update status task
        $this->task->updateStatus();
    }

    public function tukang(){
        return $this->belongsTo(Tukang::class, 'id_tukang');
    }
    public function task(){
        return $this->belongsTo(Task::class, 'id_task');
    }
    
}
