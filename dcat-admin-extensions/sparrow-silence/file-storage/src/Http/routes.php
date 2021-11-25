<?php

use SparrowSilence\FileStorage\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('file-storage', Controllers\FileStorageController::class.'@index');