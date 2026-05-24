<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_kategori', function (Blueprint $table) {
            $table->unsignedTinyInteger('unit_id')->nullable()->after('kategori_id');
            $table->foreign('unit_id')->references('id_unit')->on('unit')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('sub_kategori', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};
