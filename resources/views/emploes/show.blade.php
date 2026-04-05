@extends('layouts.admin')

@section('title', __('emploes_show.title'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('emploes_show.title') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('emploes_index') }}">{{ __('menu.emploes') }}</a></li>
            <li class="breadcrumb-item active">{{ __('emploes_show.title') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6 d-flex justify-content-end align-items-center flex-wrap gap-2">
      @if(auth()->user()->role == 'superadmin' || auth()->use()->role=='direktor')
      <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#create_payment"><i class="bi bi-cash-stack me-1"></i> {{ __('emploes_show.create_paymart') }}</button>   
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#users_update"><i class="bi bi-pencil-square me-1"></i> {{ __('emploes_show.taxrirlash') }}</button>
      @endif   
      <form action="{{ route('emploes_update_password') }}" method="post" class="m-0">
          @csrf
          <input type="hidden" name="id" value="{{ $userT->id }}">
          <button class="btn btn-warning shadow-sm text-dark"
            onclick="return confirm('Haqiqatan ham parolni passwordga yangilamoqchimisiz?')"
            ><i class="bi bi-key me-1"></i> {{ __('emploes_show.password_update') }} </button>
      </form>
      @if(auth()->user()->role == 'superadmin' || auth()->user()->role=='direktor')
      <form action="#" method="post" class="m-0">
          @csrf
          <button class="btn btn-danger shadow-sm" 
            onclick="return confirm('Haqiqatan ham xodimni o\'chirmoqchimisiz?')"
            ><i class="bi bi-person-x me-1"></i> {{ __('emploes_show.user_delete') }}</button>
      </form>
      @endif
    </div>
  </div>
  
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
              <h2 class="card-title">Hodim haqida</h2>
            
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
              <h2 class="card-title">Shikoyatlar</h2>
            
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
              <h2 class="card-title">{{ __('emploes_show.hodim_davomadi') }}</h2>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size:12px;">
                  <thead>
                    <tr class="text-center">
                      <th>{{ __('emploes_show.dav_kun') }}</th>
                      <th>{{ __('emploes_show.dav_status') }}</th>
                      <th>{{ __('emploes_show.dav_about') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($userDavomad as $item)
                      <tr>
                        <td>
                          @if($item->status == 'keldi')
                          <i class="text-success"> {{ __('emploes_show.keldi') }} </i>
                          @elseif($item->status == 'keldi_formasiz')
                          <i class="text-warning"> {{ __('emploes_show.keldi_formasiz') }} </i>
                          @elseif($item->status == 'kechikdi_formasiz')
                          <i class="text-danger"> {{ __('emploes_show.kechikdi_formasiz') }} </i>
                          @elseif($item->status == 'kechikdi_sababli')
                          <i class="text-warning"> {{ __('emploes_show.kechikdi_sababli') }} </i>
                          @elseif($item->status == 'kechikdi_sababsiz')
                          <i class="text-danger"> {{ __('emploes_show.kechikdi_sababsiz') }} </i>
                          @elseif($item->status == 'kelmadi')
                          <i class="text-danger"> {{ __('emploes_show.kelmadi') }} </i>
                          @elseif($item->status == 'kelmadi_sababli')
                          <i class="text-warning"> {{ __('emploes_show.kelmadi_sababli') }} </i>
                          @endif
                        </td>
                        <td class="text-center">{{ $item->data->format("Y-m-d") }}</td>
                        <td>{{ $item->description??"-" }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td class="text-center" colspan="3">{{ __('davomad_show.not_found_davomad') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      @if(in_array($userT->role, ['admin', 'oshpaz', 'tarbiyachi', 'yordamchi']))
      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">Ish haqini hisoblash ({{ $userT->role }})</h2>
                  
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="{{ in_array($userT->role, ['admin', 'oshpaz', 'tarbiyachi', 'yordamchi']) ? 'col-lg-8' : 'col-lg-12' }}">
        <div class="card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">Ish haqi to'lovlari</h2>
                  
            </div>
          </div>
        </div>
      </div>
      @if(in_array($userT->role, ['tarbiyachi', 'yordamchi']))
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">Guruhlar tarixi</h2>
                  
            </div>
          </div>
        </div>
      </div>
      @endif
      
    </div>
  </section>

<div class="modal fade" id="create_payment" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            <i class="bi bi-cash-stack me-2"></i> Ish haqi to'lash 
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <input type="hidden" name="user_id" id="{{ $userT['id'] }}">
          sss
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm"><i class="bi bi-save me-1"></i> Ish haqi to'lash</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="users_update" tabindex="-1" aria-hidden="true">
  <form action="{{ route('emploes_update') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-pencil-square me-2"></i> {{ __('emploes_show.taxrirlash') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <input type="hidden" name="user_id" value="{{ $userT->id }}">
          <label for="name" class="mb-2">{{ __('emploes_lead_page.fio') }}</label>
          <input type="name" name="name" value="{{ $userT['name'] }}" required class="form-control">
          <div class="row">
            <div class="col-6">
              <label for="phone" class="my-2">{{ __('emploes_lead_page.phone') }}</label>
              <input type="text" name="phone" value="{{ $userT['phone'] }}" required class="form-control phone">
            </div>
            <div class="col-6">
              <label for="phone_two" class="my-2">{{ __('emploes_lead_page.phone_two') }}</label>
              <input type="text" name="phone_two" value="{{ $userT['phone_two'] }}" required class="form-control phone">
            </div>
          </div>
          <label for="addres" class="my-2">{{ __('emploes_lead_page.address') }}</label>
          <input type="text" name="addres" value="{{ $userT['addres'] }}" required class="form-control">
          <div class="row">
            <div class="col-6">
              <label for="salary" class="my-2">{{ __('emploes_lead_page_show.salary') }}</label>
              <input type="text" name="salary" value="{{ $userT['salary'] }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="tkun" class="my-2">{{ __('emploes_lead_page.birth_date') }}</label>
              <input type="date" name="tkun" value="{{ $userT['tkun']->format("Y-m-d") }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="pasport" class="my-2">{{ __('emploes_lead_page_show.pasport') }}</label>
              <input type="text" name="pasport" value="{{ $userT['pasport'] }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="role" class="my-2">{{ __('emploes_lead_page_show.role') }} </label>
              <select name="role" required class="form-select">
                <option value="" selected disabled>{{ __('emploes_page.select_position') }}</option>
                <option value="direktor">{{ __('emploes_page.roles.direktor') }} </option>
                <option value="admin">{{ __('emploes_page.roles.admin') }}</option>
                <option value="tarbiyachi">{{ __('emploes_lead_page.tarbiyachi') }}</option>
                <option value="yordamchi">{{ __('emploes_lead_page.yordamchi') }}</option>
                <option value="teacher">{{ __('emploes_lead_page.teacher') }}</option>
                <option value="oshpaz">{{ __('emploes_lead_page.oshpaz') }}</option>
                <option value="farrosh">{{ __('emploes_lead_page.farrosh') }}</option>
                <option value="xodim">{{ __('emploes_lead_page.xodim') }}</option>
              </select>
            </div>
          </div>
          <label for="about" class="my-2">{{ __('emploes_lead_page.about') }}</label>
          <textarea name="about" class="form-control" required>{{ $userT['about'] }}</textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="bi bi-save me-1"></i> {{ __('emploes_show.update_button') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection