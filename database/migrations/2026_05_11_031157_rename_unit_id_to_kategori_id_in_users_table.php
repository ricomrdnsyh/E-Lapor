<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Drop the old foreign key (detect actual FK name from DB)
        $fkName = $this->getForeignKeyName('users', 'unit_id');

        if ($fkName) {
            Schema::table('users', function (Blueprint $table) use ($fkName) {
                $table->dropForeign($fkName);
            });
        }

        // Step 2: Rename column
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('unit_id', 'kategori_id');
        });

        // Step 3: Null out old unit_id values (they don't match kategori.id_kategori)
        DB::table('users')->update(['kategori_id' => null]);

        // Step 4: Add new foreign key
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('kategori_id')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('kategori_id', 'unit_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('unit_id')
                  ->references('id_unit')
                  ->on('unit')
                  ->onDelete('cascade');
        });
    }

    /**
     * Get the actual foreign key constraint name from the database.
     */
    private function getForeignKeyName(string $table, string $column): ?string
    {
        $database = config('database.connections.mysql.database');

        $result = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ?
              AND TABLE_NAME = ?
              AND COLUMN_NAME = ?
              AND REFERENCED_TABLE_NAME IS NOT NULL
            LIMIT 1
        ", [$database, $table, $column]);

        return $result?->CONSTRAINT_NAME;
    }
};
