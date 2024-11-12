<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Car;

class CountCarViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->route('id')) {
            $car = Car::find($request->route('id'));
            if ($car) {
                $car->increment('views');
            }
        }

        return $response;
    }
}
