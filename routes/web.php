<?php

use App\Http\Controllers\CatalogController;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landingpage');
})->name('home');

Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak/kirim', [ContactController::class, 'store'])->name('kontak.store')->middleware('throttle:6,1');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit')->middleware('throttle:5,1');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Protected Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Messages & Naskah Submissions
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);

    // Books & Catalog Collection
    Route::resource('books', BookController::class);

    // Admin Users Management
    Route::resource('users', UserController::class);

    // Profile & Password
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Settings
    Route::get('/settings/catalog', [CatalogSettingController::class, 'index'])->name('settings.catalog');
    Route::put('/settings/catalog', [CatalogSettingController::class, 'update'])->name('settings.catalog.update');
    Route::get('/settings/contact', [SettingController::class, 'contact'])->name('settings.contact');
    Route::put('/settings/contact', [SettingController::class, 'updateContact'])->name('settings.contact.update');
    Route::get('/settings/about', [AboutSettingController::class, 'index'])->name('settings.about');
    Route::put('/settings/about', [AboutSettingController::class, 'update'])->name('settings.about.update');
});
