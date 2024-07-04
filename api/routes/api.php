<?php

use App\Http\Controllers\UserCrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/allusers', [UserCrudController::class, 'index']);
Route::post('/addUser', [UserCrudController::class, 'store']);
Route::get('/userById/{id}', [UserCrudController::class, 'show']);
Route::put('/updateUsers/{id}', [UserCrudController::class, 'update']);
Route::delete('/deleteUser/{id}', [UserCrudController::class, 'destroy']);




