@extends('layouts.admin')

@section('title', __('menu.emploesLead'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('menu.emploesLead') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.emploesLead') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6">
      <div style="text-align: right">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_emploesLead">
          <i class="bi bi-person-plus me-1"></i> {{ __('emploes_lead_page.add_new') }}
        </button>
      </div>
    </div>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('menu.emploesLead') }}</h5>
            <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;height: 500px;">            
              <div class="table-responsive">
                <table class="table table-bordered database"  style="font-size: 13px;">
                  <thead>
                    <tr class="text-center bg-light">
                      <th>#</th>
                      <th>{{ __('emploes_lead_page.fio') }}</th>
                      <th>{{ __('emploes_lead_page.phone') }}</th>
                      <th>{{ __('emploes_lead_page.position') }}</th>
                      <th>{{ __('emploes_lead_page.status') }}</th>
                      <th>{{ __('emploes_lead_page.registered') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($userLead as $key => $item)
                      <tr>
                        <td class="text-center">{{ ++$key }}</td>
                        <td><a href="{{ route('emploesLead_show', $item->id) }}" class="text-decoration-none">{{ $item->name }}</a></td>
                        <td class="text-center">{{ $item->phone }}</td>
                        <td class="text-center">
                          @if ($item->role=='tarbiyachi')
                            <span class="badge bg-info text-dark">{{ __('emploes_lead_page.tarbiyachi') }}</span>
                          @elseif ($item->role=='yordamchi')
                            <span class="badge bg-warning text-dark">{{ __('emploes_lead_page.yordamchi') }}</span>
                          @elseif ($item->role=='teacher')
                            <span class="badge bg-success">{{ __('emploes_lead_page.teacher') }}</span>
                          @elseif ($item->role=='oshpaz')
                            <span class="badge bg-danger">{{ __('emploes_lead_page.oshpaz') }}</span>
                          @elseif ($item->role=='farrosh')
                            <span class="badge bg-primary">{{ __('emploes_lead_page.farrosh') }}</span>
                          @elseif ($item->role=='xodim')
                            <span class="badge bg-secondary">{{ __('emploes_lead_page.xodim') }}</span>
                          @endif
                        </td>
                        <td class="text-center">
                          @if($item->status === 'new')
                          <span class="badge bg-primary">{{ __('emploes_lead_page.new') }}</span>
                          @elseif($item->status === 'pending')
                          <span class="badge bg-warning text-dark">{{ __('emploes_lead_page.pending') }}</span>
                          @elseif($item->status === 'success')
                          <span class="badge bg-success">{{ __('emploes_lead_page.qabul') }}</span>
                          @else
                          <span class="badge bg-secondary">{{ __('emploes_lead_page.rejected') }}</span>
                          @endif
                        </td>
                        <td class="text-center">{{ $item->created_at->format('d.m.Y H:i') }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center text-muted">{{ __('emploes_lead_page.empty') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="create_emploesLead" tabindex="-1" aria-hidden="true">
    <form action="{{ route('emploesLead_store') }}" method="post" class="needs-validation" novalidate>
      @csrf 
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
              <i class="bi bi-person-lines-fill me-2"></i> {{ __('emploes_lead_page.new_emploesLead') }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>          
          <div class="modal-body p-4">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.fio') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.phone') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">+998</span>
                        <input type="text" name="phone" class="form-control phone2" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.phone_extra') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">+998</span>
                        <input type="text" name="phone_two" class="form-control phone2">
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.address') }}</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.birth_date') }}</label>
                    <input type="date" name="birth_date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.education') }}</label>
                    <select name="education" class="form-select" required>
                        <option value="" selected disabled>{{ __('emploes_lead_page.select') }}</option>
                        <option value="Bakalavr">{{ __('emploes_lead_page.bakalavr') }}</option>
                        <option value="Magistr">{{ __('emploes_lead_page.magistr') }}</option>
                        <option value="O'rta-maxsus">{{ __('emploes_lead_page.o_rta_maxsus') }}</option>
                        <option value="O'rta">{{ __('emploes_lead_page.o_rta') }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.institution') }}</label>
                    <input type="text" name="institution_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.last_work') }}</label>
                    <input type="text" name="last_workplace" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.source') }}</label>
                    <select name="manba" class="form-select" required>
                        <option value="" selected disabled>{{ __('emploes_lead_page.select') }}</option>
                        <option value="Telegram">Telegram</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Tanishlar">Tanishlar</option>
                        <option value="Boshqa">{{ __('emploes_lead_page.boshqa') }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.salary') }}</label>
                    <input type="text" name="expected_salary" class="form-control" id="amount0" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.goal') }}</label>
                    <input type="text" name="maqsadi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.position') }}</label>
                    <select name="role" class="form-select" required>
                        <option value="" selected disabled>{{ __('emploes_page.select_position') }}</option>
                        @foreach(['tarbiyachi', 'yordamchi', 'teacher', 'oshpaz', 'farrosh', 'xodim'] as $role)
                            <option value="{{ $role }}">{{ __('emploes_page.roles.' . $role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">{{ __('emploes_lead_page.about') }}</label>
                    <input type="text" name="about" class="form-control" required>
                </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">{{ __('emploes_lead_page.cancel') }}</button>
            <button type="submit" class="btn btn-primary px-5 shadow-sm">
              <i class="bi bi-save me-1"></i> {{ __('emploes_lead_page.save') }}
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection