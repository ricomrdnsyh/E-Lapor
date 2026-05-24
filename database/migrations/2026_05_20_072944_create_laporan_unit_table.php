<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_unit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id');
            $table->unsignedTinyInteger('unit_id');
            $table->timestamps();

            $table->foreign('laporan_id')->references('id_laporan')->on('laporan')->onDelete('cascade');
            $table->foreign('unit_id')->references('id_unit')->on('unit')->onDelete('cascade');
            $table->unique(['laporan_id', 'unit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_unit');
    }
};
