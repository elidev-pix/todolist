<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/todos', TodoController::class);
    Route::get('/todos/open', [TodoController::class, 'open'])->name('todos.open');
    Route::get('/todos/closed', [TodoController::class, 'closed'])->name('todos.closed');
    Route::put('/todos/{todo}/start', [TodoController::class, 'startTiming'])->name('todos.start');
    Route::put('/todos/{todo}/end', [TodoController::class, 'endTiming'])->name('todos.end');
    Route::put('/todos/{todo}/reset', [TodoController::class, 'reset'])->name('todos.reset');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
