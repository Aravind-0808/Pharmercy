@extends('admin::layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Total Earning Card -->
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card card-statistic">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">TOTAL EARNING</h6>
                        <h3 class="card-value">$500.00</h3>
                    </div>
                    <div class="bg-primary rounded-circle p-3">
                        <i class="fas fa-dollar-sign text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Growth Card -->
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card card-statistic">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">TOTAL GROWTH</h6>
                        <h3 class="card-value">$2,324.00</h3>
                    </div>
                    <div class="bg-success rounded-circle p-3">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Order Card -->
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card card-statistic">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">TOTAL ORDER</h6>
                        <h3 class="card-value">108</h3>
                        <p class="text-muted mb-0">Today</p>
                    </div>
                    <div class="bg-warning rounded-circle p-3">
                        <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Income Card -->
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card card-statistic">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">TOTAL INCOME</h6>
                        <h3 class="card-value">$203k</h3>
                    </div>
                    <div class="bg-info rounded-circle p-3">
                        <i class="fas fa-wallet text-white"></i>
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
    document.addEventListener('DOMContentLoaded', function() {
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