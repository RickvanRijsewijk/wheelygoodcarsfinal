<!-- resources/views/layouts/next-page.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
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

        .form-group .readonly-field {
            background-color: #eee;
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

        .license-plate {
            background-color: #ffd700;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .submit-button {
            background-color: #d2691e;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .submit-button:hover {
            background-color: #c15a1b;
        }
    </style>
</head>

@extends('layouts.app')

@section('content')
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
        <div class="license-plate">{{ $inputText }}</div>

        <!-- Display prefilled form field -->
        <form action="{{ route('aanbod.toDB') }}" method="POST">
            @csrf

            <input style="display: none" type="text" value="{{ $inputText }}" name="license_plate">

            <!-- Merk -->
            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" id="brand" name="brand" class="readonly-field">
            </div>

            <!-- Model -->
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" id="model" name="model" class="readonly-field">
            </div>

            <!-- Inline group for Zitplaatsen, Aantal deuren, Massa rijklaar -->
            <div class="form-group inline-group">
                <div class="form-group small-input">
                    <label for="zitplaatsen">Zitplaatsen</label>
                    <input type="text" id="zitplaatsen" name="zitplaatsen" class="readonly-field">
                </div>
                <div class="form-group small-input">
                    <label for="aantal_deuren">Aantal deuren</label>
                    <input type="text" id="aantal_deuren" name="aantal_deuren" class="readonly-field">
                </div>
                <div class="form-group small-input">
                    <label for="massa_rijklaar">Massa rijklaar</label>
                    <input type="text" id="massa_rijklaar" name="massa_rijklaar" class="readonly-field">
                </div>
            </div>

            <!-- Inline group for Jaar van productie, Kleur -->
            <div class="form-group inline-group">
                <div class="form-group">
                    <label for="jaar_van_productie">Jaar van productie</label>
                    <input type="text" id="production_year" name="production_year">
                </div>
                <div class="form-group">
                    <label for="kleur">Kleur</label>
                    <input type="text" id="color" name="color">
                </div>
            </div>

            <!-- Kilometerstand -->
            <div class="form-group">
                <label for="kilometerstand">Kilometerstand</label>
                <input type="text" id="mileage" name="mileage">
            </div>

            <!-- Vraagprijs -->
            <div class="form-group">
                <label for="vraagprijs">Vraagprijs</label>
                <input type="text" id="price" name="price">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Aanbod afronden</button>
        </form>
    </div>
@endsection

</html>
