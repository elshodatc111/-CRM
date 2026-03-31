@extends('layouts.admin')

@section('title', __('menu.emploesLead'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('menu.emploesLead') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.emploesLead') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6">
      <div style="text-align: right">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_emploesLead">
          <i class="bi bi-person-plus me-1"></i> {{ __('emploesLead_page.add_new') }}
        </button>
      </div>
    </div>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('menu.emploesLead') }}</h5>
            
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size: 12px;">
                <thead>
                  <tr class="text-center bg-light">
                    <th>#</th>
                    <th>{{ __('emploes_page.fio') }}</th>
                    <th>{{ __('emploes_page.phone') }}</th>
                    <th>{{ __('emploes_page.position') }}</th>
                    <th>{{ __('emploes_page.status') }}</th>
                    <th>{{ __('emploes_page.hired_date') }}</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Bu yerga kelajakda statistika vidjetlarini qo'shishingiz mumkin --}}
      
    </div>
  </section>




  <div class="modal fade" id="create_emploesLead" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>{{ __('emploesLead_page.create_emploesLead') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body p-4">
          <input type="hidden" name="user_id" id="modal_user_id">

          <div class="row g-4"> {{-- 'g-4' oraliqni biroz kattalashtiradi --}}
            {{-- Yangi parol --}}
            <div class="col-md-6"> {{-- 'col-md-6' qilib yonma-yon qo'yish ham mumkin keng modalda --}}
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