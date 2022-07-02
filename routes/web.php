<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ReviewController;

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

Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/swipe/{id}', [SwipeController::class, 'index'])->name('swipe');
Route::get('/friendship', [FriendshipController::class, 'index'])->name('friendship');

Route::name('swipe.')->group(function () {
    Route::post('/swipe/like', [SwipeController::class, 'likeBook'])->name('likeBook');
    Route::post('/swipe/leaveReview', [ReviewController::class, 'leaveReview'])->name('leaveReview');
    Route::post('/swipe/removeBook', [SwipeController::class, 'removeBook'])->name('removeBook');
    Route::post('/swipe/likebookFromLibrary', [SwipeController::class, 'likebookFromLibrary'])->name('likebookFromLibrary');
});
Route::name('friendship.')->group(function () {
    Route::post('/friendship/request', [FriendshipController::class, 'makeRequest'])->name('makeRequest');
    Route::post('/friendship/accept', [FriendshipController::class, 'acceptRequest'])->name('acceptRequest');
    Route::post('/friendship/decline', [FriendshipController::class, 'declineFriendship'])->name('declineFriendship');
});
Route::get('getLoggedUser', [HomeController::class, 'getLoggedUser'])->name('getLoggedUser');
Route::get('dislikeBook',[SwipeController::class, 'dislikeBook'])->name('dislikeBook');
Route::get('getRandomBook',[SwipeController::class, 'getRandomBook'])->name('getRandomBook');



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