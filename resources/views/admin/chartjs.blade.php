<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .chart-box {
            flex: 1;
            max-width: 45%;
            min-width: 300px;
            margin: 10px;
        }
        .chart-box canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
<div class="chart-container">
    <div class="chart-box">
        <h2>Total Orders per Day</h2>
        <canvas id="ordersChart"></canvas>
    </div>
    <div class="chart-box">
        <h2>Total Quantity of Products Sold</h2>
        <canvas id="productsChart"></canvas>
    </div>
    <div class="chart-box">
        <h2>Monthly Revenue</h2>
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ordersCtx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Orders',
                    data: @json($data),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var productsCtx = document.getElementById('productsChart').getContext('2d');
        var productsChart = new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: @json($productLabels),
                datasets: [{
                    label: 'Total Quantity Sold',
                    data: @json($productData),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                            callback: function(value) {
                                return value.length > 10 ? value.substring(0, 10) + '...' : value;
                            }
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($revenueLabels),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: @json($revenueData),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</body>
</html>
