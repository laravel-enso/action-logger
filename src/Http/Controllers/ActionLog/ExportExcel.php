<?php

namespace LaravelEnso\ActionLogger\Http\Controllers\ActionLog;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected string $tableClass = \LaravelEnso\ActionLogger\Tables\Builders\ActionLog::class;
}
