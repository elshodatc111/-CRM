@extends('layouts.admin')

@section('title', __('tkun.title'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('tkun.title') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('tkun.title') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('tkun.joriy_hafta') }}</h5>
            <table class="table table-bordered" style="font-size:12px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>{{ __('tkun.child')}}</th>
                  <th>{{ __('tkun.tkun_data')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($currentWeekBirthdays as $item)
                  <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td class="text-center">{{ date('Y-m-d', strtotime($item['tkun'])) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan=3>{{ __('tkun.not_joriy_hafta') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('tkun.nect_hafta') }}</h5>
            <table class="table table-bordered" style="font-size:12px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>{{ __('tkun.child')}}</th>
                  <th>{{ __('tkun.tkun_data')}}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($nextWeekBirthdays as $item)
                  <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td class="text-center">{{ date('Y-m-d', strtotime($item['tkun'])) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan=3>{{ __('tkun.not_next_hafta') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection