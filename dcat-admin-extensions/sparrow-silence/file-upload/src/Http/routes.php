<?php

use SparrowSilence\FileUpload\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('file-upload', Controllers\FileUploadController::class.'@index');