<?php

namespace LaravelEnso\ActionLogger\Http\Controllers\ActionLog;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = \LaravelEnso\ActionLogger\Tables\Builders\ActionLog::class;
}
