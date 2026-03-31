@extends('layouts.admin')

@section('title', 'UMKA Kindergarten CRM')

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

      {{-- Xush kelibsiz kartasi --}}
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('dashboard.welcome_title') }} <span>| {{ Auth::user()->role }}</span></h5>
            
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light">
                <i class="bi bi-person-check text-primary" style="font-size: 2rem;"></i>
              </div>
              <div class="ps-3">
                <h6>{{ Auth::user()->name }}</h6>
                <p class="text-muted small pt-2 ps-1 mb-0">
                  {{ __('dashboard.login_success_msg') }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Bu yerga kelajakda statistika vidjetlarini qo'shishingiz mumkin --}}
      
    </div>
  </section>
@endsection