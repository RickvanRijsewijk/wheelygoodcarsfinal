@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mijn Aanbod</title>
        <style>

        </style>
    </head>


    <body>
        <div class="container my-5">
            <h1>Mijn Aanbod</h1>

            @if (session('success'))
                <div class="toast-container  top-0 end-0 bg-success rounded-3" style="margin-top: 3.5rem;">
                    <div id="toast" class="toast bg-success rounded-3" role="alert" aria-live="assertive" aria-atomic="true"
                        data-delay="5000">
                        <div class="d-flex bg-success rounded-3">
                            <div class="toast-body bg-success toast-text-color rounded-3">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#toast').toast('show');
                    });
                </script>
            @endif

            @foreach ($cars as $car)
                <a href="{{ route('auto.edit', $car->id) }}" class="car-card">

                    @if ($car->image)
                        <img src="{{ explode(',', $car->image)[0] }}" alt="Car Image">
                    @else
                        <img src="/images/default-car.jpg" alt="Default Car Image">
                    @endif

                    <div class="car-details">
                        <h2>{{ $car->brand }} - {{ $car->model }}</h2>
                        <p>Kenteken: {{ $car->license_plate }}</p>
                        <p>Kilometerstand: {{ $car->mileage }} km</p>
                        <p>Prijs: €{{ number_format($car->price, 2) }}</p>
                        <p>Kleur: {{ $car->color }}</p>
                        <p>Bouwjaar: {{ $car->production_year }}</p>
                        <p
                            class="status-text
                                            @if ($car->status == 'Te koop') status-te-koop
                                            @elseif ($car->status == 'Verkocht') status-verkocht
                                            @else status-other @endif">
                            Status: {{ $car->status }}
                        </p>

                    </div>
                </a>

                <form action="{{ route('auto.delete', $car->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Verwijderen</button>
                </form>

                <form action="{{ route('auto.status', $car->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn status-button btn-primary">
                        @if ($car->status == 'Te koop')
                            Verkopen
                        @elseif ($car->status == 'Verkocht')
                            Te koop zetten
                        @else
                            Wijzig status
                        @endif
                    </button>
                </form>
            @endforeach
        </div>
    </body>

    </html>
@endsection
