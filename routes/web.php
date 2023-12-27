<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/agenda', [StudentController::class, 'index'])->middleware('auth')->name('agenda');

Route::get('/show', [StudentController::class, 'create'])->middleware('auth');

Route::get('/event/show/{id}', [StudentController::class, 'show'])->middleware('auth');

Route::get('/agenda/list', [AppointmentController::class, 'index'])->middleware('auth');

Route::post('/store', [AppointmentController::class, 'store'])->middleware('auth');

Route::get('/remove/{id}/{event_id}/{user_id}', [AppointmentController::class, 'destroy'])->middleware('auth');
