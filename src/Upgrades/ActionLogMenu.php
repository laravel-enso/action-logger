<?php

namespace LaravelEnso\ActionLogger\Upgrades;

use LaravelEnso\Menus\Models\Menu;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Upgrade\Contracts\MigratesData;
use LaravelEnso\Upgrade\Contracts\Prioritization;

class ActionLogMenu implements MigratesData, Prioritization
{
    public function isMigrated(): bool
    {
        return Menu::whereName('Action Logs')->exists();
    }

    public function migrateData(): void
    {
        $permission = Permission::whereName('system.actionLogs.index')->firstOrFail();
        $parent = Menu::whereName('System')->firstOrFail();

        Menu::updateOrCreate([
            'name' => 'Action Logs',
        ], [
            'parent_id' => $parent->id,
            'permission_id' => $permission->id,
            'icon' => 'clipboard-list',
            'order_index' => 151,
            'has_children' => false,
        ]);
    }

    public function priority(): int
    {
        return Prioritization::Default;
    }
}
