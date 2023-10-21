@extends('layouts.app', [
'namePage' => 'Dashboard',
'class' => 'login-page sidebar-mini ',
'activePage' => 'home',
'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@section('title','Dashboard')
@section('content')
<div class="panel-header panel-header-sm">
</div>
<br>
<br>
<div class="content">
    <!-- <canvas id="order-chart" width="400" height="200"></canvas> -->
    <canvas id="revenue-chart" width="400" height="200"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    // Menggunakan data dari controller
    var revenueData = {
        labels: @json($labels), // Menggunakan data label bulan dari controller
        datasets: [{
            label: 'Pemasukan',
            data: @json($data), // Menggunakan data pemasukan dari controller
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Membuat grafik Pemasukan
    var revenueChartCanvas = document.getElementById('revenue-chart').getContext('2d');
    var revenueChart = new Chart(revenueChartCanvas, {
        type: 'bar',
        data: revenueData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


@endsection

@push('js')
@endpush