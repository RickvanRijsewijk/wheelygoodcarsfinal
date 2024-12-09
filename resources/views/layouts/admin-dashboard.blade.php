<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #overviewChart {
            max-width: 3000px;
            max-height: 3000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark d-print-none bg-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><strong class="text-primary">Wheely</strong> good
                cars<strong class="text-primary">!</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('alle-autos') }}">Alle auto's</a>
                    </li>
                    @auth
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('mijn-aanbod') }}">Mijn
                                aanbod</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('aanbod-plaatsen') }}">Aanbod
                                plaatsen</a></li>
                    @endauth
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('register') }}">Registreren</a></li>
                        <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('login') }}">Inloggen</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('logout') }}">Uitloggen</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="overviewChart"></canvas>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="totalCarsChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="soldCarsChart"></canvas>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="todayCarsChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="providersChart"></canvas>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="viewsTodayChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="avgCarsPerProviderChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const totalCarsChartCtx = document.getElementById('totalCarsChart').getContext('2d');
            const soldCarsChartCtx = document.getElementById('soldCarsChart').getContext('2d');
            const todayCarsChartCtx = document.getElementById('todayCarsChart').getContext('2d');
            const providersChartCtx = document.getElementById('providersChart').getContext('2d');
            const viewsTodayChartCtx = document.getElementById('viewsTodayChart').getContext('2d');
            const avgCarsPerProviderChartCtx = document.getElementById('avgCarsPerProviderChart').getContext('2d');
            const overviewChartCtx = document.getElementById('overviewChart').getContext('2d');

            let totalCarsChart, soldCarsChart, todayCarsChart, providersChart, viewsTodayChart, avgCarsPerProviderChart, overviewChart;

            function initializeCharts(data) {
                totalCarsChart = new Chart(totalCarsChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Total Cars'],
                        datasets: [{
                            label: 'Aantal auto\'s aangeboden',
                            data: [data.totalCars],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                soldCarsChart = new Chart(soldCarsChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Sold Cars'],
                        datasets: [{
                            label: 'Aantal verkocht',
                            data: [data.soldCars],
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                todayCarsChart = new Chart(todayCarsChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Today\'s Cars'],
                        datasets: [{
                            label: 'Aantal vandaag aangeboden',
                            data: [data.todayCars],
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                providersChart = new Chart(providersChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Providers'],
                        datasets: [{
                            label: 'Aantal aanbieders',
                            data: [data.providers],
                            backgroundColor: 'rgba(255, 206, 86, 0.5)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                viewsTodayChart = new Chart(viewsTodayChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Views Today'],
                        datasets: [{
                            label: 'Aantal views vandaag',
                            data: [data.viewsToday],
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                avgCarsPerProviderChart = new Chart(avgCarsPerProviderChartCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Avg Cars per Provider'],
                        datasets: [{
                            label: 'Gemiddeld aantal auto\'s per aanbieder',
                            data: [data.avgCarsPerProvider],
                            backgroundColor: 'rgba(255, 159, 64, 0.5)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                overviewChart = new Chart(overviewChartCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Total Cars', 'Sold Cars', 'Today\'s Cars', 'Providers', 'Views Today', 'Avg Cars per Provider'],
                        datasets: [{
                            label: 'Overview',
                            data: [data.totalCars, data.soldCars, data.todayCars, data.providers, data.viewsToday, data.avgCarsPerProvider],
                            backgroundColor: [
                                'rgb(75 192 192 / 0.5)',
                                'rgb(255 99 133 / 0.5)',
                                'rgb(96 235 54 / 0.5)',
                                'rgba(255 207 86 / 0.5)',
                                'rgba(153 102 255 / 0.5)',
                                'rgba(255 160 64 / 0.5)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(60 150 0 / 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += context.parsed;
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function updateCharts(data) {
                totalCarsChart.data.datasets[0].data = [data.totalCars];
                totalCarsChart.update();

                soldCarsChart.data.datasets[0].data = [data.soldCars];
                soldCarsChart.update();

                todayCarsChart.data.datasets[0].data = [data.todayCars];
                todayCarsChart.update();

                providersChart.data.datasets[0].data = [data.providers];
                providersChart.update();

                viewsTodayChart.data.datasets[0].data = [data.viewsToday];
                viewsTodayChart.update();

                avgCarsPerProviderChart.data.datasets[0].data = [data.avgCarsPerProvider];
                avgCarsPerProviderChart.update();

                overviewChart.data.datasets[0].data = [data.totalCars, data.soldCars, data.todayCars, data.providers, data.viewsToday, data.avgCarsPerProvider];
                overviewChart.update();
            }

            function fetchData() {
                $.ajax({
                    url: '{{ route('admin.dashboard-data') }}',
                    method: 'GET',
                    success: function (data) {
                        if (!totalCarsChart) {
                            initializeCharts(data);
                        } else {
                            updateCharts(data);
                        }
                    }
                });
            }

            fetchData();
            setInterval(fetchData, 5000);
        });
    </script>
</body>
</html>
