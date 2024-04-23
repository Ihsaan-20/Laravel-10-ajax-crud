<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\QuestionController;


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
    return view('welcome');
});


Route::get('computers', [ComputerController::class, 'index'])->name('computer.index');
Route::get('computers/fetch', [ComputerController::class, 'fetchComputers'])->name('computers.fetch');
Route::post('computer/store', [ComputerController::class, 'store'])->name('computer.store');
Route::post('computer/edit', [ComputerController::class, 'edit'])->name('computer.edit');
Route::post('computer/destroy', [ComputerController::class, 'destroy'])->name('computer.destroy');


Route::resource('file', FilesController::class);

Route::get('question/index', [QuestionController::class, 'index']);
Route::get('question/search', [QuestionController::class, 'fetch_question'])->name('question.search');