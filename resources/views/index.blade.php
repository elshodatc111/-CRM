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
        <h5 class="card-title mb-4">Kunlik topshiriqlar</h5>
        <div class="row g-3">      
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-primary py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#create_davomad">
              <i class="bi bi-people fs-4"></i> <span class="fw-semibold">Xodimlar davomadi</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-success py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#kunlik_hisobot">
              <i class="bi bi-file-earmark-text fs-4"></i> <span class="fw-semibold">Hisobot kiritish</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-warning py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2 text-dark" data-bs-toggle="modal" data-bs-target="#bayram_tadbir">
              <i class="bi bi-gift fs-4"></i> <span class="fw-semibold">Bayram tadbiri</span>
            </button>
          </div>
          <div class="col-lg-3 col-md-6">
            <button class="btn btn-outline-danger py-3 w-100 shadow-sm d-flex flex-column align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#shikoyat">
              <i class="bi bi-exclamation-octagon fs-4"></i> <span class="fw-semibold">Shikoyat kiritish</span>
            </button>
          </div>     
        </div>
      </div>
    </div>
    @include('group.davomad')
  </section>

<div class="modal fade" id="create_davomad" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>Hodimlar davomadi
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          Hodimlar davomadi
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> Davomadni saqlash
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="kunlik_hisobot" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>Kunlik hisobot
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          Kunlik hisobot
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> Hisobotni saqlash
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="bayram_tadbir" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i> Bayram tadbiri
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          Bayram tadbiri
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-warning text-white px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> Saqlash
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="shikoyat" tabindex="-1" aria-hidden="true">
  <form action="#" method="post" class="needs-validation" novalidate>
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i>Shikoyat kiritish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          Shikoyat kiritish
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-danger px-5 shadow-sm">
            <i class="bi bi-save me-1"></i> Shikoyatni saqlash
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection