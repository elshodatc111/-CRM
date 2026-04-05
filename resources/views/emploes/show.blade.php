@extends('layouts.admin')

@section('title', 'Hodim haqida')

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>Hodim haqida</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('emploes_index') }}">{{ __('menu.emploes') }}</a></li>
            <li class="breadcrumb-item active">Hodim haqida</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6 d-flex justify-content-end align-items-center flex-wrap gap-2">
      @if(auth()->user()->role == 'superadmin' || auth()->use()->role=='direktor')
      <button class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#create_payment"><i class="bi bi-cash-stack me-1"></i> Ish haqi to'lash</button>   
      @endif   
      @if($userT->role=='direktor' || $userT->role='=admin')
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#users_update"><i class="bi bi-pencil-square me-1"></i> Tahrirlash</button>
      @endif
      <form action="#" method="post" class="m-0">
          @csrf
          <button class="btn btn-warning shadow-sm text-dark"
            onclick="return confirm('Haqiqatan ham parolni passwordga yangilamoqchimisiz?')"
            ><i class="bi bi-key me-1"></i> Parolni yangilash </button>
      </form>
      @if(auth()->user()->role == 'superadmin' || auth()->use()->role=='direktor')
      <form action="#" method="post" class="m-0">
          @csrf
          <button class="btn btn-danger shadow-sm" 
            onclick="return confirm('Haqiqatan ham xodimni o\'chirmoqchimisiz?')"
            ><i class="bi bi-person-x me-1"></i> Xodimni o'chirish </button>
      </form>
      @endif
    </div>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h2 class="card-title">FIO</h2>
            
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h2 class="card-title">FIO</h2>
            
          </div>
        </div>
      </div>
      
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
            <i class="bi bi-pencil-square me-2"></i> Taxrirlash
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <input type="hidden" name="user_id" value="{{ $userT->id }}">
          <label for="name" class="mb-2">FIO</label>
          <input type="name" name="name" value="{{ $userT['name'] }}" required class="form-control">
          <div class="row">
            <div class="col-6">
              <label for="phone" class="my-2">Telefon raqam</label>
              <input type="text" name="phone" value="{{ $userT['phone'] }}" required class="form-control phone">
            </div>
            <div class="col-6">
              <label for="phone_two" class="my-2">Qo'shimcha telefon</label>
              <input type="text" name="phone_two" value="{{ $userT['phone_two'] }}" required class="form-control phone">
            </div>
          </div>
          <label for="addres" class="my-2">Yashash manzili</label>
          <input type="text" name="addres" value="{{ $userT['addres'] }}" required class="form-control">
          <div class="row">
            <div class="col-6">
              <label for="salary" class="my-2">Maosh miqdori</label>
              <input type="text" name="salary" value="{{ $userT['salary'] }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="tkun" class="my-2">Tug'ilgan kuni</label>
              <input type="date" name="tkun" value="{{ $userT['tkun']->format("Y-m-d") }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="pasport" class="my-2">Pasport raqami</label>
              <input type="text" name="pasport" value="{{ $userT['pasport'] }}" required class="form-control">
            </div>
            <div class="col-6">
              <label for="role" class="my-2">Lavozimi </label>
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
          <label for="about" class="my-2">Xodim haqida</label>
          <textarea name="about" class="form-control" required>{{ $userT['about'] }}</textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="bi bi-save me-1"></i> O'zgarishlarni saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection