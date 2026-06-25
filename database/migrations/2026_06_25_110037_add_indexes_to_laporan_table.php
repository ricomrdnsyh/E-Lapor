<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->index('status');
            $table->index('kategori_id');
            $table->index('sub_kategori_id');
            $table->index('created_at');
            $table->index('tgl_kejadian');
        });
    }


    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['kategori_id']);
            $table->dropIndex(['sub_kategori_id']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['tgl_kejadian']);
        });
    }
};
