<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Editor\EditorProductController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOrderController;

// ─── Public Routes ───────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─── Auth Routes (Guest Only) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class,    'showForm'])->name('login');
    Route::post('/login',   [LoginController::class,    'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Admin Routes (role: admin only) ─────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Produk
        Route::resource('products', AdminProductController::class);

        // Manajemen Order
        Route::get('/orders',                [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}',        [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status',[AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Manajemen User
        Route::get('/users',                 [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}',          [AdminUserController::class, 'show'])->name('users.show');
        Route::patch('/users/{user}/role',   [AdminUserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}',       [AdminUserController::class, 'destroy'])->name('users.destroy');
    });

// ─── Editor Routes (role: admin atau editor) ─────────────────────────────────
Route::middleware(['auth', 'role:admin,editor'])
    ->prefix('editor')
    ->name('editor.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [EditorDashboardController::class, 'index'])->name('dashboard');

        // Kelola Produk (tidak bisa delete)
        Route::get('/products',              [EditorProductController::class, 'index'])->name('products.index');
        Route::get('/products/create',       [EditorProductController::class, 'create'])->name('products.create');
        Route::post('/products',             [EditorProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit',[EditorProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}',    [EditorProductController::class, 'update'])->name('products.update');
    });

// ─── User Routes (role: user) ─────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,editor,user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Riwayat Order
        Route::get('/orders',          [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}',  [UserOrderController::class, 'show'])->name('orders.show');
    });
