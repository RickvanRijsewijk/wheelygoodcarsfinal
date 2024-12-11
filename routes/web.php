<?php

use App\Http\Controllers\Api\RdwController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'carList'])->name('home');
Route::get('/alle-autos', [FormController::class, 'carList'])->name('alle-autos');
Route::get('/details/{id}', [FormController::class, 'getCarDetails'])->middleware('count.car.views')->name('auto.details');

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
    Route::delete('/auto/verwijderen/{id}', [FormController::class, 'deleteCar'])->name('auto.delete');
    Route::post('/auto/{id}/toggle-status', [FormController::class, 'toggleStatus'])->name('auto.status');
    Route::get('/auto/bewerken/{id}', [FormController::class, 'editCar'])->name('auto.edit');
    Route::post('/auto/update/{id}', [FormController::class, 'updateCar'])->name('auto.update');
    Route::get('/car/{id}/pdf', [FormController::class, 'generatePDF'])->name('car.pdf');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('check.admin')->name('admin.dashboard');
    Route::get('/admin/dashboard-data', [AdminController::class, 'getDashboardData'])->name('admin.dashboard-data');
    Route::get('/cars/{id}/tags', [FormController::class, 'getTags'])->name('cars.tags');
});

Route::get('/api/numberplate/{plate}', [RdwController::class, 'getNumberPlateInfo']);
Route::get('/error/admin', [ErrorController::class, 'adminError'])->name('error.admin');
Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__ . '/auth.php';
