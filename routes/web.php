<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Profile routes (CRUD)
Route::middleware('auth:sanctum')->group(function () {
    // Get the authenticated user's profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Update the profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete the profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // Routes that require Sanctum auth
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();  // Access authenticated user info
// });

// // Example of a protected route
// Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
//     return Inertia::render('Profile', [
//         'user' => $request->user(),
//     ]);
// });

// Other routes for profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
