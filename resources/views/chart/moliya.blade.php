@extends('layouts.admin')

@section('title', __('menu.chart_moliya'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.chart_moliya') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.chart_moliya') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section chart_moliya">
    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('charts.moliya_ten_day') }}</h5>
        <canvas id="kunlikTolov" style="max-height: 400px;"></canvas>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const ctx = document.querySelector('#kunlikTolov').getContext('2d');
            const dayLabels = @json(collect($tenMoliya['days'])->pluck('short_date'));
            const dataPayment = @json($tenMoliya['tulovlar']);
            const dataXarajat = @json($tenMoliya['xarajatlar']);
            const dataQaytarildi = @json($tenMoliya['qaytarildi']);
            const dataDaromad = @json($tenMoliya['daromad']);
            const dataIshXaqi = @json($tenMoliya['ishHaqi']);
            const dataSubsidiya = @json($tenMoliya['subToBalans']);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dayLabels,
                    datasets: [
                        {
                            label: "To'lovlar",
                            data: dataPayment,
                            backgroundColor: 'rgba(46, 202, 106, 0.5)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                        {
                            label: 'Xarajatlar',
                            data: dataXarajat,
                            backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                        },
                        {
                            label: "Subsidiya",
                            data: dataSubsidiya,
                            backgroundColor: 'rgba(40, 229, 50, 0.7)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ish haqi',
                            data: dataIshXaqi,
                            backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                        },
                        {
                            label: 'Qaytarildi',
                            data: dataQaytarildi,
                            backgroundColor: 'rgba(255, 99, 132, 0.7)', // Qizil
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1
                        },
                        {
                            label: "Daromad",
                            data: dataDaromad,
                            backgroundColor: 'rgba(46, 202, 106, 0.9)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) label += ': ';
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y) + " UZS";
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('uz-UZ').format(value) + " UZS";
                                }
                            }
                        }
                    }
                }
            });
          });
        </script>
      </div>
    </div>
    
    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('charts.moliya_ten_monch') }}</h5>
        <canvas id="oylikTolov" style="max-height: 400px;"></canvas>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const ctx = document.querySelector('#oylikTolov').getContext('2d');
            const dayLabels = @json(collect($tenMonchMoliya['months'])->pluck('short_date'));
            const dataPayment = @json($tenMonchMoliya['tulovlar']);
            const dataXarajat = @json($tenMonchMoliya['xarajatlar']);
            const dataQaytarildi = @json($tenMonchMoliya['qaytarildi']);
            const dataDaromad = @json($tenMonchMoliya['daromad']);
            const dataIshXaqi = @json($tenMonchMoliya['ishHaqi']);
            const dataSubsidiya = @json($tenMonchMoliya['subToBalans']);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dayLabels,
                    datasets: [
                        {
                            label: "To'lovlar",
                            data: dataPayment,
                            backgroundColor: 'rgba(46, 202, 106, 0.5)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                        {
                            label: 'Xarajatlar',
                            data: dataXarajat,
                            backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                        },
                        {
                            label: "Subsidiya",
                            data: dataSubsidiya,
                            backgroundColor: 'rgba(40, 229, 50, 0.7)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ish haqi',
                            data: dataIshXaqi,
                            backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                        },
                        {
                            label: 'Qaytarildi',
                            data: dataQaytarildi,
                            backgroundColor: 'rgba(255, 99, 132, 0.7)', // Qizil
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1
                        },
                        {
                            label: "Daromad",
                            data: dataDaromad,
                            backgroundColor: 'rgba(46, 202, 106, 0.9)', // Yashil
                            borderColor: 'rgb(46, 202, 106)',
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) label += ': ';
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y) + " UZS";
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('uz-UZ').format(value) + " UZS";
                                }
                            }
                        }
                    }
                }
            });
          });
        </script>
      </div>
    </div>
  </section>


@endsection