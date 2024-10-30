@extends('layouts.app')

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body {
                background-color: #f4f4f4;
                margin: 0;
            }

            .form-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 30px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .form-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .form-table td {
                padding: 10px;
                vertical-align: middle;
            }

            .form-table td label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #555;
            }

            .form-table td input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .submit-button {
                display: block;
                width: 100%;
                background-color: #28a745;
                color: #fff;
                padding: 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 1.1em;
                text-transform: uppercase;
                font-weight: bold;
                margin-top: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .submit-button:hover {
                background-color: #218838;
            }

            .form-table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .form-table tr:hover {
                background-color: #f1f1f1;
            }
        </style>
    </head>

    <body>
        <div class="toast-container  top-0 end-0 bg-success rounded-3" style="margin-top: 3.5rem;">
            <div id="toast" class="toast bg-success rounded-3" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="d-flex bg-success rounded-3">
                    <div class="toast-body bg-success toast-text-color rounded-3">10 klanten bekeken deze auto vandaag</div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('#toast').toast('show');
                }, 2000);
            });
        </script>
        <div class="form-container">
            <h1>Auto gegevens</h1>

            <table class="form-table">
                <tr>
                    <td colspan="2">
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                                    aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                @php
                                    $images = explode(',', $car->image ?? '');
                                    $images = array_pad($images, 3, '...');
                                @endphp
                                <div class="carousel-item active">
                                    <img src="{{ $images[0] }}" class="d-block w-100"
                                        alt="Afbeelding kon niet geladen worden">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ $images[1] }}" class="d-block w-100"
                                        alt="Afbeelding kon niet geladen worden">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ $images[2] }}" class="d-block w-100"
                                        alt="Afbeelding kon niet geladen worden">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="brand">Merk</label>
                        <input type="text" id="brand" name="brand" value="{{ old('brand', $car->brand) }}"
                            readonly>
                    </td>
                    <td>
                        <label for="model">Model</label>
                        <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}"
                            readonly>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="mileage">Kilometerstand</label>
                        <input type="text" id="mileage" name="mileage" value="{{ old('mileage', $car->mileage) }}"
                            readonly>
                    </td>
                    <td>
                        <label for="price">Prijs</label>
                        <input type="text" id="price" name="price" value="{{ old('price', $car->price) }}"
                            readonly>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="seats">Aantal seats</label>
                        <input type="text" id="seats" name="seats" value="{{ old('seats', $car->seats) }}"
                            readonly>
                    </td>
                    <td>
                        <label for="doors">Aantal deuren</label>
                        <input type="text" id="doors" name="doors" value="{{ old('doors', $car->doors) }}"
                            readonly>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="production_year">Bouwjaar</label>
                        <input type="text" id="production_year" name="production_year"
                            value="{{ old('production_year', $car->production_year) }}" readonly>
                    </td>
                    <td>
                        <label for="color">Kleur</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $car->color) }}"
                            readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="weight">Massa rijklaar</label>
                        <input type="text" id="weight" name="weight" value="{{ old('weight', $car->weight) }}"
                            readonly>
                    </td>
                    <td>
                        <label for="license_plate">Nummerplaat</label>
                        <input type="text" id="license_plate" name="license_plate"
                            value="{{ old('license_plate', $car->license_plate) }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="user_id">Verkoper</label>
                        <input type="text" id="user_id" name="user_id" value="{{ old('user_id', $car->user->name) }}" readonly>
                    </td>
                    <td>
                        <label for="created_at">Te koop gesteld op</label>
                        <input type="text" id="created_at" name="created_at" value="{{ old('created_at', $car->created_at) }}"
                            readonly>
                    </td>
                </tr>
            </table>
            <!-- Add the PDF generation button -->
            <div class="mt-4">
                <a href="{{ route('car.pdf', $car->id) }}" class="btn btn-primary">Download PDF</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script>
            const carousel = new bootstrap.Carousel('#carouselExample')
        </script>
    </body>

    </html>
@endsection
