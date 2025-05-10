<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('registros.index');;
})->middleware(['auth', 'verified'])->name('home');

Route::get('simulation-port', function () {
    return view('pages.porta.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('registros', RegistroController::class);
    Route::get('registro/getRegister', [RegistroController::class, 'getRegister']);
    Route::get('registro/getRegisterNotUserPermission', [RegistroController::class, 'getRegisterNotUserPermission']);
    Route::resource('usuarios', UserController::class);
});

require __DIR__ . '/auth.php';
