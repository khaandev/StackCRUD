<?php

use App\Http\Controllers\UserCrudController;
use App\Models\UserCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
