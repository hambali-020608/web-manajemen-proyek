<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_klien')->constrained('kliens')->onDelete('cascade');
            $table->string('nama_proyek');
            $table->date('tanggal_mulai');
            $table->date('deadline_proyek');
            $table->enum('status_proyek',['pending','in_progress','done'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
