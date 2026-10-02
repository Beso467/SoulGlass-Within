<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\MirrorController;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';


//FRONTEND ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('mirror', [MirrorController::class, 'show'])->name('mirror');
    Route::post('mirror/reveal', [MirrorController::class, 'reveal'])->name('mirror.reveal');
    Route::post('scroll/{userQuote}/favorite', [MirrorController::class, 'favorite'])->name('scroll.favorite');

    Route::inertia('scroll', 'scroll')->name('scroll');
    Route::inertia('lore', 'lore')->name('lore');
});
