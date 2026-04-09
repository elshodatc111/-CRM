@extends('layouts.admin')

@section('title', __('menu.chart_child'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.chart_child') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.chart_child') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section chart_child">

    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('charts.kunlik_davomad') }}</h5>
        <canvas id="kunlikDavomad" style="max-height: 400px;"></canvas>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const ctx = document.querySelector('#kunlikDavomad').getContext('2d');
            const dayLabels = @json(collect($tenDay['days'])->pluck('short_date'));
            const dataKeldi = @json($tenDay['keldi']);
            const dataKechikdi = @json($tenDay['kechikdi']);
            const dataKelmadi = @json($tenDay['kelmadi']);
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: dayLabels,
                datasets: [
                  {
                    label: "Keldi",
                    data: dataKeldi,
                    backgroundColor: 'rgba(46, 202, 106, 0.7)', // Yashil
                    borderColor: 'rgb(46, 202, 106)',
                    borderWidth: 1
                  },
                  {
                    label: 'Kechikdi',
                    data: dataKechikdi,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                  },
                  {
                    label: 'Kelmadi',
                    data: dataKelmadi,
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
                          label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y);
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

    
    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('charts.oylik_davomad') }}</h5>
        <canvas id="oylikDavomad" style="max-height: 400px;"></canvas>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const ctx = document.querySelector('#oylikDavomad').getContext('2d');
            const dayLabels = @json(collect($tenMonth['months'])->pluck('short_date'));
            const dataKeldi = @json($tenMonth['keldi']);
            const dataKechikdi = @json($tenMonth['kechikdi']);
            const dataKelmadi = @json($tenMonth['kelmadi']);
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: dayLabels,
                datasets: [
                  {
                    label: "Keldi",
                    data: dataKeldi,
                    backgroundColor: 'rgba(46, 202, 106, 0.7)', // Yashil
                    borderColor: 'rgb(46, 202, 106)',
                    borderWidth: 1
                  },
                  {
                    label: 'Kechikdi',
                    data: dataKechikdi,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                  },
                  {
                    label: 'Kelmadi',
                    data: dataKelmadi,
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
                          label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y);
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

  </section>




 <div class="modal fade" id="create_emploes" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>{{ __('emploes_page.parolni_yangilash') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-4">
          <input type="hidden" name="user_id" id="modal_user_id">

          <div class="row g-4">
            <div class="col-md-6">
              <label for="new_password" class="form-label fw-bold">{{ __('auth.password') }}</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-key text-primary"></i></span>
                <input type="password" name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="new_password" 
                       placeholder="******"
                       required>
                <button class="btn btn-outline-secondary toggle-password" type="button">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- Parolni tasdiqlash --}}
            <div class="col-md-6">
              <label for="password_confirmation" class="form-label fw-bold">{{ __('auth.password_confirm') }}</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-check2-circle text-success"></i></span>
                <input type="password" name="password_confirmation" 
                       class="form-control" 
                       id="password_confirmation" 
                       placeholder="******"
                       required>
              </div>
            </div>
          </div>

          <div class="mt-4 p-3 bg-light rounded border-start border-primary border-4">
             <small class="text-dark">
               <i class="bi bi-info-circle-fill text-primary me-1"></i> 
               <strong>Eslatma:</strong> {{ __('auth.password_min_error') }}
             </small>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">
            {{ __('emploes_page.cancel') }}
          </button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> {{ __('emploes_page.save') }}
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection