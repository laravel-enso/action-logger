<?php

namespace LaravelEnso\ActionLogger\app\Traits;

trait ActionLogger
{
    public function actionLogs()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionLog');
    }
}
