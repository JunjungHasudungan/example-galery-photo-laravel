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
    Route::resource('galery-photo', AdminPostController::class);

    Route::get('admin-galeri-photo', [AdminPostController::class, 'index'])->name('admin-galeri-photo');
    Route::get('admin-galeri-photo-create', [AdminPostController::class, 'create'])->name('admin-galeri-photo-create');
    Route::get('admin-galeri-photo/{post}', [AdminPostController::class, 'edit'])->name('admin-galeri-photo-edit');
    Route::put('admin-galeri-photo-update/{post}', [AdminPostController::class, 'update'])->name('admin-galeri-photo-update');
    Route::delete('admin-galeri-photo-delete/{post}', [AdminPostController::class, 'destroy'])->name('admin-galeri-photo-delete');
    Route::post('admin-galeri-photo-store', [AdminPostController::class, 'store'])->name('admin-galeri-photo-store');

    // ROUTE FOR USER
    Route::get('user-dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
