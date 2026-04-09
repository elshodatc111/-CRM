@extends('layouts.admin')

@section('title', __('menu.kassa'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('menu.kassa') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.kassa') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6" style="text-align:right">
      <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#kassadan_chiqim"><i class="bi bi-cash"></i> {{ __('kassa.kassadan_chiqim') }}</button>
      <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#kassadan_xarajat"><i class="bi bi-cash"></i> {{ __('kassa.kassadan_xarajat') }}</button>
    </div>
  </div>

  <section class="section dashboard">
    <div class="row"> 
      <div class="col-lg-7">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 col-xl-12 border-xl-end">
                <h5 class="card-title mb-3 text-success">{{ __('kassa.kassada_mavjud') }}</h5>
                <div class="row g-2">
                    <div class="col-lg-4">
                        <div class="op-card rounded p-2 text-center bg-light">
                            <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                            <h5 class="mb-0">{{ number_format($kassa->cash, 0, '.', ' ') }}</h5>
                            <div class="text-muted small">{{ __('kassa.naqt_mavjud') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="op-card rounded p-2 text-center bg-light">
                            <div class="text-primary mb-1"><i class="bi bi-credit-card fs-4"></i></div>
                            <h5 class="mb-0">{{ number_format($kassa->pending_card, 0, '.', ' ') }}</h5>
                            <div class="text-muted small">{{ __('kassa.plastik_pending') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="op-card rounded p-2 text-center bg-light">
                            <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                            <h5 class="mb-0">{{ number_format($kassa->pending_bank, 0, '.', ' ') }}</h5>
                            <div class="text-muted small">{{ __('kassa.bank_pending') }}</div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-5">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 col-xl-12 border-xl-end">
                <h5 class="card-title mb-3 text-warning">{{ __('kassa.chiqim_xarajat_pending') }}</h5>
                <div class="row g-2">
                  <div class="col-lg-6">
                    <div class="op-card rounded p-2 text-center bg-light">
                      <div class="text-primary mb-1"><i class="bi bi-cash fs-4"></i></div>
                      <h5 class="mb-0">{{ number_format($kassa->out_cash_pending, 0, '.', ' ') }}</h5>
                      <div class="text-muted small">{{ __('kassa.kassadan_naqt_chiqim') }}</div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="op-card rounded p-2 text-center bg-light">
                      <div class="text-info mb-1"><i class="bi bi-cash fs-4"></i></div>
                      <h5 class="mb-0">{{ number_format($kassa->cost_cash_pending, 0, '.', ' ') }}</h5>
                      <div class="text-muted small">{{ __('kassa.kassadan_xarajat') }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 col-xl-12 border-xl-end">
                <h5 class="card-title">{{ __('kassa.tasdiqlash_kutilmoqda') }}</h5>
                <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height: 300px;">
                  <div class="table-responsive">
                    <table class="table text-center table-bordered" style="font-size: 12px">
                      <thead>
                        <th>#</th>
                        <th>{{ __('kassa.type') }}</th>
                        <th>{{ __('kassa.summa') }}</th>
                        <th>{{ __('kassa.tulov_turi') }}</th>
                        <th>{{ __('kassa.amaliyot_about') }}</th>
                        <th>{{ __('kassa.amaliyot_time') }}</th>
                        <th>{{ __('kassa.amaliyotchi') }}</th>
                        <th>{{ __('kassa.amallar') }}</th>
                      </thead>
                      <tbody>
                        @forelse($history as $item)
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                              @if($item->type=='payment')
                                <span class="badge bg-success">{{ __('kassa.payment') }}</span>
                              @elseif($item->type=='cost')
                                <span class="badge bg-danger">{{ __('kassa.kassadan_xarajat') }}</span>
                              @else
                                <span class="badge bg-primary">{{ __('kassa.kassadan_chiqim') }}</span>
                              @endif
                            </td>
                            <td>{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                            <td>
                              @php
                                $types = ['cash' => ['text-primary', 'Naqd'], 'card' => ['text-info', 'Karta'], 'bank' => ['text-dark', 'Bank']];
                                $currentType = $types[$item->amount_type] ?? ['text-muted', 'Noma\'lum'];
                              @endphp
                              <b class="{{ $currentType[0] }} m-0 p-0"> {{ $currentType[1] }} </b>
                            </td>
                            <td>{{ $item->start_comment }}</td>
                            <td>{{ $item->created_at->format("Y-m-d H:i") }}</td>
                            <td>{{ $item->startAdmin->name ?? 'Noma\'lum' }}</td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                @if(auth()->user()->role == 'direktor' || auth()->user()->role == 'superadmin')
                                  <form action="{{ route('kassa_success') }}" method="post">
                                      @csrf
                                      <input type="hidden" name="kassaHistoryId" value="{{ $item->id }}">
                                      <button type="button" onclick="confirmAction(this, 'Amaliyotni tasdiqlaysizmi?')" class="btn btn-success p-0 px-1" title="Tasdiqlash">
                                        <i class="bi bi-check-lg"></i>
                                      </button>
                                  </form>
                                @endif
                                <form action="{{ route('kassa_cancel') }}" method="post">
                                  @csrf
                                  <input type="hidden" name="kassaHistoryId" value="{{ $item->id }}">
                                  <button type="button" onclick="confirmAction(this, 'Amaliyotni bekor qilmoqchimisiz?')" class="btn btn-danger p-0 px-1" title="Bekor qilish">
                                    <i class="bi bi-x-lg"></i>
                                  </button>
                                </form>
                              </div>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td class="text-center" colspan="8">{{ __('kassa.not_found_amaliyot') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                    <script>
                      function confirmAction(button, message) {
                        if (confirm(message)) {
                          button.closest('form').submit();
                        }
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




<div class="modal fade" id="kassadan_chiqim" tabindex="-1" aria-hidden="true">
  <form action="{{ route('kassa_out') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-cash me-2"></i> {{ __('kassa.kassadan_chiqim') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">{{ __('kassa.chiqim_summasi') }}</label>
          <input type="text" name="amount" required class="form-control" id="amount1">
          <label for="start_comment" class="my-2">{{ __('kassa.chiqim_about') }}</label>
          <textarea name="start_comment" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('kassa.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('kassa.chiqim_qilish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="kassadan_xarajat" tabindex="-1" aria-hidden="true">
  <form action="{{ route('kassa_cost') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-cash me-2"></i> {{ __('kassa.kassadan_xarajat') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">{{ __('kassa.xarajat_summa') }}</label>
          <input type="text" name="amount" required class="form-control" id="amount2">
          <label for="start_comment" class="my-2">{{ __('kassa.xarajat_about') }}</label>
          <textarea name="start_comment" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('kassa.cancel') }}</button>
          <button type="submit" class="btn btn-danger px-5 shadow-sm">{{ __('kassa.xarajat_qilish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection