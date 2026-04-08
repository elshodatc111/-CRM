@extends('layouts.admin')

@section('title', __('menu.chart_payment'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.chart_payment') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.chart_payment') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('charts.payment_days') }}</h5>
          <canvas id="kunlikTolov" style="max-height: 400px;"></canvas>
          <script>
              document.addEventListener("DOMContentLoaded", () => {
                  const ctx = document.querySelector('#kunlikTolov').getContext('2d');
                  const dayLabels = @json(collect($tenDayData['days'])->pluck('chart_format'));
                  const dataPayment = @json($tenDayData['payment']);
                  const dataDiscount = @json($tenDayData['descount']);
                  const dataReturn = @json($tenDayData['return']);
                  new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: dayLabels,
                          datasets: [
                              {
                                  label: "To'lovlar",
                                  data: dataPayment,
                                  backgroundColor: 'rgba(46, 202, 106, 0.7)', // Yashil
                                  borderColor: 'rgb(46, 202, 106)',
                                  borderWidth: 1
                              },
                              {
                                  label: 'Chegirmalar',
                                  data: dataDiscount,
                                  backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                                  borderColor: 'rgb(255, 159, 64)',
                                  borderWidth: 1
                              },
                              {
                                  label: 'Qaytarilgan',
                                  data: dataReturn,
                                  backgroundColor: 'rgba(255, 99, 132, 0.7)', // Qizil
                                  borderColor: 'rgb(255, 99, 132)',
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
        <h5 class="card-title">{{ __('charts.payment_months') }}</h5>
          <canvas id="oylikTolov" style="max-height: 400px;"></canvas>
          <script>
              document.addEventListener("DOMContentLoaded", () => {
                  const ctx = document.querySelector('#oylikTolov').getContext('2d');
                  const dayLabels = @json(collect($tenMonthData['months'])->pluck('chart_format'));
                  const dataPayment = @json($tenMonthData['payment']);
                  const dataDiscount = @json($tenMonthData['descount']);
                  const dataReturn = @json($tenMonthData['return']);
                  new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: dayLabels,
                          datasets: [
                              {
                                  label: "To'lovlar",
                                  data: dataPayment,
                                  backgroundColor: 'rgba(46, 202, 106, 0.7)', // Yashil
                                  borderColor: 'rgb(46, 202, 106)',
                                  borderWidth: 1
                              },
                              {
                                  label: 'Chegirmalar',
                                  data: dataDiscount,
                                  backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                                  borderColor: 'rgb(255, 159, 64)',
                                  borderWidth: 1
                              },
                              {
                                  label: 'Qaytarilgan',
                                  data: dataReturn,
                                  backgroundColor: 'rgba(255, 99, 132, 0.7)', // Qizil
                                  borderColor: 'rgb(255, 99, 132)',
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