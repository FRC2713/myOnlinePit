<?php

use App\Http\Livewire\Form;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Form::class);
Route::get('/match/{id}', Form::class)->name('specificmatch');
Route::get('/api/match/{id}', 'App\Http\API@getByMatch');
Route::get('/api/match/{id}/{event}', 'App\Http\API@getByMatch');
Route::get('/api/config', 'App\Http\API@config');
