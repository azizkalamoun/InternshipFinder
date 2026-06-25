<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', [StaticController::class, 'index'])->name('index');
Route::get('/societes', [StaticController::class, 'societes'])->name('societes');
Route::get('/guide_rapport', [StaticController::class, 'guide_rapport'])->name('guide_rapport');
Route::get('/a_propos', [StaticController::class, 'a_propos'])->name('a_propos');
