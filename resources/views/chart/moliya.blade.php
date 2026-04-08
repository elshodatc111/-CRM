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
        <h5 class="card-title">Sarlovha</h5>
        
        sdasda
      </div>
    </div>
  </section>


@endsection