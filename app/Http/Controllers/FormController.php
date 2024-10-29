<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Car;


// Import the Car model
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{

    public function carList()
    {
        // Retrieve all cars from the database
        $cars = Car::all(); // You can use Car::paginate() for pagination if needed

        // Pass the cars data to the view
        return view('layouts.alle-autos', compact('cars'));
    }
    public function submitForm(Request $request)
    {
        // Validate form input data
        $validatedData = $request->validate([
            'license_plate' => 'required|string|max:255',
        ]);

        // Redirect to the next page with input data
        return redirect()->route('next-page.show')->with('inputText', $validatedData['license_plate']);
    }

    public function showNextPage(Request $request)
    {
        // Get inputText from session, default to an empty string if not present
        $inputText = session('inputText', '');

        return view('layouts.next-page', compact('inputText'));
    }

    public function SaveToDB(Request $request)
    {

        // Validate the input data
        $validatedData = $request->validate([
            'license_plate' => 'required|string|max:255',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
            'production_year' => 'required|integer',
            'color' => 'required|string|max:255',
        ]);

        // Create a new Car record with the validated license_plate and user_id
        Car::create([
            'user_id' => Auth::id(),
            'license_plate' => $validatedData['license_plate'],
            'price' => $validatedData['price'],
            'mileage' => $validatedData['mileage'],
            'production_year' => $validatedData['production_year'],
            'color' => $validatedData['color'],
            'status' => 'Te koop'
        ]);

        return redirect()->route('mijn-aanbod')->with('success', 'Auto succesvol toegevoegd.');
    }

    public function getUserCars()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve all cars created by the user
        $userCars = Car::where('user_id', $userId)->get();

        // Pass the cars to the 'mijn-aanbod' view
        return view('layouts.mijn-aanbod', ['cars' => $userCars]);
    }

    public function deleteCar($id)
    {
        // Zoek de auto op basis van het ID en de ingelogde gebruiker
        $car = Car::where('id', $id)->where('user_id', Auth::id())->first();

        // Controleer of de auto gevonden is en behoort tot de ingelogde gebruiker
        if ($car) {
            $car->delete();
            return redirect()->route('mijn-aanbod')->with('success', 'Auto succesvol verwijderd.');
        } else {
            return redirect()->route('mijn-aanbod')->with('error', 'Je hebt geen toestemming om deze auto te verwijderen.');
        }
    }

    public function editCar($id)
    {
        // Zoek de auto die bij het ID en de ingelogde gebruiker hoort
        $car = Car::where('id', $id)->where('user_id', Auth::id())->first();

        // Controleer of de auto bestaat en de gebruiker eigenaar is
        if (!$car) {
            return redirect()->route('mijn-aanbod')->with('error', 'Auto niet gevonden of je hebt geen toestemming.');
        }

        // Geef de edit-pagina weer met de bestaande gegevens van de auto
        return view('layouts.edit-car', compact('car'));
    }

    // Werk de auto bij met de nieuwe gegevens
    public function updateCar(Request $request, $id)
    {
        // Validatie van de gegevens
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        // Zoek de auto en controleer of deze van de ingelogde gebruiker is
        $car = Car::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$car) {
            return redirect()->route('mijn-aanbod')->with('error', 'Auto niet gevonden of je hebt geen toestemming.');
        }

        // Update de auto met de gevalideerde gegevens
        $car->update($validatedData);

        return redirect()->route('mijn-aanbod')->with('success', 'Auto succesvol bijgewerkt.');
    }


    public function toggleStatus($id)
    {
        $car = Car::findOrFail($id);
        $car->status = $car->status === 'Te koop' ? 'Verkocht' : 'Te koop';
        $car->save();
        return redirect()->route('mijn-aanbod')->with('success', 'Status successvol geüpdate!');
    }
}
