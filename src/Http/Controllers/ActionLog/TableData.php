<?php

namespace LaravelEnso\ActionLogger\Http\Controllers\ActionLog;

use Illuminate\Routing\Controller;
use LaravelEnso\ActionLogger\Tables\Builders\ActionLog;
use LaravelEnso\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected string $tableClass = ActionLog::class;
}
