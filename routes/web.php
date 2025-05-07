<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('despesas.index');;
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('despesas/getExpenseByCod', [ExpenseController::class, 'getExpenseByCod']);
    Route::get('despesas/getValues', [ExpenseController::class, 'getValues']);
    Route::get('despesas/createDataTable', [ExpenseController::class, 'createDataTable']);
    // Route::delete('despesas/{cod}/destroy', [ExpenseController::class, 'destroy']);
    Route::resource('despesas', ExpenseController::class);
});

require __DIR__ . '/auth.php';
