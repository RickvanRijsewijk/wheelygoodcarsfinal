<?php

use App\Http\Controllers\Api\RdwController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'carList'])->name('home');
Route::get('/alle-autos', [FormController::class, 'carList'])->name('alle-autos'); // Route for car list

Route::middleware('auth')->group(function () {
    Route::get('/mijn-aanbod', function () {
        return view('layouts.mijn-aanbod');
    })->name('mijn-aanbod');

    Route::get('/aanbod-plaatsen', function () {
        return view('layouts.aanbod-plaatsen');
    })->name('aanbod-plaatsen');

    Route::post('/aanbod-plaatsen/submit', [FormController::class, 'submitForm'])->name('aanbod.submit');
    Route::post('/next-page/submit', [FormController::class, 'SaveToDB'])->name('aanbod.toDB');
    Route::get('/next-page', [FormController::class, 'showNextPage'])->name('next-page.show');
    Route::get('/mijn-aanbod', [FormController::class, 'getUserCars'])->name('mijn-aanbod');
    Route::get('/details/{id}', [FormController::class, 'getCarDetails'])->name('auto.details');
    Route::delete('/auto/verwijderen/{id}', [FormController::class, 'deleteCar'])->name('auto.delete');
    Route::post('/auto/{id}/toggle-status', [FormController::class, 'toggleStatus'])->name('auto.status');
    Route::get('/auto/bewerken/{id}', [FormController::class, 'editCar'])->name('auto.edit');
    Route::post('/auto/update/{id}', [FormController::class, 'updateCar'])->name('auto.update');
    Route::get('/car/{id}/pdf', [FormController::class, 'generatePDF'])->name('car.pdf');
});

Route::get('/api/numberplate/{plate}', [RdwController::class, 'getNumberPlateInfo']);
Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__ . '/auth.php';
