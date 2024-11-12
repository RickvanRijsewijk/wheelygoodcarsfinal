<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Api\RdwController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    protected $rdwController;

    public function __construct(RdwController $rdwController)
    {
        $this->rdwController = $rdwController;
    }

    public function carList()
    {
        // Retrieve all cars from the database with pagination
        $cars = Car::where('status', 'Te koop')->paginate(10); // 10 cars per page

        // Pass the cars data to the view
        return view('layouts.alle-autos', compact('cars'));
    }

    public function submitForm(Request $request)
    {
        // Validate form input data
        $validatedData = $request->validate([
            'license_plate' => 'required|string|max:255',
        ]);

        $carInfo = $this->rdwController->getNumberPlateInfo($validatedData['license_plate']);

        if ($carInfo->getStatusCode() == 200) {
            $carInfo = $carInfo->getData();
            session(['carInfo' => $carInfo]);
        } else {
            return redirect()->back()->withErrors(['api_error' => 'Failed to retrieve car information from the API.']);
        }

        return redirect()->route('next-page.show')->with('inputText', $validatedData['license_plate']);
    }

    public function showNextPage(Request $request)
    {
        $inputText = session('inputText', '');
        $carInfo = session('carInfo', []);

        return view('layouts.next-page', compact('inputText', 'carInfo'));
    }

    public function SaveToDB(Request $request)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric',
            'license_plate' => 'required|string|max:255',
            'mileage' => 'required|integer',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'weight' => 'required|integer',
            'production_year' => 'required|integer',
            'color' => 'required|string|max:255',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file uploads
        $imagePaths = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $filename, 'public');
                $imagePaths[] = '/storage/' . $filePath;
            }
        }

        // Save the car details and image paths in the database
        Car::create([
            'user_id' => Auth::id(),
            'license_plate' => $validatedData['license_plate'],
            'brand' => $validatedData['brand'],
            'model' => $validatedData['model'],
            'seats' => $validatedData['seats'],
            'doors' => $validatedData['doors'],
            'weight' => $validatedData['weight'],
            'price' => $validatedData['price'],
            'mileage' => $validatedData['mileage'],
            'production_year' => $validatedData['production_year'],
            'color' => $validatedData['color'],
            'status' => 'Te koop',
            'sold_at' => $request['status'] === 'Verkocht' ? now() : null,
            'image' => implode(',', $imagePaths), // Store image paths as a comma-separated string
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
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Zoek de auto en controleer of deze van de ingelogde gebruiker is
        $car = Car::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$car) {
            return redirect()->route('mijn-aanbod')->with('error', 'Auto niet gevonden of je hebt geen toestemming.');
        }

        // Handle file uploads
        $imagePaths = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $filename, 'public');
                $imagePaths[] = '/storage/' . $filePath;
            }
        }

        // Update the car with the validated data
        $car->update($validatedData);

        // If there are new images, update the image field
        if (!empty($imagePaths)) {
            $car->image = implode(',', $imagePaths); // Store image paths as a comma-separated string
            $car->save();
        }

        return redirect()->route('mijn-aanbod')->with('success', 'Auto succesvol bijgewerkt.');
    }

    public function toggleStatus($id)
    {
        $car = Car::findOrFail($id);
        $car->status = $car->status === 'Te koop' ? 'Verkocht' : 'Te koop';
        $car->sold_at = $car->status === 'Verkocht' ? now() : null;
        $car->save();
        return redirect()->route('mijn-aanbod')->with('success', 'Status successvol geüpdate!');
    }

    public function getCarDetails($id)
    {
        $car = Car::with('user')->findOrFail($id);
        return view('layouts.car-details', compact('car'));
    }

    public function generatePDF($id)
    {
        $car = Car::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('car.pdf', compact('car'));
        return $pdf->download('car-details.pdf');
    }

}
