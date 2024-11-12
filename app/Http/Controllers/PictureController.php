<?php
// In PictureController.php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'pictures.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = [];

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $filename, 'public');
                $imagePaths[] = '/storage/' . $filePath;
            }
        }

        // Save the car details and image paths in the database
        $car = new Car();
        $car->price = $request->input('price');
        $car->image = implode(',', $imagePaths); // Store image paths as a comma-separated string
        $car->save();

        return back()->with('success', 'Pictures uploaded successfully.');
    }
}
