<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', function () {
    $cars = Product::latest()->take(8)->get();
    $carsCount = Product::count();

    return view('home.index', compact('cars', 'carsCount'));
});

Route::get('/search', [GlobalSearchController::class, 'search'])->name('search.global');
Route::get('/terms', function () {
    return view('home.terms');
})->name('terms');
Route::get('/about', function () {
    return view('home.about');
})->name('about');

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home')->with('success', 'Email berhasil diverifikasi!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi baru telah dikirim ke email Anda!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Protected Routes (Must be logged in and email verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

    // User Routes
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/rental-history', [UserController::class, 'rentalHistory'])->name('user.rental-history');
    Route::put('/user/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
});
