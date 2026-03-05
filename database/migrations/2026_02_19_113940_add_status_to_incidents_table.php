<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('incidents', 'user_id')) {
            Schema::table('incidents', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();
            });
        }

        if (Schema::hasColumn('incidents', 'user_id')) {
            $firstUserId = DB::table('users')->min('id');
            if ($firstUserId) {
                DB::table('incidents')
                    ->whereNull('user_id')
                    ->update(['user_id' => $firstUserId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('incidents', 'user_id')) {
            Schema::table('incidents', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};
