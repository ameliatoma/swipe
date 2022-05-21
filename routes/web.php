<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\LibraryController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/swipe', [SwipeController::class, 'index'])->name('swipe');

Route::name('swipe.')->group(function () {
    Route::post('/swipe/like', [SwipeController::class, 'likeBook'])->name('likeBook');
});

// TODO:: Exemplu pagina de dashboard
// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


// TODO:: Exemplu ruta crud
// Route::resource('home', HomeController::class);


// TODO:: Exemplu rute grupate
// Route::name('admin.')->group(function () {
//     Route::get('/books', [HomeController::class, 'index'])->name('books');
//     Route::get('/books/edit/{id}', [HomeController::class, 'edit'])->name('books');
//     Route::get('/books/destroy', [HomeController::class, 'destroy'])->name('books');
// });