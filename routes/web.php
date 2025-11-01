<?php

use App\Livewire\Mirror;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/mirror', function () {
        return view('mirror'); // Create mirror/index.blade.php
    })->name('mirror.index');
});
