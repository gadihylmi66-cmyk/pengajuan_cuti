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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawans')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('id_jabatan')->constrained('jabatans')->onDelete('cascade');
            $table->enum('status', [
                'diterima',
                'ditolak',
                'menunggu'
            ])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
