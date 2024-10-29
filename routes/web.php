<?php

use App\Http\Controllers\Api\RdwController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FormController::class, 'carList'])->name('home');

Route::get('/alle-autos', [FormController::class, 'carList'])->name('alle-autos'); // Route for car list

Route::middleware('auth')->group(function () {

    Route::get('/mijn-aanbod', function () {
        return view('layouts.mijn-aanbod');
    })->name('mijn-aanbod');

    Route::get('/aanbod-plaatsen', function () {
        return view('layouts.aanbod-plaatsen');
    })->name('aanbod-plaatsen');

    // routes die form doen submitten
    Route::post('/aanbod-plaatsen/submit', [FormController::class, 'submitForm'])->name('aanbod.submit');

    Route::post('/next-page/submit', [FormController::class, 'SaveToDB'])->name('aanbod.toDB');
    // rout om de kenteken data in de volgende pagina in te laden
    Route::get('/next-page', [FormController::class, 'showNextPage'])->name('next-page.show');

    route::get('/mijn-aanbod', [FormController::class, 'getUserCars'])->name('mijn-aanbod');

    // Route om een auto te verwijderen
    Route::delete('/auto/verwijderen/{id}', [FormController::class, 'deleteCar'])->name('auto.delete');

    Route::post('/auto/{id}/toggle-status', [FormController::class, 'toggleStatus'])->name('auto.status');

    // Route om de edit-pagina weer te geven
    Route::get('/auto/bewerken/{id}', [FormController::class, 'editCar'])->name('auto.edit');

    // Route om de update op te slaan
    Route::post('/auto/update/{id}', [FormController::class, 'updateCar'])->name('auto.update');
});

Route::get('/api/numberplate/{plate}', [RdwController::class, 'getNumberPlateInfo']);
Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__ . '/auth.php';
