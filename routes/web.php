<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\TeamMemberController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Language change route
Route::post('/language/change', [LanguageController::class, 'change'])->name('language.change');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // API endpoint for dynamic dashboard data
    Route::get('/api/dashboard-data', [DashboardController::class, 'getDashboardData']);

    // Admin Only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggleRole'])->name('users.toggle');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/image', [UserController::class, 'updateImage'])->name('users.image.update');
        Route::delete('/users/{user}/image', [UserController::class, 'deleteImage'])->name('users.image.delete');
    });

    // Staff and Admin
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
        Route::post('/pos/order', [POSController::class, 'storeOrder'])->name('pos.order');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::resource('customers', CustomerController::class);
    });

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/image', [ProfileController::class, 'deleteImage'])->name('profile.image.delete');

    Route::get('/story', [TeamMemberController::class, 'index'])->name('story');
    Route::post('/story/upload/{id}', [TeamMemberController::class, 'uploadImage'])->name('team.upload.story');
    Route::delete('/story/delete/{id}', [TeamMemberController::class, 'deleteImage'])->name('team.delete.story');
    Route::patch('/story/update/{id}', [TeamMemberController::class, 'update'])->name('team.update');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});
