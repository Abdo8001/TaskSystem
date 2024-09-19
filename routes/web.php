<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::resource('tasks', TasksController::class)->middleware(['auth:manger']);
Route::post('task_search',[TasksController::class,'taskSearch'])->name('task.search');
Route::patch('task/user',[TasksController::class,'taskUser'])->name('task.user')->middleware('auth');
Route::get('download_photo/{id}/{filename}', [TasksController::class,'dawnloadTask'])->name('download');
Route::resource('comments', CommentController::class);
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('selection', [AuthenticatedSessionController::class,'selection'])->name('selection');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

require __DIR__.'/auth.php';
