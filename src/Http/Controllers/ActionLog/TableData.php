<?php

namespace LaravelEnso\ActionLogger\Http\Controllers\ActionLog;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected string $tableClass = \LaravelEnso\ActionLogger\Tables\Builders\ActionLog::class;
}
