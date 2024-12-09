<div>
    <input type="text" wire:model.live="searchTerm" placeholder="Search cars..." class="form-control mt-2">
    <div>
        @if (count($results) > 0)
            @foreach ($results as $car)
                <div class="car-container">
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
                </div>
            @endforeach
        @elseif ($searchTerm)
            <p>No cars found matching <strong> {{ $searchTerm }}</strong></p>
        @endif
    </div>
</div>
