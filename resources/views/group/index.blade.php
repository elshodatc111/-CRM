@extends('layouts.admin')

@section('title', __('menu.groups'))

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="pagetitle">
      <h1>{{ __('menu.groups') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('menu.groups') }}</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="col-lg-6" style="text-align: right">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_group">
      <i class="bi bi-people me-1"></i> {{ __('groups.new_group') }}
    </button>
  </div>
</div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('menu.groups') }}</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size: 14px">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th> {{ __('groups.group_name') }}</th>
                    <th>{{ __('groups.group_price') }}</th>
                    <th>{{ __('groups.child_count') }}</th>
                    <th>{{ __('groups.user_count') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($group as $item)
                  <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td>
                      <a href="{{ route('groups_show',$item['id']) }}">{{ $item['group_name'] }}</a>
                    </td>
                    <td class="text-center">{{ number_format($item['group_price'], 0, '.', ' ') }} UZS</td>
                    <td class="text-center">{{ $item['childs'] }}</td>
                    <td class="text-center">{{ $item['users'] }}</td>
                  </tr>
                  @empty
                    <tr>
                      <td class="text-center" colspan="5">{{ __('groups.not_fount') }}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>      
    </div>
  </section>

  <div class="modal fade" id="create_group" tabindex="-1" aria-hidden="true">
    <form action="{{ route('groups_store') }}" method="post">
      @csrf 
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
              <i class="bi bi-shield-lock me-2"></i> {{ __('groups.new_group') }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>        
          <div class="modal-body p-4">
            <div class="g-4">
              <label for="group_name" class="form-label fw-bold">{{ __('groups.group_name') }}</label>
              <input type="text" name="group_name" class="form-control" required>
            </div>
            <div class="g-4 mt-2">
              <label for="group_price" class="form-label fw-bold">{{ __('groups.group_price') }}</label>
              <input type="text" name="group_price" class="form-control" id="amount0" required>
            </div>
            <div class="g-4 mt-2">
              <label for="about" class="form-label fw-bold">{{ __('groups.about') }}</label>
              <textarea name="about" class="form-control" required></textarea>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal"> {{ __('groups.create_cancel') }}</button>
            <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="bi bi-save me-1"></i> {{ __('groups.create_success') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection