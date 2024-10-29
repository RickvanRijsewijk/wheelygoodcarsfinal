@extends('layouts.app')

@section('content')
    <!-- resources/views/layouts/alle-autos.blade.php -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Cars</title>
        <style>
            .car-card {
                border: 1px solid #ccc;
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 10px;
                background-color: rgba(61, 105, 255, 0.32);
            }

            .car-card img {
                object-fit: cover;
                max-width: 512px;
                height: auto;
                border-radius: 5px;
            }

            .delete-button {
                background-color: red;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;

                margin-top: 10px;
            }

            .delete-button:hover {
                background-color: darkred;
            }
        </style>
    </head>

    <body>

        <h1>All Cars</h1>

        <div class="car-container">
            @foreach ($cars as $car)
                @if ($car->status == 'Te koop')
                    <div class="car-card">
                        <!-- Display Car Image -->
                        @if ($car->image)
                            <img src="{{ $car->image }}" alt="Car Image">
                        @else
                            <img src="/images/default-car.jpg" alt="Default Car Image">
                        @endif

                        <!-- Car Details -->
                        <div class="car-details">
                            <h2>{{ $car->brand }} - {{ $car->model }}</h2>
                            <p>Kenteken: {{ $car->license_plate }}</p>
                            <p>Kilometerstand: {{ $car->mileage }} km</p>
                            <p>Prijs: €{{ number_format($car->price, 2) }}</p>
                            <p>Kleur: {{ $car->color }}</p>
                            <p>Bouwjaar: {{ $car->production_year }}</p>
                        </div>

                        <!-- Verwijder-knop alleen zichtbaar voor de eigenaar -->
                        {{-- @if (Auth::id() == $car->user_id)
                            <form action="{{ route('auto.delete', $car->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Verwijderen</button>
                            </form>
                        @endif --}}
                    </div>
                @endif
            @endforeach
            @if ($cars->isEmpty())
                <div class="alert alert-danger" role="alert">
                    Er staan momenteel geen auto's te koop
                </div>
            @endif
        </div>

    </body>

    </html>
@endsection
