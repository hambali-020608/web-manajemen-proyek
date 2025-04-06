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
        Schema::create('obrolans', function (Blueprint $table) {
            $table->id();
            $table->morphs('sender'); // Bisa karyawan, tukang, atau klien
            $table->foreignId('proyek_id')->constrained('proyeks')->onDelete('cascade'); // Tambahkan id_proyek
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obrolans');
    }
};
