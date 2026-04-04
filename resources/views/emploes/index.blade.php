@extends('layouts.admin')

@section('title', __('menu.emploes'))

@section('content')
  <div class="row">
    <div class="col-6">
      <div class="pagetitle">
        <h1>{{ __('menu.emploes') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.emploes') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-6" style="text-align: right">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_emploes">
        <i class="bi bi-person-plus me-1"></i> {{ __('emploes_page.add_new') }}
      </button>
    </div>
  </div>

  <section class="section employes">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('emploes_page.employees_list') }}</h5>
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
                <tbody>
                  @forelse ($emploes as $emploe)
                    <tr class="text-center align-middle">
                      <td>{{ $loop->iteration }}</td>
                      <td style="text-align: left">
                        <a href="{{ route('emploes_show', $emploe['id']) }}" class="fw-bold text-primary">
                          {{ $emploe->name }}
                        </a>
                      </td>
                      <td>{{ $emploe->phone }}</td>
                      <td>{{ __('emploes_page.roles.' . $emploe->role) }}</td>
                      <td>
                        <span class="badge {{ $emploe->status == true ? 'bg-success' : 'bg-danger' }}">
                           {{ __('emploes_page.status_' . ($emploe->status ?? 'true')) }}
                        </span>
                      </td>
                      <td>{{ $emploe->created_at->format('d.m.Y') }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-3 text-muted">
                        {{ __('emploes_page.no_data') }}
                      </td>
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

  {{-- Modal qismi --}}
  <div class="modal fade" id="create_emploes" tabindex="-1" aria-hidden="true">
    <form action="{{ route('emploes_store') }}" method="post" class="needs-validation" novalidate>
      @csrf 
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
              <i class="bi bi-person-plus me-2"></i> {{ __('emploes_page.add_new') }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>        
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.fio') }}</label>
                <input type="text" name="name" class="form-control" placeholder="{{ __('emploes_page.fio_placeholder') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.phone') }}</label>
                <input type="text" name="phone" class="form-control phone" value="+998" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.phone_secondary') }}</label>
                <input type="text" name="phone_two" class="form-control phone" value="+998">
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.address') }}</label>
                <textarea name="address" class="form-control" rows="2" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.salary') }}</label>
                <div class="input-group">
                  <input type="text" name="salary" class="form-control" id="amount0" required>
                  <span class="input-group-text">UZS</span>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.birth_date') }}</label>
                <input type="date" name="tkun" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.passport') }}</label>
                <input type="text" name="pasport" class="form-control passport" placeholder="AA 1234567" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.position') }}</label>
                <select name="role" class="form-select" required>
                  <option value="" selected disabled>{{ __('emploes_page.select_position') }}</option>
                  @php
                    $availableRoles = ['tarbiyachi', 'yordamchi', 'teacher', 'oshpaz', 'farrosh', 'xodim'];
                    if(auth()->user()->role === 'superadmin'){
                        array_unshift($availableRoles, 'superadmin', 'direktor', 'admin');
                    } elseif(auth()->user()->role === 'direktor'){
                        array_unshift($availableRoles, 'direktor', 'admin');
                    }
                  @endphp
                  @foreach($availableRoles as $role)
                    <option value="{{ $role }}">{{ __('emploes_page.roles.' . $role) }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.about') }}</label>
                <textarea name="about" class="form-control" rows="3" placeholder="{{ __('emploes_page.about_placeholder') }}"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
            <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('emploes_page.save') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection