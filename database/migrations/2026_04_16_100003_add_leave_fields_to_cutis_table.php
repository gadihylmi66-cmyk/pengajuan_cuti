<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->foreignId('jenis_cuti_id')->nullable()->after('id_karyawans')->constrained('jenis_cutis')->nullOnDelete();
            $table->unsignedInteger('jumlah_hari')->default(1)->after('tanggal_keluar');
            $table->string('lampiran')->nullable()->after('jumlah_hari');
        });
    }

    public function down(): void
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jenis_cuti_id');
            $table->dropColumn(['jumlah_hari', 'lampiran']);
        });
    }
};
