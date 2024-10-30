@extends('layouts.app')

@section('content')
    <h1>All Cars</h1>
    <div>
        @livewire('search')
    </div>
    <div class="car-container">
        @foreach ($cars as $car)
            @if ($car->status == 'Te koop')
                <a href="{{ route('auto.details', $car->id) }}" class="car-card">
                    <!-- Display Car Image -->
                    @if ($car->image)
                        <img src="{{ explode(',', $car->image)[0] }}" alt="Car Image">
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
                </a>
            @endif
        @endforeach
        @if (
            $cars->isEmpty() ||
                !$cars->contains(function ($car) {
                    return $car->status == 'Te koop';
                }))
            <div class="alert alert-danger" role="alert">
                Er staan momenteel geen auto's te koop
            </div>
        @endif
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cars->links('pagination.custom') }}
    </div>
@endsection
