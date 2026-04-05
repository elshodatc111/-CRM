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
        @include('group.davomad')
      </div>
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">Sarlovha</h5>
          </div>
        </div>
      </div>
      
      
    </div>
  </section>

@endsection