<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create pivot table kategori_user
        Schema::create('kategori_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('kategori_id');
            $table->unique(['user_id', 'kategori_id']);

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('kategori_id')
                  ->references('id_kategori')->on('kategori')
                  ->onDelete('cascade');
        });

        // 2. Add unit_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('unit_id')->nullable()->after('role');
            $table->foreign('unit_id')
                  ->references('id_unit')->on('unit')
                  ->onDelete('cascade');
        });

        // 3. Migrate existing data: copy kategori_id -> pivot + set unit_id
        $users = DB::table('users')->whereNotNull('kategori_id')->get();
        foreach ($users as $user) {
            $kategori = DB::table('kategori')->where('id_kategori', $user->kategori_id)->first();
            if ($kategori) {
                DB::table('kategori_user')->insert([
                    'user_id'     => $user->id,
                    'kategori_id' => $user->kategori_id,
                ]);
                DB::table('users')->where('id', $user->id)->update([
                    'unit_id' => $kategori->unit_id,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_user');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};
