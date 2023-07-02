<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController as ProductsByCategory;

use App\Http\Controllers\CustomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Owner\OwnerSettingController;
use App\Http\Controllers\ShippingCostsController;

use App\Http\Controllers\ProductTransactionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category/{id}', [ProductsByCategory::class, 'index']);
Route::get('/product-details/{id}', [ProductsByCategory::class, 'productDetails']);

// Route::get('/category/custom', [CustomController::class, 'index'])->name('custom');
// Route::get('/category/custom/{id}', [App\Http\Controllers\CustomController::class, 'detail'])->name('custom-detail');
// Route::get('/category/kebaya', [App\Http\Controllers\KebayaController::class, 'index'])->name('kebaya');
// Route::get('/category/jas', [App\Http\Controllers\JasController::class, 'index'])->name('jas');
// Route::get('/category/celana', [App\Http\Controllers\CelanaController::class, 'index'])->name('celana');
// Route::get('/category/kemeja', [App\Http\Controllers\KemejaController::class, 'index'])->name('kemeja');
// Route::get('/category/seragam', [App\Http\Controllers\SeragamController::class, 'index'])->name('seragam');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');

Route::get('/details/{slug}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])
    ->name('register-success');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
    // Route::post('/calculate-shipping-cost', 'CartController@calculateShippingCost')->name('calculate_shipping_cost');

    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    // Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/product', [App\Http\Controllers\DashboardProductController::class, 'index'])
        ->name('dashboard-product');
    Route::get('/dashboard/product/create', [App\Http\Controllers\DashboardProductController::class, 'create'])
        ->name('dashboard-product-create');
    Route::get('/dashboard/product/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])
        ->name('dashboard-product-details');

    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionsController::class, 'index'])
        ->name('dashboard-transactions');
    Route::post('/dashboard/transactions/{id}/diterima', [App\Http\Controllers\DashboardTransactionsController::class, 'received'])
        ->name('dashboard-transactions-received');
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsController::class, 'details'])
        ->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsController::class, 'update'])
        ->name('dashboard-transactions-update');

    Route::get('/province/{id}/cities', [DashboardSettingController::class, 'getCities']);
    Route::get('/city/{id}/postal-code', [DashboardSettingController::class, 'getPostalCode']);

    Route::post('/dashboard/account/update-info', [AccountSettingsController::class, 'updateInformation'])->name('user.update.info');
    Route::post('/dashboard/account/update-password', [AccountSettingsController::class, 'updatePassword'])->name('user.update.password');
    Route::post('/dashboard/account/update-avatar', [AccountSettingsController::class, 'updateAvatar'])->name('user.update.avatar');


    Route::get('/dashboard/setting', [App\Http\Controllers\DashboardSettingController::class, 'store'])
        ->name('dashboard-setting-store');
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])
        ->name('dashboard-setting-account');
    Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])
        ->name('dashboard-setting-redirect');
    Route::get('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.password.post');

    Route::get('/dashboard/transaction/{id}/product', [ProductTransactionsController::class, 'index'])->name('product-transaction-details');
    Route::post('/dashboard/transaction/product/{id}/create-reviews', [ReviewController::class, 'store'])->name('create-reviews');

    // Route::post('/rajaongkir/ongkos-kirim', [ShippingCostsController::class, 'getShippingCosts'])->name('shipping.costs');
    Route::get('/rajaongkir/origin-{origin_id}/destination-{destination_id}/weight-{weight}/courier-{courier}/ongkos-kirim', [ShippingCostsController::class, 'getShippingCosts']);
});


Route::prefix('admin')
    ->middleware(['admin', 'auth'])
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('product-gallery', App\Http\Controllers\Admin\ProductGalleryController::class);
        Route::get('/transaction/cetak', [App\Http\Controllers\Admin\TransactionController::class, 'print'])->name('admin.transactions.print');
        Route::resource('transaction', App\Http\Controllers\Admin\TransactionController::class);
        Route::get('/penjualan/cetak', [App\Http\Controllers\Admin\PenjualanController::class, 'print'])->name('admin.penjualan.print');
        Route::resource('penjualan', App\Http\Controllers\Admin\PenjualanController::class);
        Route::resource('banner', App\Http\Controllers\Admin\BannerController::class);
        Route::resource('/review', AdminReviewController::class);
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings/update-info', [SettingsController::class, 'updateInformation'])->name('admin.update.info');
        Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('admin.update.password');
        Route::post('/settings/update-avatar', [SettingsController::class, 'updateAvatar'])->name('admin.update.avatar');
    });

Route::prefix('owner')
->middleware(['owner', 'auth'])
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('owner-dashboard');
        Route::resource('pelanggan', App\Http\Controllers\Owner\PelangganController::class);
        Route::get('/transaksi/cetak', [App\Http\Controllers\Owner\TransaksiController::class, 'print'])->name('owner.transaksi.print');
        Route::resource('transaksi', App\Http\Controllers\Owner\TransaksiController::class);
        Route::get('/jual/cetak', [App\Http\Controllers\Owner\JualController::class, 'print'])->name('owner.jual.print');
        Route::resource('jual', App\Http\Controllers\Owner\JualController::class);
        Route::get('/settings', [OwnerSettingController::class, 'index'])->name('owner.setting');
        Route::post('/settings/update-info', [OwnerSettingController::class, 'updateInformation'])->name('owner.update.info');
        Route::post('/settings/update-password', [OwnerSettingController::class, 'updatePassword'])->name('owner.update.password');
        Route::post('/settings/update-avatar', [OwnerSettingController::class, 'updateAvatar'])->name('owner.update.avatar');
        Route::resource('/ulasan', App\Http\Controllers\Owner\UlasanController::class);
});
Auth::routes();
