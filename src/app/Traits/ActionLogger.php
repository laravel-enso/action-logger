<?php

namespace LaravelEnso\ActionLogger\app\Traits;

trait ActionLogger
{
    public function action_logs()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionLog');
    }
}
