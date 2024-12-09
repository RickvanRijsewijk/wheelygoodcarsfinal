@extends('layouts.app')

@section('content')
    <style>
        .progress-container {
            width: 100%;
            background-color: #b9b9b9;
            border-radius: 5px;
            border: 2px black;
            margin-bottom: 20px;
        }

        .progress-bar {
            width: 100%;
            height: 30px;
            background-color: #4caf50;
            border-radius: 5px;
            text-align: center;
            line-height: 30px;
            color: white;
        }

        .centered {
            background-image: url('images/kentekenplaat.png');
            background-position: 5px center;
            background-repeat: no-repeat;
            position: absolute;
            align-items: center;
        }

        .kentekencheck-input #kenteken {
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            width: 225px;
        }

        .kenteken-input-field {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAvCAMAAADdAborAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAABCUExURSVX19fd9S1UsihUwSVUy////zNVpau57CRV1Edcg4N9SK+ZLGVrYHBwUvT2/VRicEVr232U49KwGZqMPNm1FcjQ8koJI5cAAACiSURBVCjPzZBJFsQgCEQrSFScMt//qq15rR1d9yIsfNSnQBT4X9hOWEhU4KaD4+CtHLqS6MAM8V+LlJZ7ipWS0Bmqk/ZYCrq1Wk351M8LS83Hh94FWOQHOBSL+oE7Jd8s5Jcy2jVQUysL57V0pFpxB8SRnG2aUsiPU8yPjTrx1phNPozBZCpI2wBMWnuA6RrAmrYeYEsDwDUPYE0ZzDle/D0fwJgE4zMjXtEAAAAASUVORK5CYII=) left no-repeat #ffce00;
            height: 50px;
            padding-left: 100px;
            width: 300px !important;
            text-align: center;
            border-radius: 5px;
            border: 0.5px solid black;
            display: block;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group .small-input {
            width: calc(50% - 10px);
        }

        .form-group .inline-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group .inline-group input {
            flex: 1;
            margin-right: 10px;
        }

        .submit-button {
            background-color: #d2691e;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #c15a1b;
        }
    </style>

<div class="progress-container mt-3">
    <div class="progress" role="progressbar" aria-label="Animated striped example">
        <div class="progress-bar bg-primary" style="width: 25%; transition: width 1s;">
            <span class="progress-text">25%</span>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll('input');
            var progressBar = document.querySelector('.progress-bar');
            var progressText = document.querySelector('.progress-text');
            var baseProgress = 20;
            var increment = (100 - baseProgress) / inputs.length;

            function updateProgress() {
                var filledInputs = Array.from(inputs).filter(input => input.value.trim() !== '').length;
                var newProgress = baseProgress + (filledInputs * increment);
                var roundedProgress = Math.round(newProgress);
                animateProgressText(parseInt(progressText.textContent), roundedProgress);
                progressBar.style.width = roundedProgress + '%';
            }

            function animateProgressText(start, end) {
                var duration = 1000;
                var range = end - start;
                var stepTime = Math.abs(Math.floor(duration / range));
                var startTime = new Date().getTime();
                var endTime = startTime + duration;
                var timer;

                function run() {
                    var now = new Date().getTime();
                    var remaining = Math.max((endTime - now) / duration, 0);
                    var value = Math.round(end - (remaining * range));
                    progressText.textContent = value + '%';
                    if (value == end) {
                        clearInterval(timer);
                    }
                }

                timer = setInterval(run, stepTime);
                run();
            }

            inputs.forEach(input => {
                input.addEventListener('input', updateProgress);
            });

            updateProgress();
        });
    </script>
</div>

    <a href="{{ route('aanbod-plaatsen') }}">Terug</a>

    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="form-title">Nieuw aanbod</h1>
        <!-- License Plate Display -->
        <div class="form-group mt-5 d-flex justify-content-center align-middle">
            <div class="kenteken-container">
                <div class="kenteken-holder">
                    <div class="kenteken-input form-group">
                        <input type="text" id="license_plate" name="license_plate"
                            class="form-control kenteken-input-field" style="background-color: #ffce00"
                            value="{{ $inputText }}" required readonly>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display prefilled form field -->
        <form action="{{ route('aanbod.toDB') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input style="display: none" type="text" value="{{ $inputText }}" name="license_plate">

            <!-- Merk -->
            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" id="brand" name="brand" value="{{ $carInfo[0]->merk ?? '' }}">
            </div>

            <!-- Model -->
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" id="model" name="model" value="{{ $carInfo[0]->handelsbenaming ?? '' }}">
            </div>

            <!-- Inline group for seats, Aantal deuren, Massa rijklaar -->
            <div class="row">
                <div class="form-group small-input col-md-4">
                    <label for="seats">Zitplaatsen</label>
                    <input type="number" id="seats" name="seats" class="form-control"
                        onkeydown="preventExponential(event)" value="{{ $carInfo[0]->aantal_zitplaatsen ?? '' }}">
                </div>
                <div class="form-group small-input col-md-4">
                    <label for="doors">Aantal deuren</label>
                    <input type="number" id="doors" name="doors" class="form-control"
                        onkeydown="preventExponential(event)" value="{{ $carInfo[0]->aantal_deuren ?? '' }}">
                </div>
                <div class="form-group small-input col-md-4">
                    <label for="weight">Massa rijklaar</label>
                    <input type="number" id="weight" name="weight" class="form-control"
                        onkeydown="preventExponential(event)" value="{{ $carInfo[0]->massa_rijklaar ?? '' }}">
                </div>
            </div>

            <!-- Inline group for Jaar van productie, Kleur -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="production_year">Jaar van productie</label>
                    <input type="number" id="production_year" name="production_year" onkeydown="preventExponential(event)"
                        value="{{ isset($carInfo[0]->datum_eerste_toelating_dt) ? \Carbon\Carbon::parse($carInfo[0]->datum_eerste_toelating_dt)->year : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="color">Kleur</label>
                    <input type="text" id="color" name="color" value="{{ $carInfo[0]->eerste_kleur ?? '' }}">
                </div>
            </div>

            <!-- Kilometerstand -->
            <div class="form-group">
                <label for="mileage">Kilometerstand</label>
                <div class="input-group">
                    <input type="number" id="mileage" name="mileage" class="form-control" aria-label="Amount in euro"
                        onkeydown="preventExponential(event)" value="{{ $carInfo[0]->kilometerstand ?? '' }}">
                    <span class="input-group-text">km</span>
                </div>
            </div>
            <!-- Vraagprijs -->
            <div class="form-group">
                <label for="price">Vraagprijs</label>
                <div class="input-group">
                    <span class="input-group-text">€</span>
                    <input type="number" id="price" name="price" class="form-control" aria-label="Amount in euro"
                        onkeydown="preventExponential(event)">
                </div>
            </div>

            <!-- Afbeeldingen -->

            <div class="mb-3">
                <label for="pictures" class="form-label">Select Pictures</label>
                <input type="file" name="pictures[]" id="pictures" class="form-control" multiple>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="submit-button fs-5">Aanbod afronden</button>
            </div>
        </form>
    </div>
@endsection

<script>
    function preventExponential(event) {
        if (['e', 'E', '+', '-'].includes(event.key)) {
            event.preventDefault();
        }
    }
</script>
