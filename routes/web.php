<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\CatalogSettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Storage Asset File Delivery Route (Universal Fallback for Shared Hosting / cPanel)
|--------------------------------------------------------------------------
*/
Route::get('/storage/{path}', function ($path) {
    // 1. Check in public/storage/$path
    $publicStorage = public_path('storage/' . $path);
    if (file_exists($publicStorage) && !is_dir($publicStorage)) {
        return response()->file($publicStorage);
    }

    // 2. Check in storage/app/public/$path
    $storageApp = storage_path('app/public/' . $path);
    if (file_exists($storageApp) && !is_dir($storageApp)) {
        return response()->file($storageApp);
    }

    // 3. Check in public/$path directly
    $publicDirect = public_path($path);
    if (file_exists($publicDirect) && !is_dir($publicDirect)) {
        return response()->file($publicDirect);
    }

    // 4. Check in public/images/$path
    $publicImages = public_path('images/' . $path);
    if (file_exists($publicImages) && !is_dir($publicImages)) {
        return response()->file($publicImages);
    }

    abort(404);
})->where('path', '.*')->name('storage.file_serve');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/layanan/{slug}', [\App\Http\Controllers\ServiceController::class, 'show'])->name('layanan.show');
Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');
Route::get('/reseller', [ResellerController::class, 'index'])->name('reseller');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak/kirim', [ContactController::class, 'store'])->name('kontak.store')->middleware('throttle:6,1');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return redirect()->route('member.login'); })->name('login');
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit')->middleware('throttle:5,1');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Protected Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Messages & Naskah Submissions
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('messages/{message}/reply', [ContactMessageController::class, 'reply'])->name('messages.reply');

    // Live Notification Polling & Actions
    Route::get('notifications/live', [ContactMessageController::class, 'liveNotifications'])->name('notifications.live');
    Route::post('notifications/mark-all-read', [ContactMessageController::class, 'markAllRead'])->name('notifications.mark_all_read');

    // Orders & Sales Management
    Route::get('/orders',                [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}',           [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/shipping-label', [AdminOrderController::class, 'printShippingLabel'])->name('orders.shipping_label');
    Route::post('/orders/{id}/shipping', [AdminOrderController::class, 'updateShipping'])->name('orders.shipping');
    Route::post('/orders/{id}/messages', [AdminOrderController::class, 'sendOrderMessage'])->name('orders.message');
    Route::get('/orders/{id}/messages-api', [AdminOrderController::class, 'getOrderMessagesApi'])->name('orders.messages_api_data');
    Route::post('/orders/{id}/payment',  [AdminOrderController::class, 'updatePaymentStatus'])->name('orders.payment');
    Route::delete('/orders/{id}',        [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Books & Catalog Collection
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::post('/books/bulk-destroy', [BookController::class, 'bulkDestroy'])->name('books.bulk_destroy');
    Route::resource('books', BookController::class);

    // Admin Users Management
    Route::resource('users', UserController::class);

    // Profile & Password
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Settings
    Route::get('/settings/home', [HomeSettingController::class, 'index'])->name('settings.home');
    Route::put('/settings/home', [HomeSettingController::class, 'update'])->name('settings.home.update');
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
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

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
    Route::get('/pesanan',          [MemberDashboardController::class, 'orders'])->name('orders');
    Route::post('/pesanan/{orderNumber}/terima', [MemberDashboardController::class, 'confirmReceived'])->name('orders.confirm_received');
    Route::post('/pesanan/{orderNumber}/messages', [MemberDashboardController::class, 'sendOrderMessage'])->name('orders.message');
    Route::get('/pesanan/{orderNumber}/messages',  [MemberDashboardController::class, 'getOrderMessages'])->name('orders.messages_api');
    Route::get('/profil',           [MemberDashboardController::class, 'profile'])->name('profile');
    Route::put('/profil',           [MemberDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password',  [MemberDashboardController::class, 'updatePassword'])->name('profile.password');

    // Shopping Cart & Payment Routes
    Route::get('/cart',               [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add',          [CartController::class, 'add'])->name('cart.add')->middleware('throttle:60,1');
    Route::post('/cart/update/{id}',  [CartController::class, 'update'])->name('cart.update');
    Route::match(['post', 'delete'], '/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::match(['post', 'delete'], '/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/checkout/qris',[PaymentController::class, 'createQrisPayment'])->name('cart.checkout.qris')->middleware('throttle:15,1');
    Route::get('/order/status/{orderNumber}', [PaymentController::class, 'checkStatus'])->name('order.status');
});

// Order Invoice, Status Check & Pakasir Webhook Routes
Route::get('/order/status/{orderNumber}',  [PaymentController::class, 'checkStatus'])->name('public.order.status')->middleware('throttle:30,1');
Route::get('/order/invoice/{orderNumber}', [PaymentController::class, 'showInvoice'])->name('order.invoice')->middleware('throttle:30,1');
Route::post('/api/pakasir/webhook',        [PaymentController::class, 'handleWebhook'])->name('pakasir.webhook')->middleware('throttle:60,1');
