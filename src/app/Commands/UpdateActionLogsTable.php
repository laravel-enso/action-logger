<?php

namespace LaravelEnso\ActionLogger\app\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UpdateActionLogsTable extends Command
{
    protected $signature = 'enso:update-action-logs-table';

    protected $description = 'This command will rename the `action` column to `method`';

    public function handle()
    {
        if (!Schema::hasColumn('action_logs', 'action')) {
            $this->info('The `action` column was already renamed.');

            return;
        }

        Schema::table('action_logs', function (Blueprint $table) {
            $table->renameColumn('action', 'method');
        });

        $this->info('The `action` column was successfully renamed to `method`.');
    }
}
