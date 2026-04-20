<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cutis', function (Blueprint $table) {
            if (! Schema::hasColumn('cutis', 'status')) {
                $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])
                    ->default('menunggu')
                    ->after('lampiran');
            }

            if (! Schema::hasColumn('cutis', 'catatan_admin')) {
                $table->text('catatan_admin')
                    ->nullable()
                    ->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cutis', function (Blueprint $table) {
            if (Schema::hasColumn('cutis', 'catatan_admin')) {
                $table->dropColumn('catatan_admin');
            }

            if (Schema::hasColumn('cutis', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
