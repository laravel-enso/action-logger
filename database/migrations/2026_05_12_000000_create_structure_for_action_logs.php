<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration {
    protected array $permissions = [
        ['name' => 'system.actionLogs.index', 'description' => 'Show index for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.initTable', 'description' => 'Init table for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.tableData', 'description' => 'Get table data for action logs', 'is_default' => false],
        ['name' => 'system.actionLogs.exportExcel', 'description' => 'Export excel for action logs', 'is_default' => false],
    ];

    protected array $menu = [
        'name' => 'Action Logs', 'icon' => 'clipboard-list', 'route' => 'system.actionLogs.index', 'order_index' => 151, 'has_children' => false,
    ];

    protected ?string $parentMenu = 'System';
};
