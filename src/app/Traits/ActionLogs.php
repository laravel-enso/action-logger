<?php

namespace LaravelEnso\ActionLogger\App\Traits;

use LaravelEnso\ActionLogger\App\Models\ActionLog;

trait ActionLogs
{
    public function actionLogs()
    {
        return $this->hasMany(ActionLog::class);
    }
}
