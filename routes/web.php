<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CatalogSettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
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

/*
|--------------------------------------------------------------------------
| Member (Public User) Auth & Dashboard Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\MemberDashboardController;

// Guest-only member routes
Route::middleware('guest')->prefix('member')->name('member.')->group(function () {
    Route::get('/login',        [MemberAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',       [MemberAuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::get('/register',     [MemberAuthController::class, 'showRegister'])->name('register');
    Route::post('/register',    [MemberAuthController::class, 'register'])->name('register.submit')->middleware('throttle:3,1');
});

// Authenticated member routes
Route::post('/member/logout', [MemberAuthController::class, 'logout'])->name('member.logout')->middleware('auth');

Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard',        [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil',           [MemberDashboardController::class, 'profile'])->name('profile');
    Route::put('/profil',           [MemberDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password',  [MemberDashboardController::class, 'updatePassword'])->name('profile.password');
});
