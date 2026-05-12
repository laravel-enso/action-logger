<?php

namespace LaravelEnso\ActionLogger\Http\Controllers\ActionLog;

use Illuminate\Routing\Controller;
use LaravelEnso\ActionLogger\Tables\Builders\ActionLog;
use LaravelEnso\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = ActionLog::class;
}
