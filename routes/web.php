<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccesssPage;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// =======================
// PUBLIC ROUTES
// =======================
Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);

// =======================
// GUEST ROUTES
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

// =======================
// AUTH ROUTES
// =======================
Route::middleware('auth')->group(function () {

    // ✅ LOGOUT (THIS FIXES YOUR ERROR)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // Checkout
    Route::get('/checkout', CheckoutPage::class)->name('checkout');

    // Orders
    Route::get('/my-orders', MyOrdersPage::class)->name('myorders.index');

    Route::get('/my-orders/{order}', MyOrderDetailPage::class)
        ->name('myorders.show');

    Route::get('/my-orders/{order}/invoice', [InvoiceController::class, 'download'])
        ->name('myorders.invoice');

    // Payment result
    Route::get('/success', SuccesssPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});
