@extends('layouts.admin')

@section('title', __('menu.my_profile'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.my_profile') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.my_profile') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('menu.my_profile') }}</h5>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.fio') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->name }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.phone') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->phone }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.phone_two') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">
                    {{ Auth::user()->phone_two }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.addres') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->addres }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.tkun') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->tkun->format('Y-m-d') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.pus_num') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->pasport }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-4 col-md-5 label">{{ __('auth.role') }}:</div>
                <div class="col-lg-8 col-md-7" style="text-align: right">{{ Auth::user()->role }}</div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('auth.pass_update') }}</h5>
            <form method="POST" action="{{ route('password_update') }}">
              @csrf 
              <div class="row mb-2 mx-0">
                  <label for="current_password" class="mb-2">{{ __('auth.j_parol') }}</label>
                  <input type="password" name="current_password" id="current_password" class="form-control" required>
              </div>
              <div class="row mb-2 mx-0">
                  <label for="password" class="mb-2">{{ __('auth.n_parol') }}</label>
                  <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="row mb-2 mx-0">
                  <label for="password_confirmation" class="mb-2">{{ __('auth.t_parol') }}</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
              </div>
              <div class="text-center mx-0 mt-2">
                  <button type="submit" class="btn btn-primary w-100"> {{ __('auth.pass_update') }} </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </section>
@endsection