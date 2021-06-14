<?php

use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=> 'auth'], function(){
    Route::group(['prefix' => 'admin', 'as'=> 'admin.'],function(){
         Route::resource('pages', PageController::class);
         Route::resource('departments', DepartmentController::class);
         Route::resource('services', ServiceController::class);
         Route::resource('counters', CounterController::class);
         Route::resource('users', UserController::class);
         Route::resource('queues', QueueController::class);
    });
});