<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->string('status')->default('nieuw')->after('incident_at');
            $table->string('priority')->default('normaal')->after('status');
        });

        DB::table('incidents')->update([
            'status' => DB::raw("COALESCE(status, 'nieuw')"),
            'priority' => DB::raw("COALESCE(priority, 'normaal')"),
        ]);
    }

    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn(['status', 'priority']);
        });
    }
};
