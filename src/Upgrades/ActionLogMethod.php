<?php

namespace LaravelEnso\ActionLogger\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Column;

class ActionLogMethod implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Schema::hasTable('action_logs')
            && Schema::hasColumn('action_logs', 'method')
            && ! Column::isString('action_logs', 'method');
    }

    public function migrateTable(): void
    {
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
}
