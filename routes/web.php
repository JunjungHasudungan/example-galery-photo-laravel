<?php

use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    PostController as AdminPostController,
};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\{
    Dashboardcontroller as UserDashboardController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // ROUTE FOR ADMIN
    Route::get('admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('admin-galeri-photo', [AdminPostController::class, 'index'])->name('admin-galeri-photo');

    // ROUTE FOR USER
    Route::get('user-dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
