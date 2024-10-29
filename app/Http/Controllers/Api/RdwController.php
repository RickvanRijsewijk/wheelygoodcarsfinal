<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RdwController extends Controller
{
    public function getNumberPlateInfo($plate)
    {
        $plate = str_replace(' ', '%20', $plate);

        $response = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$plate}");

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Unable to fetch data from RDW API'], $response->status());
        }
    }
}
