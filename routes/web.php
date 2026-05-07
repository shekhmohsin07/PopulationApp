<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CountryController;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

Route::get('/', [CountryController::class, 'home'])->name('home');
Route::get('/countries/edit-third', [CountryController::class, 'editThirdCountry'])->name('countries.editThird');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('countries', CountryController::class);
    Route::get('/countries/edit-third', [CountryController::class, 'editThirdCountry'])->name('countries.editThird');
    Route::post('/countries/update-third', [CountryController::class, 'updateThirdCountry'])->name('countries.updateThird');   
});


Route::get('dashboard', [CountryController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
