<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Klien extends Authenticatable

{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password'
      
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function sentMessages() {
        return $this->morphMany(Obrolan::class, 'sender');
    }
    
    public function receivedMessages() {
        return $this->morphMany(Obrolan::class, 'receiver');
    }

    // proyek
    public function proyek() {
        return $this->hasMany(Proyek::class,'id_klien');
    }
   
}

