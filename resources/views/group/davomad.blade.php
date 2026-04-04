@extends('layouts.admin')

@section('title', __('menu.group_davomad'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.group_davomad') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.group_davomad') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title text-primary">{{ __('group_davomad.groups') }}</h5>
          </div>
          <div class="col-6" style="text-align: right">
            <h5 class="card-title text-primary">{{ date('d.m.Y') }}</h5>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" style="font-size: 14px">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>{{ __('group_davomad.group') }}</th>
                <th>{{ __('group_davomad.davomad') }}</th>
                <th>{{ __('group_davomad.child_count') }}</th>
                <th>{{ __('group_davomad.keldi') }}</th>
                <th>{{ __('group_davomad.kechikdi') }}</th>
                <th>{{ __('group_davomad.kelmadi') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($res['groups'] as $item)
                <tr class="text-center">
                  <td>{{ $loop->index+1 }}</td>
                  <td style="text-align: left">
                    @if($item['users_count']>0)
                      <a href="{{ route('groups_davomad_show',$item['group_id']) }}">{{ $item['group_name'] }}</a></td>
                    @else
                      {{ $item['group_name'] }}
                    @endif
                  <td>
                    @if($item['is_done'])
                      <span class="btn btn-success p-0 px-1"><i class="bi bi-calendar-check"></i></span>
                    @else 
                      <span class="btn btn-danger p-0 px-1"><i class="bi bi-calendar-minus"></i></span>
                    @endif
                  </td>
                  <td>{{ $item['users_count'] }}</td>
                  <td>{{ $item['keldi'] }}</td>
                  <td>{{ $item['kechikdi'] }}</td>
                  <td>{{ $item['kelmadi'] }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">{{ __('group_davomad.not_fount_groups')}}</td>
                </tr>
              @endforelse
            </tbody>
            <tfoot>
              <tr class="text-center">
                <th>#</th>
                <th>{{ $res['chart']['group_count'] }}</th>
                <th>{{ $res['chart']['group_davomad'] }}</th>
                <th>{{ $res['chart']['total_users'] }}</th>
                <th>{{ $res['chart']['total_keldi'] }}</th>
                <th>{{ $res['chart']['total_kelmadi'] }}</th>
                <th>{{ $res['chart']['total_kechikdi'] }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>
@endsection