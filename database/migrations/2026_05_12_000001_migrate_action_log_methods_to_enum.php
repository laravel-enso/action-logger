<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::getColumnType('action_logs', 'method') !== 'varchar') {
            return;
        }

        Schema::table('action_logs', function (Blueprint $table) {
            $table->unsignedTinyInteger('method_int')->nullable()->after('method');
        });

        DB::table('action_logs')->update([
            'method_int' => DB::raw("CASE UPPER(method)
                WHEN 'GET' THEN 1
                WHEN 'POST' THEN 2
                WHEN 'PUT' THEN 3
                WHEN 'PATCH' THEN 4
                WHEN 'DELETE' THEN 5
                WHEN 'OPTIONS' THEN 6
                WHEN 'HEAD' THEN 7
                ELSE NULL
            END"),
        ]);

        DB::table('action_logs')->whereNull('method_int')->update(['method_int' => 1]);

        Schema::table('action_logs', function (Blueprint $table) {
            $table->dropColumn('method');
        });

        Schema::table('action_logs', function (Blueprint $table) {
            $table->renameColumn('method_int', 'method');
        });

        Schema::table('action_logs', function (Blueprint $table) {
            $table->unsignedTinyInteger('method')->nullable(false)->change();
            $table->index('method');
            $table->index(['user_id', 'created_at']);
            $table->index(['method', 'created_at']);
        });
    }

    public function down(): void
    {
        if (Schema::getColumnType('action_logs', 'method') === 'varchar') {
            return;
        }

        Schema::table('action_logs', function (Blueprint $table) {
            $table->string('method_string')->nullable()->after('method');
        });

        DB::table('action_logs')->update([
            'method_string' => DB::raw("CASE method
                WHEN 1 THEN 'GET'
                WHEN 2 THEN 'POST'
                WHEN 3 THEN 'PUT'
                WHEN 4 THEN 'PATCH'
                WHEN 5 THEN 'DELETE'
                WHEN 6 THEN 'OPTIONS'
                WHEN 7 THEN 'HEAD'
                ELSE 'GET'
            END"),
        ]);

        Schema::table('action_logs', function (Blueprint $table) {
            $table->dropIndex(['method']);
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['method', 'created_at']);
            $table->dropColumn('method');
        });

        Schema::table('action_logs', function (Blueprint $table) {
            $table->renameColumn('method_string', 'method');
        });
    }
};
