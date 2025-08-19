@extends('Admin::layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Total Profit -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL PROFIT</h6>
                            <h3 class="card-value">₹{{ number_format($Total_commissions, 2) }}</h3>
                        </div>
                        <div class="bg-primary rounded-circle p-3">
                            <i class="fas fa-coins text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Stores -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL STORES</h6>
                            <h3 class="card-value">{{ $Total_stores }}</h3>
                        </div>
                        <div class="bg-success rounded-circle p-3">
                            <i class="fas fa-store text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Store Requests -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">NEW STORE REQUESTS</h6>
                            <h3 class="card-value">10</h3>
                        </div>
                        <div class="bg-warning rounded-circle p-3">
                            <i class="fas fa-store-alt text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL ORDERS</h6>
                            <h3 class="card-value">{{ $Total_orders }}</h3>
                        </div>
                        <div class="bg-info rounded-circle p-3">
                            <i class="fas fa-box-open text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL PRODUCTS</h6>
                            <h3 class="card-value">{{ $Total_products }}</h3>
                        </div>
                        <div class="bg-info rounded-circle p-3">
                            <i class="fas fa-cubes text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawal Requests -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL WITHDRAWAL REQUESTS</h6>
                            <h3 class="card-value">0</h3>
                        </div>
                        <div class="bg-danger rounded-circle p-3">
                            <i class="fas fa-hand-holding-usd text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Tickets -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">SUPPORT TICKETS</h6>
                            <h3 class="card-value">0</h3>
                        </div>
                        <div class="bg-secondary rounded-circle p-3">
                            <i class="fas fa-headset text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refund Requests -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title">TOTAL REFUND REQUESTS</h6>
                            <h3 class="card-value">10</h3>
                        </div>
                        <div class="bg-warning rounded-circle p-3">
                            <i class="fas fa-undo-alt text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Bar Chart Card -->
        <div class="col-lg-6 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Bar Chart</h6>
                    <div class="chart-container" style="position: relative; height: 450px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Chart Card -->
        <div class="col-lg-6 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Line Chart</h6>
                    <div class="chart-container" style="position: relative; height: 450px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bar Chart
            const barCtx = document.getElementById('barChart').getContext('2d');
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales',
                        data: [120, 150, 180, 200, 170, 190],
                        backgroundColor: 'rgba(26, 188, 156, 0.5)', // Updated to use primary color
                        borderColor: '#1abc9c', // Updated to use primary color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: true
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Line Chart
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue',
                        data: [300, 400, 350, 450, 500, 550],
                        borderColor: '#1abc9c', // Updated to use primary color
                        backgroundColor: 'rgba(26, 188, 156, 0.1)', // Updated to use primary color
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointBackgroundColor: '#1abc9c' // Updated to use primary color
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: true
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection