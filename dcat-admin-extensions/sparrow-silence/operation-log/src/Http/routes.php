<?php

use SparrowSilence\OperationLog\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('auth/operation-logs', [Controllers\OperationLogController::class, 'index'])
    ->name('sparrow-silence.operation-log.index');

Route::delete('auth/operation-logs/{id}', [Controllers\OperationLogController::class, 'destroy']
)->name('sparrow-silence.operation-log.destroy');
