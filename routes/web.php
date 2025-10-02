<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HomelistController;
use App\Http\Controllers\LikelistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Member_paketController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// LOGIN PAGE sebagai halaman awal
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'createMember'])->name('createMember');

/* Route::post('/pay/{paket}', [FrontController::class, 'pay'])->name('paket.pay');
Route::post('/midtrans/callback', [FrontController::class, 'midtransCallback'])->name('midtrans.callback');
Route::get('/payment-success', [FrontController::class, 'success'])->name('payment.success');
 */
Route::post('/paket/pay/{paket}', [FrontController::class, 'pay'])->name('paket.pay');
Route::get('/checkout/{orderId}', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/midtrans/notification', [MidtransNotificationController::class, 'handleMidtransNotification'])->name('midtrans.notification');

Route::post('/paket/updateStatus/{orderId}', [FrontController::class, 'updateStatus'])->name('paket.updateStatus');

Route::get('/success', function() {
    return 'Pembayaran Sukses!';
});
Route::get('/pending', function() {
    return 'Pembayaran Tertunda!';
});
Route::get('/error', function() {
    return 'Pembayaran Gagal!';
});



// EMAIL VERIFICATION
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) { 
    $request->fulfill();    
    return redirect()->route('front.home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// DASHBOARD MEMBER
Route::middleware(['auth', 'verified', 'role:member'])->group(function () {
    Route::get('/home', [FrontController::class, 'index'])->name('front.home');
    Route::get('/profile', [FrontController::class, 'profile'])->name('front.profile');
    Route::put('/profile', [FrontController::class, 'updateProfile'])->name('front.profile.update'); // submit
    Route::get('/homelist', [HomelistController::class, 'homelist'])->name('front.homelist');

    Route::post('/like/{id}', [LikeController::class, 'like'])->name('like.like');
    Route::post('/dislike/{id}', [LikeController::class, 'dislike'])->name('like.dislike');
    Route::get('/likelist', [LikelistController::class, 'index'])->name('front.likelist');
    Route::get('/likedetail/{id}', [LikelistController::class, 'likedetail'])->name('front.likedetail');
    Route::post('/dislike_detail/{id}', [LikelistController::class, 'dislike_detail'])->name('like.dislike_detail');

});

// DASHBOARD OWNER
Route::middleware(['auth', 'verified', 'role:owner'])->group(function () {
    Route::get('/owner/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pakets', PaketController::class)->middleware('role:owner');
    
    Route::get('member_pakets',[Member_paketController::class, 'index'])->middleware('role:owner')->name('member_pakets.index');
    Route::get('member_pakets/create', [Member_paketController::class, 'create'])->middleware('role:owner')->name('member_pakets.create');
    Route::post('member_pakets', [Member_paketController::class, 'store'])->middleware('role:owner')->name('member_pakets.store');
    Route::get('member_pakets/{member_paket}/edit', [Member_paketController::class, 'edit'])->middleware('role:owner')->name('member_pakets.edit');
    Route::put('member_pakets/{member_paket}', [Member_paketController::class, 'update'])->middleware('role:owner')->name('member_pakets.update');
    Route::delete('member_pakets/{member_paket}', [Member_paketController::class, 'destroy'])->middleware('role:owner')->name('member_pakets.destroy');

});



Route::middleware('auth')->group(function () {

    Route::prefix('admin')->name('admin.')->group(function(){
        

        Route::get('members',[MemberController::class, 'index'])->middleware('role:owner')->name('members');
        Route::get('members/create', [MemberController::class, 'create'])->middleware('role:owner')->name('members.create');
        Route::post('members', [MemberController::class, 'store'])->middleware('role:owner')->name('members.store');
        Route::get('members/{member}/edit', [MemberController::class, 'edit'])->middleware('role:owner')->name('members.edit');
        Route::put('members/{member}', [MemberController::class, 'update'])->middleware('role:owner')->name('members.update');
        Route::delete('members/{member}', [MemberController::class, 'destroy'])->middleware('role:owner')->name('members.destroy');

      
    });
});
