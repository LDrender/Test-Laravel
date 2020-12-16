<?php

use App\Http\Controllers\ClientsController;

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

Route::view('/', 'welcome');
Route::view('contact', 'contact');
Route::view('a-propos', 'a-propos');
Route::get('clients', [ClientsController::class, 'list'])->name('clients.list');
Route::post('clients', [ClientsController::class, 'store'])->name('clients.store');