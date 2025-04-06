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
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id(); // Laravel otomatis membuat primary key "id"
            $table->foreignId('id_task')->constrained('tasks')->onDelete('cascade'); // Tambahkan id_task
            $table->foreignId('id_tukang')->nullable()->constrained('tukangs')->onDelete('cascade'); // Pastikan nama tabel benar
            $table->string('nama_sub_task');
            $table->date('deadline_sub_task');  
            $table->enum('status_sub_task',['pending','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tasks');
    }
};
