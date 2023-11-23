<?php

namespace LaravelEnso\ActionLogger\Dynamics;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;
use LaravelEnso\DynamicMethods\Contracts\Relation;
use LaravelEnso\Users\Models\User;

class ActionLogs implements Relation
{
    public function bindTo(): array
    {
        return [User::class];
    }
    public function name(): string
    {
        return 'actionLogs';
    }

    public function closure(): Closure
    {
        return fn (User $user) => $user->hasMany(ActionLog::class);
    }
}
