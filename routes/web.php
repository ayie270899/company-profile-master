<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Models\Page;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome', [
        'services' => Service::latest()->take(6)->get(),
        'portfolios' => Portfolio::with('images')->latest()->take(4)->get(),
        'aboutPage' => Page::where('slug', 'tentang-sekolah-kami')->first(),
    ]);
})->name('home');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    ContactMessage::create($validated);

    return back()->with('success', 'Pesan Anda telah terkirim!');
})->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin CRUD routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pages', PageController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('portfolios', PortfolioController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::delete('portfolio-images/{image}', [PortfolioController::class, 'destroyImage'])
            ->name('portfolio-images.destroy');
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    });
});

require __DIR__.'/settings.php';
