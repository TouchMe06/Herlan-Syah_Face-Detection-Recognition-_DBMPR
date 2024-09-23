@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Tamu
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalTamu }}</h5>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Tamu Hari ini
                                </p>
                                <h5 class="font-weight-bolder">{{ $tamuHariIni }}</h5>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fas fa-calendar-week text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pegawai
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalPegawai }}</h5>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                                <i class="fas fa-user-tie text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Unit Kerja
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalUnitKerja }}</h5>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-secondary shadow-danger text-center rounded-circle">
                                <i class="fas fa-building text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-xl-6 col-md-6 mb-xl-0 mb-3">
            <div class="card">
                <div class="card-body">
                    <canvas id="tamuPerBulanChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabs navigation pertanyaan -->
        <div class="col-xl-6 col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        @foreach ($jawabanData as $pertanyaan => $data)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if ($loop->first) active @endif"
                                    id="tab-{{ Str::slug($pertanyaan) }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#tab-{{ Str::slug($pertanyaan) }}" type="button" role="tab"
                                    aria-controls="tab-{{ Str::slug($pertanyaan) }}" aria-selected="true">
                                    Pertanyaan {{ $loop->iteration }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Tabs content -->
                <div class="card-body tab-content" id="myTabContent">
                    @foreach ($jawabanData as $pertanyaan => $data)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="tab-{{ Str::slug($pertanyaan) }}" role="tabpanel"
                            aria-labelledby="tab-{{ Str::slug($pertanyaan) }}-tab">
                            <p class="text-center fs-5">{{ $pertanyaan }}</p>
                            <div style="width: 50%; margin: auto">
                                <canvas id="chart_{{ Str::slug($pertanyaan) }}"></canvas>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Chart Tamu Total Tamu Perbulan
            var tamuPerBulanCtx = document.getElementById('tamuPerBulanChart').getContext('2d');
            new Chart(tamuPerBulanCtx, {
                type: 'bar',
                data: {
                    // labels: {!! json_encode($tamuPerBulan->pluck('month_name')) !!},
                    labels: {!! json_encode($tamuPerBulan->pluck('month_year')) !!},
                    datasets: [{
                        label: 'Total Tamu Per Bulan',
                        data: {!! json_encode($tamuPerBulan->pluck('total')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Total Tamu Per Bulan'
                        }
                    }
                }
            });

            // Chart Jawaban Survey
            @foreach ($jawabanData as $pertanyaan => $data)
                var ctx = document.getElementById('chart_{{ Str::slug($pertanyaan) }}').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($data->toArray())) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($data->toArray())) !!},
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        var total = tooltipItem.dataset.data.reduce(function(a, b) {
                                            return a + b;
                                        }, 0);
                                        var value = tooltipItem.raw;
                                        // var percentage = ((value / total) * 100).toFixed(2);
                                        var percentage = Math.round((value / total) * 100);
                                        return tooltipItem.label + ': ' + percentage + '%';
                                    }
                                }
                            },
                        }
                    }
                });
            @endforeach
        });
    </script>
@endsection
