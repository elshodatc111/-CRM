@extends('layouts.admin')

@section('title', __('menu.dashboard'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.dashboard') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.dashboard') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">Sarlovha</h5>
            
            sdasda
          </div>
        </div>
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