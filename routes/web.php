<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [MovieController::class, 'index'])->name('main');
//Route::view('/','main')->name('main');

Route::get('/films', function () {
    return view('films');})->name('films');
Route::get('/schedule', [ScheduleController::class,'showSchedule'])->name('schedule');
// Реєстрація
Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register',[RegisterController::class,'register'])->name('register.in');

// Авторизація`
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::get('/movies', [MovieController::class, 'index'])->name('movie');
Route::get('/movie/{movie}', [MovieController::class, 'info'])->name('movie.info');
Route::get('/hall/{session}',[ScheduleController::class,'showMovie'])->name('hall');
Route::post('/tickets',[ScheduleController::class,'showSchedulePost'])->name('tickets')->middleware('auth.check');

Route::get('/tickets',[TicketController::class,'showTickets'])->name('tickets.get');
//route::get('/payment',function (){return view('payment');});

