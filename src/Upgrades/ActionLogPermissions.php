<?php

namespace LaravelEnso\ActionLogger\Upgrades;

use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Contracts\Prioritization;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class ActionLogPermissions implements MigratesStructure, Prioritization
{
    use StructureMigration;

    protected array $permissions = [
        ['name' => 'system.actionLogs.index', 'description' => 'Show index for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.initTable', 'description' => 'Init table for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.tableData', 'description' => 'Get table data for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.exportExcel', 'description' => 'Export excel for action logs', 'is_default' => false],
    ];

    protected array $roles = ['admin'];

    public function priority(): int
    {
        return Prioritization::Default - 1;
    }
}
