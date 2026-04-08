@extends('layouts.admin')

@section('title', __('emploes_lead_page_show.davomad_tarixi'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('emploes_lead_page_show.davomad_tarixi') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('groups_index') }}">{{ __('menu.groups') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('groups_show',$array['groupId']) }}">{{ __('group_show.title') }}</a></li>
        <li class="breadcrumb-item active">{{ __('emploes_lead_page_show.davomad_tarixi') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="card info-card welcome-card">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h5 class="card-title">{{ $array['group_name'] }}</h5>
          </div>
          <div class="col-4" style="text-align: right">
            <h5 class="card-title">{{ $array['monch'] }}</h5>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
                <th>{{ __('emploes_lead_page_show.bolalar') }}</th>
                @foreach ($array['kunlar'] as $item)
                  <th style="font-size:12px;" class="text-center">{{ $item }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($array['davomad'] as $key => $item)
                <tr>
                  <td>{{ $item[$key+1]['name'] }}</td>
                  @foreach ($item as $value)
                    <td class="text-center">
                      @if($value['status']=='-')
                        <span class="badge bg-secondary p-1"><i class="bi bi-link-45deg"></i></span>
                      @elseif($value['status']=='keldi')
                        <span class="badge bg-success p-1"><i class="bi bi-person-check"></i></span>
                        @elseif($value['status']=='kelmadi')
                        <span class="badge bg-danger p-1"><i class="bi bi-person-x"></i></span>
                        @else
                        <span class="badge bg-warning p-1"><i class="bi bi-person-plus"></i></span>
                      @endif
                    </td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
@endsection