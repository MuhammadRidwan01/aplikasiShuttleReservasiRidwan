<?php

use App\Livewire\ManualSearchBooking;
use App\Livewire\BookingForm;
use App\Livewire\EditBooking;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/booking', BookingForm::class)->name('booking');
Route::get('/edit-booking', EditBooking::class)->name('edit-booking');
Route::get('/cari-booking', ManualSearchBooking::class)->name('search-booking');
