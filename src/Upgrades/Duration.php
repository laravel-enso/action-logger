<?php

namespace LaravelEnso\ActionLogger\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class Duration implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('action_logs', 'duration');
    }

    public function migrateTable(): void
    {
        Schema::table('action_logs', function (Blueprint $table) {
            $table->unsignedDecimal('duration', 6, 3)->nullable()->index();
        });
    }
}
