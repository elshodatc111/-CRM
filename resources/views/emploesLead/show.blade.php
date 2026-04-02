@extends('layouts.admin')

@section('title', __('menu.emploesLead'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.emploesLead') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('emploesLead_index') }}">{{ __('menu.emploesLead') }}</a></li>
        <li class="breadcrumb-item active">{{ __('emploes_lead_page_show.title') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-8">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('emploes_lead_page_show.title') }}</h5>
            <div class="row">
              <div class="col-lg-6">
                <p><strong>{{ __('emploes_lead_page_show.fio') }}:</strong> {{ $userLead->name }}</p>
                <p><strong>{{ __('emploes_lead_page_show.address') }}:</strong> {{ $userLead->address }}</p>
                <p><strong>{{ __('emploes_lead_page_show.phone') }}:</strong> {{ $userLead->phone }}</p>
                <p><strong>{{ __('emploes_lead_page_show.phone_extra') }}:</strong> {{ $userLead->phone_two }}</p>
                <p><strong>{{ __('emploes_lead_page_show.birth_date') }}:</strong> {{ $userLead->birth_date->format('d.m.Y') }}</p>
                <p><strong>{{ __('emploes_lead_page_show.source') }}:</strong> {{ $userLead->manba }}</p>
                <p><strong>{{ __('emploes_lead_page_show.position') }}:</strong> 
                  @if ($userLead->role=='tarbiyachi')
                    {{ __('emploes_lead_page.tarbiyachi') }}
                  @elseif ($userLead->role=='yordamchi')
                    {{ __('emploes_lead_page.yordamchi') }}
                  @elseif ($userLead->role=='teacher')
                    {{ __('emploes_lead_page.teacher') }}
                  @elseif ($userLead->role=='oshpaz')
                    {{ __('emploes_lead_page.oshpaz') }}
                  @elseif ($userLead->role=='farrosh')
                    {{ __('emploes_lead_page.farrosh') }}
                  @elseif ($userLead->role=='xodim')
                    {{ __('emploes_lead_page.xodim') }}
                  @endif</p>
                <p><strong>{{ __('emploes_lead_page_show.admin') }}:</strong> {{ $userLead->admin->name }}</p>
                @if($userLead->status == 'new' || $userLead->status == 'pending')
                <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#cancel_emploes">
                  <i class="bi bi-person-x me-1"></i> {{ __('emploes_lead_page_show.reject') }}
                </button>
                @endif
              </div>
              <div class="col-lg-6">
                <p><strong>{{ __('emploes_lead_page_show.education') }}:</strong> {{ $userLead->education }}</p>
                <p><strong>{{ __('emploes_lead_page_show.institution_name') }}:</strong> {{ $userLead->institution_name }}</p>
                <p><strong>{{ __('emploes_lead_page_show.last_workplace') }}:</strong> {{ $userLead->last_workplace }}</p>
                <p><strong>{{ __('emploes_lead_page_show.expected_salary') }}:</strong> {{ number_format($userLead->expected_salary, 0, '.', ' ') }} UZS</p>
                <p><strong>{{ __('emploes_lead_page_show.about') }}:</strong> {{ $userLead->about }}</p>
                <p><strong>{{ __('emploes_lead_page_show.status') }}:</strong> 
                  @if($userLead->status === 'new')
                    <span class="badge bg-primary">{{ __('emploes_lead_page.new') }}</span>
                    @elseif($userLead->status === 'pending')
                    <span class="badge bg-warning text-dark">{{ __('emploes_lead_page.pending') }}</span>
                    @elseif($userLead->status === 'success')
                    <span class="badge bg-success">{{ __('emploes_lead_page.success') }}</span>
                    @else
                    <span class="badge bg-secondary">{{ __('emploes_lead_page.rejected') }}</span>
                  @endif</p>
                <p><strong>{{ __('emploes_lead_page_show.maqsad') }}:</strong> {{ $userLead->maqsadi }}</p>
                <p><strong>{{ __('emploes_lead_page_show.registered') }}:</strong> {{ $userLead->created_at->format('d.m.Y H:i') }}</p>
                @if($userLead->status == 'new' || $userLead->status == 'pending')
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#create_emploes">
                  <i class="bi bi-person-plus me-1"></i> {{ __('emploes_lead_page_show.accept') }}
                </button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('emploes_lead_page_show.eslatmalar') }}</h5>
            <div class="notes-wrapper" style="max-height: 250px; overflow-y: auto; overflow-x: hidden;height: 250px;">
              <table class="table table-bordered table-hover" style="font-size: 12px">
                <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                  <tr class="text-center">
                    <th>{{ __('emploes_lead_page_show.eslatma_matni') }}</th>
                    <th>{{ __('emploes_lead_page_show.menejer') }}</th>
                    <th>{{ __('emploes_lead_page_show.eslatma_vaqti') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($employeLead as $note)
                    <tr>
                      <td>{{ $note->content }}</td>
                      <td class="text-center text-nowrap">{{ $note->admin ? $note->admin->name : 'Noma\'lum' }}</td>
                      <td class="text-end text-nowrap">{{ $note->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="text-center">{{ __('emploes_lead_page_show.no_notes') }}</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <hr>    
            <form action="{{ route('emploesLead_note') }}" method="post">
              @csrf
              <div class="row g-2">
                <div class="col-9">
                  <input type="hidden" name="type" value="employeLead">
                  <input type="hidden" name="user_id" value="{{ $userLead->id }}">
                  <input type="text" name="content" class="form-control" required autocomplete="off">
                </div>
                <div class="col-3">
                  <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send"></i></button>
                </div>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<div class="modal fade" id="cancel_emploes" tabindex="-1" aria-hidden="true">
  <form action="{{ route('emploesLead_cancel') }}" method="post">
    @csrf 
    <input type="hidden" name="user_lead_id" value="{{ $userLead->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">
              <i class="bi bi-person-lines-fill me-2"></i> {{ __('emploes_lead_page_show.cancel_emploes') }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>          
          <div class="modal-body p-4">
            <label class="form-label fw-bold">{{ __('emploes_lead_page_show.cancel_reason') }}</label>
            <textarea name="content" class="form-control" rows="3" required></textarea>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">{{ __('emploes_lead_page.cancel') }}</button>
            <button type="submit" class="btn btn-danger px-5 shadow-sm">
              <i class="bi bi-save me-1"></i> {{ __('emploes_lead_page_show.reject') }}
            </button>
          </div>
        </div>
      </div>
  </form>
</div>

<div class="modal fade" id="create_emploes" tabindex="-1" aria-hidden="true">
  <form action="{{ route('emploesLead_success') }}" method="post" class="needs-validation" novalidate>
    @csrf 
    <input type="hidden" name="user_lead_id" value="{{ $userLead->id }}">
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
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.fio') }}</label>
                <input type="text" name="name" class="form-control" value="{{ $userLead->name }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.phone') }}</label>
                <input type="text" name="phone" class="form-control phone" value="{{ $userLead->phone ?? '+998' }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.phone_secondary') }}</label>
                <input type="text" name="phone_two" class="form-control phone" value="{{ $userLead->phone_two ?? '+998' }}">
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.address') }}</label>
                <textarea name="address" class="form-control" rows="2" required>{{ $userLead->address ?? '' }}</textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.salary') }}</label>
                <div class="input-group">
                  <input type="text" name="salary" class="form-control" id="amount0" value="{{ $userLead->expected_salary ?? 0 }}" required>
                  <span class="input-group-text">UZS</span>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.birth_date') }}</label>
                <input type="date" name="tkun" class="form-control" value="{{ $userLead->birth_date ? $userLead->birth_date->format('Y-m-d') : '' }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.passport') }}</label>
                <input type="text" name="pasport" class="form-control passport" value="{{ $userLead->passport ?? 'AA 1234567' }} " required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">{{ __('emploes_page.position') }}</label>
                <select name="role" class="form-select" required>
                  <option value="" selected disabled>{{ __('emploes_page.select_position') }}</option>
                  <option value="tarbiyachi" {{ $userLead->role === "tarbiyachi" ? 'selected' : '' }}>{{ __('emploes_lead_page.tarbiyachi') }}</option>
                  <option value="yordamchi" {{ $userLead->role === "yordamchi" ? 'selected' : '' }}>{{ __('emploes_lead_page.yordamchi') }}</option>
                  <option value="teacher" {{ $userLead->role === "teacher" ? 'selected' : '' }}>{{ __('emploes_lead_page.teacher') }}</option>
                  <option value="oshpaz" {{ $userLead->role === "oshpaz" ? 'selected' : '' }}>{{ __('emploes_lead_page.oshpaz') }}</option>
                  <option value="farrosh" {{ $userLead->role === "farrosh" ? 'selected' : '' }}>{{ __('emploes_lead_page.farrosh') }}</option>
                  <option value="xodim" {{ $userLead->role === "xodim" ? 'selected' : '' }}>{{ __('emploes_lead_page.xodim') }}</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">{{ __('emploes_page.about') }}</label>
                <textarea name="about" class="form-control" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light"> 
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">{{ __('emploes_lead_page.cancel') }}</button>
            <button type="submit" class="btn btn-primary px-5 shadow-sm">
              <i class="bi bi-save me-1"></i> {{ __('emploes_lead_page_show.nomzodni_ishga_qabul_qilish') }}
            </button>
          </div>
        </div>
      </div>
  </form>
</div>
@endsection