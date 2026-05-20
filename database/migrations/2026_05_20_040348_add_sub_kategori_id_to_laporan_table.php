<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->unsignedSmallInteger('sub_kategori_id')->nullable()->after('kategori_id');
            $table->foreign('sub_kategori_id')->references('id_sub')->on('sub_kategori')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['sub_kategori_id']);
            $table->dropColumn('sub_kategori_id');
        });
    }
};
