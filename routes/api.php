<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\ActionLogger\Http\Controllers\ActionLog\ExportExcel;
use LaravelEnso\ActionLogger\Http\Controllers\ActionLog\InitTable;
use LaravelEnso\ActionLogger\Http\Controllers\ActionLog\TableData;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/system/actionLogs')
    ->as('system.actionLogs.')
    ->group(function () {
        Route::get('initTable', InitTable::class)->name('initTable');
        Route::get('tableData', TableData::class)->name('tableData');
        Route::get('exportExcel', ExportExcel::class)->name('exportExcel');
    });
