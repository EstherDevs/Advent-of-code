<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('day-1', [AnswerController::class, 'getAnswerDayOne']);

Route::get('day-2', [AnswerController::class, 'getAnswerDayTwo']);

Route::get('day-3', [AnswerController::class, 'getAnswerDayThree']);

Route::get('day-4', [AnswerController::class, 'getAnswerDayFour']);
