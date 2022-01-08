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
Route::get('day-5', [AnswerController::class, 'getAnswerDayFive']);

Route::get('day-6', [AnswerController::class, 'getAnswerDaySix']);
Route::get('day-7', [AnswerController::class, 'getAnswerDaySeven']);
Route::get('day-8', [AnswerController::class, 'getAnswerDayEight']);
Route::get('day-9', [AnswerController::class, 'getAnswerDayNine']);
Route::get('day-10', [AnswerController::class, 'getAnswerDayTen']);
Route::get('day-11', [AnswerController::class, 'getAnswerDayEleven']);
Route::get('day-12', [AnswerController::class, 'getAnswerDayTwelve']);
Route::get('day-13', [AnswerController::class, 'getAnswerDayThirteen']);
Route::get('day-14', [AnswerController::class, 'getAnswerDayFourteen']);
Route::get('day-15', [AnswerController::class, 'getAnswerDayFifteen']);
Route::get('day-16', [AnswerController::class, 'getAnswerDaySixteen']);
Route::get('day-17', [AnswerController::class, 'getAnswerDaySeventeen']);
Route::get('day-18', [AnswerController::class, 'getAnswerDayEighteen']);
Route::get('day-19', [AnswerController::class, 'getAnswerDayNineteen']);
Route::get('day-20', [AnswerController::class, 'getAnswerDayTwenty']);
Route::get('day-21', [AnswerController::class, 'getAnswerDayTwentyone']);
Route::get('day-22', [AnswerController::class, 'getAnswerDayTwentytwo']);
Route::get('day-23', [AnswerController::class, 'getAnswerDayTwentythree']);
Route::get('day-24', [AnswerController::class, 'getAnswerDayTwentyfour']);
Route::get('day-25', [AnswerController::class, 'getAnswerDayTwentyfive']);
