<?php

namespace LaravelEnso\ActionLogger\DynamicRelations;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;
use LaravelEnso\DynamicMethods\Contracts\Method;

class ActionLogs implements Method
{
    public function name(): string
    {
        return 'actionLogs';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(ActionLog::class);
    }
}
