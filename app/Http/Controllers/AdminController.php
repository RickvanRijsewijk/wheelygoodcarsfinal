<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCars = Car::count();
        $soldCars = Car::whereNotNull('sold_at')->count();
        $todayCars = Car::whereDate('created_at', today())->count();
        $providers = User::has('cars')->count();
        $viewsToday = Car::whereDate('updated_at', today())->sum('views');
        $avgCarsPerProvider = Car::count() / max($providers, 1);

        return view('layouts.admin-dashboard', compact('totalCars', 'soldCars', 'todayCars', 'providers', 'viewsToday', 'avgCarsPerProvider'));
    }

    public function getDashboardData()
    {
        try {
            $totalCars = Car::count();
            $soldCars = Car::whereNotNull('sold_at')->count();
            $todayCars = Car::whereDate('created_at', today())->count();
            $providers = User::has('cars')->count();
            $viewsToday = Car::whereDate('updated_at', today())->sum('views');
            $avgCarsPerProvider = Car::count() / max($providers, 1);

            return response()->json(compact('totalCars', 'soldCars', 'todayCars', 'providers', 'viewsToday', 'avgCarsPerProvider'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getIsAdmin()
    {
        $user = auth()->user();

        if ($user && $user->is_admin) {
            return response()->json(['isAdmin' => true]);
        } else {
            return response()->json(['isAdmin' => false]);
        }
    }
}
