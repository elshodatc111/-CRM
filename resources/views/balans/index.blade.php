@extends('layouts.admin')

@section('title', __('menu.moliya'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('menu.moliya') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.moliya') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6" style="text-align:right">
      <button class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#balansdan_xarajat"> <i class="bi bi-dash-circle me-1"></i> Xarajat </button>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#daromad"> <i class="bi bi-plus-circle me-1"></i> Daromad </button>
      <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#return_kassa"> <i class="bi bi-arrow-return-left me-1"></i> Kassaga qaytarish </button>
      <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#add_subsidiya"> <i class="bi bi-bank me-1"></i> Subsidiya kiritish </button>
    </div>
  </div>

  <section class="section dashboard">

    <div class="card info-card welcome-card">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-12 col-xl-12 border-xl-end">
            <h5 class="card-title mb-3 text-success">Balansda mavjud mablag'lar</h5>
            <div class="row g-2">
                <div class="col-lg-3">
                    <div class="op-card rounded p-2 text-center bg-light">
                        <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                        <h5 class="mb-0">{{ number_format($balans->cash, 0, '.', ' ') }}</h5>
                        <div class="text-muted small">Naqd</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="op-card rounded p-2 text-center bg-light">
                        <div class="text-primary mb-1"><i class="bi bi-credit-card-2-front fs-4"></i></div>
                        <h5 class="mb-0">{{ number_format($balans->card, 0, '.', ' ') }}</h5>
                        <div class="text-muted small">Plastik</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="op-card rounded p-2 text-center bg-light">
                        <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                        <h5 class="mb-0">{{ number_format($balans->bank, 0, '.', ' ') }}</h5>
                        <div class="text-muted small">Bank</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="op-card rounded p-2 text-center bg-light">
                        <div class="text-warning mb-1"><i class="bi bi-piggy-bank fs-4"></i></div>
                        <h5 class="mb-0">{{ number_format($balans->sub, 0, '.', ' ') }}</h5>
                        <div class="text-muted small">Subsidiya</div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card info-card welcome-card">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-12 col-xl-12 border-xl-end">
            <h5 class="card-title">Balans tarixi (45 kun)</h5>
            <div class="table-responsive">
              <table class="table text-center table-bordered" style="font-size: 12px">
                <thead>
                  <th>#</th>
                  <th>Amaliyot turi</th>
                  <th>Summa</th>
                  <th>Summa turi</th>
                  <th>Amaliyot haqida</th>
                  <th>Direktor</th>
                  <th>Amaliyot vaqti</th>
                </thead>
                <tbody>
                  @forelse($history as $item)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                      @if($item->type=='kassaToBalans')
                        <b class="m-0 p-0 text-primary">Kassadan chiqim</b>
                      @elseif($item->type=='kassaCost')
                        <b class="m-0 p-0 text-danger">Kassadan xarajat</b>
                      @elseif($item->type=='balansToKassa')
                        <b class="m-0 p-0 text-info">Balansdan kassaga</b>
                      @elseif($item->type=='balansOut')
                        <b class="m-0 p-0 text-success">Daromad</b>
                      @elseif($item->type=='balansCost')
                        <b class="m-0 p-0 text-danger">Balansdan xarajat</b>
                      @elseif($item->type=='return')
                        <b class="m-0 p-0 text-danger">To'lov qaytarildi</b>
                      @elseif($item->type=='salary')
                        <b class="m-0 p-0 text-warning">Ish haqi to'lovi</b>
                      @elseif($item->type=='subToBalans')
                        <b class="m-0 p-0 text-primary">Sunsidiya</b>
                      @endif
                    </td>
                    <td>{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                    <td>
                      @if($item->amount_type=='cash')
                        Naqt
                      @elseif($item->amount_type=='card')
                        Karta
                      @elseif($item->amount_type=='bank')
                        Bank
                      @elseif($item->amount_type=='sub')
                        Subsidiya
                      @endif
                    </td>
                    <td style="text-align: left">{{ $item->description }}</td>
                    <td>{{ $item->admin->name }}</td>
                    <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                  </tr>
                  @empty
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
        
  </section>




<div class="modal fade" id="balansdan_xarajat" tabindex="-1" aria-hidden="true">
  <form action="{{ route('moliya_balans_xarajat') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-dash-circle me-2"></i>Balansdan xarajat
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-lg-6">
              <label for="amount" class="mb-2">Xarajat summasi</label>
              <input type="text" name="amount" required class="form-control" id="amount2">
            </div>
            <div class="col-lg-6">
              <label for="amount_type" class="mb-2">Xarajat turi</label>
              <select name="amount_type" required class="form-select">
                <option value="">Tanlang</option>
                <option value="cash">Naqt</option>
                <option value="card">Karta</option>
                <option value="bank">Bank</option>
                <option value="sub">Subsidiya</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">Xarajat haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-danger px-5 shadow-sm">Xarajatni saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="daromad" tabindex="-1" aria-hidden="true">
  <form action="{{ route('moliya_balans_daromad') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            <i class="bi bi-plus-circle me-2"></i> Daromad
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-lg-6">
              <label for="amount" class="mb-2">Daromad summasi</label>
              <input type="text" name="amount" required class="form-control" id="amount2">
            </div>
            <div class="col-lg-6">
              <label for="amount_type" class="mb-2">Daromad turi</label>
              <select name="amount_type" required class="form-select">
                <option value="">Tanlang</option>
                <option value="cash">Naqt</option>
                <option value="card">Karta</option>
                <option value="bank">Bank</option>
                <option value="sub">Subsidiya</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">Daromad haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">Daromadni saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="return_kassa" tabindex="-1" aria-hidden="true">
  <form action="{{ route('moliya_balans_to_kassa') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">
            <i class="bi bi-arrow-return-left me-2"></i> Kassaga qaytarish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">Kassaga qaytarish summasi (Naqt)</label>
          <input type="text" name="amount" required class="form-control" id="amount3">
          <input type="hidden" name="amount_type" value="cash">
          <label for="description" class="my-2">Qaytarish haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-warning px-5 shadow-sm">Kassaga qaytarish</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="add_subsidiya" tabindex="-1" aria-hidden="true">
  <form action="{{ route('moliya_sunsedya') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-bank me-2"></i> Subsidiya kiritish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">Subsidiya summasi</label>
          <input type="text" name="amount" required class="form-control" id="amount4">
          <label for="description" class="my-2">Subsidiya haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">Subsediyani saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection