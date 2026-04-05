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
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-4">{{ __('home.kunlik_topshiriq') }}</h5>
        <div class="row g-3">      
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-primary py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#create_davomad">
              <i class="bi bi-people fs-4"></i> <span class="fw-semibold">{{ __('home.hodimlar_davomadi') }}</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-success py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#kunlik_hisobot">
              <i class="bi bi-file-earmark-text fs-4"></i> <span class="fw-semibold">{{ __('home.kunlik_hisobot') }}</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-warning py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2 text-dark" data-bs-toggle="modal" data-bs-target="#bayram_tadbir">
              <i class="bi bi-gift fs-4"></i> <span class="fw-semibold">{{ __('home.bayram_tadbirlar') }}</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-danger py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#shikoyat">
              <i class="bi bi-exclamation-octagon fs-4"></i> <span class="fw-semibold">{{ __('home.shikoyat_kiritish') }}</span>
            </button>
          </div>     
        </div>
      </div>
    </div>
    @include('group.davomad')
  </section>

<div class="modal fade" id="create_davomad" tabindex="-1" aria-hidden="true">
  <form action="{{ route('hodim_davomad') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-shield-lock me-2"></i> {{ __('home.hodimlar_davomadi') }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
              <thead class="table-light">
                <tr class="text-center">
                  <th style="width: 50px;">#</th>
                  <th>{{ __('home.hodim_fio') }}</th>
                  <th style="width: 250px;">{{ __('home.davomad_status') }}</th>
                  <th>{{ __('home.izoh') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($userDavomad as $index => $user)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                      <input type="hidden" name="attendance[{{ $index }}][user_id]" value="{{ $user['id'] }}">
                      <span class="fw-bold text-dark">{{ $user['name'] }}</span>
                    </td>
                    <td>
                      <select name="attendance[{{ $index }}][status]" class="form-select form-select-sm border-2">
                        <option value="keldi" {{ $user['status'] == 'keldi' ? 'selected' : '' }}>✅ {{ __('home.keldi') }}</option>
                        <option value="keldi_formasiz" {{ $user['status'] == 'keldi_formasiz' ? 'selected' : '' }}>👕 {{ __('home.formasiz') }}</option>
                        <option value="kechikdi_sababli" {{ $user['status'] == 'kechikdi_sababli' ? 'selected' : '' }}>⏰ {{ __('home.kechikdi_sababli') }}</option>
                        <option value="kechikdi_sababsiz" {{ $user['status'] == 'kechikdi_sababsiz' ? 'selected' : '' }}>⚠️ {{ __('home.kechikdi_sababsiz') }}</option>
                        <option value="kelmadi" {{ $user['status'] == 'kelmadi' ? 'selected' : '' }}>❌ {{ __('home.kelmadi') }}</option>
                        <option value="kelmadi_sababli" {{ $user['status'] == 'kelmadi_sababli' ? 'selected' : '' }}>📄 {{ __('home.kelmadi_sababli') }}</option>
                      </select>
                    </td>
                    <td><input type="text" name="attendance[{{ $index }}][description]" value="{{ $user['description'] }}" class="form-control form-control-sm"></td>
                  </tr>
                @endforeach
              </tbody>
            </table> 
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
            <button type="submit" class="btn btn-primary px-5 shadow-sm"> <i class="bi bi-save me-1"></i> {{ __('home.davomadni_saqlash') }}</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="kunlik_hisobot" tabindex="-1" aria-hidden="true">
  <form action="{{ route('hodim_hisobot') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="bi bi-shield-lock me-2"></i> {{ __('home.kunlik_hisobot') }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
              <thead class="table-light">
                <tr>
                  <th style="width: 50px;">#</th>
                  <th>{{ __('home.guruh_nomi') }}</th>
                  <th class="text-center" style="width: 180px;">{{ __('home.hisobot_holati') }}</th>
                  <th>{{ __('home.hisobot_izoh') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($hisobot as $index => $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                      <input type="hidden" name="reports[{{ $index }}][group_id]" value="{{ $item['group_id'] }}">
                      <span class="text-dark">{{ $item['group_name'] }}</span>
                    </td>
                    <td>
                      <div class="form-check form-switch d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" name="reports[{{ $index }}][is_active]" id="switch{{ $index }}"
                          value="1"
                          {{ $item['hisobot_status'] == 'topshirdi' ? 'checked' : '' }}
                          style="width: 45px; height: 22px; cursor: pointer;">
                      </div>
                    </td>
                    <td>
                      <input type="text" name="reports[{{ $index }}][title]" value="{{ $item['description'] }}" class="form-control form-control-sm border-light-subtle">
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm"><i class="bi bi-save me-1"></i> {{ __('home.hisobotni_saqlash') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="bayram_tadbir" tabindex="-1" aria-hidden="true">
  <form action="{{ route('hodim_tadbirlar') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i> {{ __('home.bayram_tadbirlar') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <label for="group_id" class="mb-2">{{ __('home.guruhni_tanlang') }}</label>
          <select name="group_id" class="form-select" required>
            <option value="">{{ __('home.tanlang') }}</option>
            @foreach ($groups as $item)
              <option value="{{ $item['id'] }}">{{ $item['group_name'] }}</option>
            @endforeach
          </select>
          <label for="title" class="my-2">{{ __('home.bayram_about') }}</label>
          <textarea name="title" class="form-control" required></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-warning text-white px-5 shadow-sm"><i class="bi bi-save me-1"></i> {{ __('home.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="shikoyat" tabindex="-1" aria-hidden="true">
  <form action="{{ route('hodim_shikoyat') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>{{ __('home.shikoyat_kiritish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <label for="user_id" class="mb-2">{{ __('home.hodimni_tanlang') }}</label>
          <select name="user_id" class="form-select" required>
            <option value="">{{ __('home.tanlang') }}</option>
            @foreach ($users as $item)
              <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endforeach
          </select>
          <label for="desctiption" class="my-2">{{ __('home.shikoyat_about') }}</label>
          <textarea name="desctiption" class="form-control" required></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-danger px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> {{ __('home.shikoyat_save') }}
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection