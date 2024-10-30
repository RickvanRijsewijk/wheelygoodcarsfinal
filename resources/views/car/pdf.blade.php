
<head>
    <title>Car Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .car-details {
            margin: 20px;
        }
        .car-details h1 {
            text-align: center;
        }
        .car-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .car-details table, .car-details th, .car-details td {
            border: 1px solid black;
        }
        .car-details th, .car-details td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="car-details">
        <h1>Auto gegevens</h1>
        <table>
            <tr>
                <th>Merk</th>
                <td>{{ $car->brand }}</td>
            </tr>
            <tr>
                <th>Model</th>
                <td>{{ $car->model }}</td>
            </tr>
            <tr>
                <th>Nummerplaat</th>
                <td>{{ $car->license_plate }}</td>
            </tr>
            <tr>
                <th>Verkoper</th>
                <td>{{ $car->user->name }}</td>
            </tr>
            <tr>
                <th>Kilometerstand</th>
                <td>{{ $car->mileage }} km</td>
            </tr>
            <tr>
                <th>Verkoop prijs</th>
                <td>€{{ number_format($car->price, 2) }}</td>
            </tr>
            <tr>
                <th>Kleur</th>
                <td>{{ $car->color }}</td>
            </tr>
            <tr>
                <th>Bouwjaar</th>
                <td>{{ $car->production_year }}</td>
            </tr>
            <tr>
                <th>Te koop gesteld op</th>
                <td>{{ $car->created_at }}</td>
            </tr>
            <tr>
                <th>Stoelen</th>
                <td>{{ $car->seats }}</td>
            </tr>
            <tr>
                <th>Deuren</th>
                <td>{{ $car->doors }}</td>
            </tr>
            <tr>
                <th>Massa rijklaar</th>
                <td>{{ $car->weight }} kg</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $car->status }}</td>
            </tr>
            <!-- Add more fields as needed -->
        </table>
    </div>
</body>
