@extends('layouts.admin')

@section('title', __('menu.chart_lead'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.chart_lead') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.chart_lead') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section chart_lead">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">{{ __('charts.lead_joriy_hafta') }}</h5>
            <div id="joriy_hafta"></div>
            <div class="funnel-stats-container">
              <div class="stat-block">
                <div class="indicator" style="background-color: #f3a683"></div>
                <span class="stat-number">{{ $hafta['lead'] }}</span>
                <span class="stat-text">Lidlar</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #f19066"></div>
                <span class="stat-number">{{ $hafta['pending'] }}</span>
                <span class="stat-text">Jarayonda</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #cf6a87"></div>
                <span class="stat-number">{{ $hafta['cancel'] }}</span>
                <span class="stat-text">Rad etildi</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #778beb"></div>
                <span class="stat-number">{{ $hafta['success'] }}</span>
                <span class="stat-text">Qabul qilindi</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">{{ __('charts.lead_joriy_oy') }}</h5>
            <div id="joriy_oy"></div>
            <div class="funnel-stats-container">
              <div class="stat-block">
                <div class="indicator" style="background-color: #f3a683"></div>
                <span class="stat-number">{{ $oylik['lead'] }}</span>
                <span class="stat-text">Lidlar</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #f19066"></div>
                <span class="stat-number">{{ $oylik['pending'] }}</span>
                <span class="stat-text">Jarayonda</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #cf6a87"></div>
                <span class="stat-number">{{ $oylik['cancel'] }}</span>
                <span class="stat-text">Rad etildi</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #778beb"></div>
                <span class="stat-number">{{ $oylik['success'] }}</span>
                <span class="stat-text">Qabul qilindi</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">{{ __('charts.lead_joriy_yil') }}</h5>
            <div id="joriy_yil"></div>
            <div class="funnel-stats-container">
              <div class="stat-block">
                <div class="indicator" style="background-color: #f3a683"></div>
                <span class="stat-number">{{ $yillik['lead'] }}</span>
                <span class="stat-text">Lidlar</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #f19066"></div>
                <span class="stat-number">{{ $yillik['pending'] }}</span>
                <span class="stat-text">Jarayonda</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #cf6a87"></div>
                <span class="stat-number">{{ $yillik['cancel'] }}</span>
                <span class="stat-text">Rad etildi</span>
              </div>
              <div class="stat-block">
                <div class="indicator" style="background-color: #778beb"></div>
                <span class="stat-number">{{ $yillik['success'] }}</span>
                <span class="stat-text">Qabul qilindi</span>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">{{ __('charts.oxirgiOltiOy') }}</h2>
              <canvas id="statistika" style="max-height: 450px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const ctx = document.querySelector('#statistika').getContext('2d');
                  const monthLabels = @json(collect($sexMonch['monchs'])->pluck('month_name'));
                  const monthAll = @json(collect($sexMonch['all']));
                  const monthSuccess = @json(collect($sexMonch['success']));
                  const monthCancel = @json(collect($sexMonch['cancel']));
                  new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: monthLabels,
                      datasets: [
                        {
                          label: "Lead",
                          data: monthAll,
                          backgroundColor: 'rgba(255, 159, 64, 0.7)', // Yashil
                          borderColor: 'rgb(255, 159, 64)',
                          borderWidth: 1
                        },
                        {
                          label: 'Qabul qilindi',
                          data: monthSuccess,
                          backgroundColor: 'rgba(46, 202, 106, 0.7)', // To'q sariq
                          borderColor: 'rgb(46, 202, 106)',
                          borderWidth: 1
                        },
                        {
                          label: 'Bekor qilindi',
                          data: monthCancel,
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
                                label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y) + " ";
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
                              return new Intl.NumberFormat('uz-UZ').format(value);
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
        </div>
    </div>
  </section>
<style>
  .funnel-stats-container {display: flex;justify-content: space-between;gap: 10px;margin-top: 20px;padding: 10px 5px;background: #fdfdfd;border-radius: 8px;}
  .stat-block {flex: 1;display: flex;flex-direction: column;align-items: center;padding: 10px 5px;border-right: 1px solid #eee;transition: all 0.3s ease;}
  .stat-block:last-child {border-right: none;}
  .stat-block:hover {background: #f8f9ff;border-radius: 5px;}
  .stat-number {font-weight: 800;font-size: 1.2rem;color: #333;line-height: 1;margin-bottom: 5px;}
  .stat-text {color: #888;font-size: 0.75rem;text-transform: uppercase;letter-spacing: 0.5px;margin-bottom: 8px;text-align: center;}
  .stat-percent {font-weight: 600;color: #4154f1;background: #f0f2ff;padding: 2px 8px;border-radius: 20px;font-size: 0.7rem;}
  .indicator {width: 8px;height: 8px;border-radius: 50%;margin-bottom: 8px;}
  .apexcharts-canvas {margin: 0 auto;}
</style>
<script>
  document.addEventListener("DOMContentLoaded", () => {
      const funnelOptions = (data, title) => ({
          series: [{ name: title, data: data.map(Number) }],
          chart: { type: 'bar', height: 280, toolbar: {show: false},sparkline: { enabled: false }},
          plotOptions: {bar: {borderRadius: 8,horizontal: true,barHeight: '75%',isFunnel: true,distributed: true,},},
          colors: ["#f3a683","#f19066","#cf6a87","#778beb"],
          dataLabels: {enabled: true,formatter: function (val, opt) {
                  let total = opt.w.globals.series[0].reduce((a, b) => a + b, 0);
                  return total > 0 ? ((val / total) * 100).toFixed(1) + '%' : '0%';},
              style: {fontSize: '12px',fontWeight: 'bold',colors: ['#fff']},
              dropShadow: { enabled: true }},
          xaxis: {categories: ["Lidlar","Jarayonda","Rad etildi","Qabul qilindi"],labels: { show: false },axisBorder: { show: false },axisTicks: { show: false }},
          grid: { show: false },
          legend: { show: false },
          tooltip: {enabled: true,y: {formatter: function(val) { return val + " ta ariza" }}}
      });
      new ApexCharts(document.querySelector("#joriy_hafta"), funnelOptions([{{ $hafta['lead'].",".$hafta['pending'].",".$hafta['cancel'].",".$hafta['success'] }}], "Lead")).render();
      new ApexCharts(document.querySelector("#joriy_oy"), funnelOptions([{{ $oylik['lead'].",".$oylik['pending'].",".$oylik['cancel'].",".$oylik['success'] }}], "Lead")).render();
      new ApexCharts(document.querySelector("#joriy_yil"), funnelOptions([{{ $yillik['lead'].",".$yillik['pending'].",".$yillik['cancel'].",".$yillik['success'] }}], "Lead")).render();
  });
</script>
@endsection