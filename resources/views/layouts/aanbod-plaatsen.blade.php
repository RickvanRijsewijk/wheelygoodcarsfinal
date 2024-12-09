@extends('layouts.app')

@section('content')
    <style>
        .spinner-container {
            display: none;
            justify-content: center;
            align-items: center;
            margin-top: 56px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 1;
        }
    </style>

    <div class="progress-container">
        <div class="progress" role="progressbar" aria-label="Animated striped example">
            <div class="progress-bar bg-primary" style="width: 50%;">Stap 1 van 2</div>
        </div>
    </div>

    <div class="form-group mt-5 d-flex justify-content-center align-middle">
        <form id="licenseForm" action="{{ route('aanbod.submit') }}" method="POST">
            @csrf
            <div class="kenteken-holder">
                <div class="kenteken-input form-group">
                    <input type="text" id="license_plate" name="license_plate" class="form-control kenteken-input-field"
                        style="background-color: #ffce00" name="kenteken" placeholder="7-ZSB-84" required> <br>
                </div>
                <div class="form-group">
                    <button type="submit">Verder gaan</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Spinner -->
    <div class="spinner-container" id="spinner">
        <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
        </div>
        <div>
            <span role="status">Loading...</span>
        </div>
    </div>
    <script>
        document.getElementById('licenseForm').addEventListener('submit', function() {
            document.getElementById('spinner').style.display = 'flex';
        });
    </script>
@endsection
