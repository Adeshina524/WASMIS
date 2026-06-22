<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CounsellorController;
use App\Http\Controllers\ManagementController;

// Public
Route::get('/', function () {
    return view('welcome');
});

// Role-based redirect after login
Route::middleware('auth')->get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin')      return redirect()->route('admin.dashboard');
    if ($role === 'counselor')  return redirect()->route('counselor.dashboard');
    if ($role === 'management') return redirect()->route('management.dashboard');
    return redirect()->route('student.dashboard');
})->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Student
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StressController::class, 'dashboard'])->name('student.dashboard'); // ← add this
    Route::get('/submit', [StressController::class, 'showForm'])->name('student.submit');
    Route::post('/stress', [StressController::class, 'submit'])->name('stress.submit');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/user/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('admin.create.user');
    Route::post('/create-user', [AdminController::class, 'storeUser'])->name('admin.store.user');
});

// Counselor
Route::middleware(['auth', 'role:counselor'])->prefix('counselor')->group(function () {
    Route::get('/dashboard', [CounsellorController::class, 'dashboard'])
        ->name('counselor.dashboard');
});

// Management
Route::middleware(['auth', 'role:management'])->prefix('management')->group(function () {
    Route::get('/dashboard', [ManagementController::class, 'dashboard'])
        ->name('management.dashboard');
});

Route::get('/terms', fn() => view('terms'))->name('terms');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');

require __DIR__.'/auth.php';
