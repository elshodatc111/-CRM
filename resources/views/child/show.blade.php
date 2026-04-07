@extends('layouts.admin')

@section('title', __('child_show.bola_haqida'))

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('child_show.bola_haqida') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('child_index') }}">{{ __('menu.child') }}</a></li>
            <li class="breadcrumb-item active">{{ __('child_show.bola_haqida') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6" style="text-align: right">
      <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tulov"><i class="bi bi-wallet2 me-1"></i> {{ __('child_show.tulov_qilish') }}</button>
      @if(auth()->user()->role=='superadmin' || auth()->user()->role=='direktor')
      <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#return"><i class="bi bi-wallet2 me-1"></i> {{ __('child_show.tulov_qaytarish') }}</button>
      <button class="btn btn-warning mt-2 text-white" data-bs-toggle="modal" data-bs-target="#chegirma"><i class="bi bi-percent me-1"></i> {{ __('child_show.chegirma') }}</button>
      @endif
      <button class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil-square me-1"></i> {{ __('child_show.taxrirlash') }}</button>
      @if(!$child->is_active)
      <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#groupAdd"><i class="bi bi-people-fill me-1"></i> {{ __('child_show.guruhga_qoshish') }}</button>
      @endif
    </div>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body" >
            <div class="row">
              <div class="col-6">
                <h5 class="card-title mb-0 pb-2">{{ $child->name }}</h5>
              </div>
              <div class="col-6" style="text-align: right">
                <h5 class="card-title mb-0 pb-2">
                  @if($child->balans>=0)
                  <b class="text-success m-0 p-0">{{ number_format($child->balans, 0, '.', ' ') }} UZS</b>
                  @else
                  <b class="text-danger m-0 p-0">{{ number_format($child->balans, 0, '.', ' ') }} UZS</b>
                  @endif
                </h5>
              </div>
            </div>
            <div class="div notes-wrapper" style="max-height: 420px; overflow-y: auto; overflow-x: hidden;height:420px">
              <table class="table" style="font-size:12px;">
                <tr>
                  <th>{{ __('child_show.ota_onasi') }}</th>
                  <td style="text-align: right">{{ $child->ota_ona }}</td>
                </tr>
                <tr>
                  <th> {{ __('child_show.phone') }}</th>
                  <td style="text-align: right">{{ $child->phone." | ".$child->phone_two }}</td>
                </tr>
                <tr>
                  <th> {{ __('child_show.guvohnoma') }}</th>
                  <td style="text-align: right">{{ $child->guvohnoma }}</td>
                </tr>
                <tr>
                  <th> {{ __('child_show.address') }}</th>
                  <td style="text-align: right">{{ $child->address }}</td>
                </tr>
                <tr> 
                  <th> {{ __('child_show.tkun') }}</th>
                  <td style="text-align: right">{{ $child->tkun->format("Y-m-d") }}</td>
                </tr>
                <tr>
                  <th> {{ __('child_show.jinsi') }}</th>
                  <td style="text-align: right">
                    @if($child->jinsi=='male') {{ __('child_show.nale') }} @else {{ __('child_show.girl') }} @endif
                  </td>
                </tr>
                <tr>
                  <th> {{ __('child_show.status') }}</th>
                  <td style="text-align: right">@if($child->is_active) {{ __('child_show.aktiv') }} @else {{ __('child_show.noaktiv') }} @endif</td>
                </tr>
                <tr>
                  <th>{{ __('child_show.davr') }}</th>
                  <td style="text-align: right">{{ $child->month_pay==null?"Hisiblanmagan":$child->month_pay }}</td>
                </tr>
                <tr>
                  <th>{{ __('child_show.regData') }}</th>
                  <td style="text-align: right">{{ $child->creator->name }}</td>
                </tr>
                <tr>
                  <th>{{ __('child_show.regUser') }}</th>
                  <td style="text-align: right">{{ $child->created_at->format("Y-m-d h:i") }}</td>
                </tr>
                <tr><td colspan="2" class="text-center">{{ $child->description }}</td></tr>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body" >
            <h5 class="card-title">{{ __('child_show.bola_davomadi') }}</h5>
            <div class="div notes-wrapper" style="max-height: 610px; overflow-y: auto; overflow-x: hidden;height:610px">
              <div class="table-responsive">
                <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
                  <thead class="table-light text-center">
                    <tr>
                      <th>#</th>
                      <th>{{ __('child_show.guruh') }}</th>
                      <th>{{ __('child_show.davomad_sanasi') }}</th>
                      <th>{{ __('child_show.davomad_holati') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($davomad as $item)
                        <tr>
                          <td class="text-center">{{ $loop->index+1 }}</td>
                          <td>
                            <a href="{{ route('groups_show',$item->group_id) }}">{{ $item->group->group_name }}</a>
                          </td> 
                          <td class="text-center">{{ $item['date']->format("Y-m-d") }}</td>
                          <td style="text-align: right">
                            @if($item['status']=='keldi')
                              <i class="text-success">{{ __('child_show.keldi') }}</i>
                            @elseif($item['status']=='kelmadi')
                              <i class="text-danger">{{ __('child_show.kelmadi') }}</i>
                            @elseif($item['status']=='kechikdi')
                              <i class="text-warning">{{ __('child_show.kechikdi') }}</i>
                            @endif
                          </td>
                        </tr>
                      @empty
                        <tr class="text-center" colspan="4">
                          <td>{{ __('child_show.bola_davomad_mavjud_emas') }}</td>
                        </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ __('child_show.bola_guruhlar_tarixi') }}</h5>
            <div class="table-responsive notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height:300px">
              <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 12px">
                  <thead class="table-light text-center">
                    <tr>
                      <th>#</th>
                      <th>{{ __('child_show.guruh') }}</th>
                      <th>{{ __('child_show.group_plus') }}</th>
                      <th>{{ __('child_show.group_plus_user') }}</th>
                      <th>{{ __('child_show.group_status') }}</th>
                      <th>{{ __('child_show.group_delete') }}</th>
                      <th>{{ __('child_show.group_delete_user') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($childgouphistory as $item)
                    <tr>
                      <td class="text-center">{{ $loop->index+1 }}</td>
                      <td><a href="{{ route('groups_show',$item->group_id ) }}">{{ $item->group->group_name }}</a></td>
                      <td class="text-center">{{ $item->start_data->format("Y-m-d") }}</td>
                      <td>{{ $item->starter->name }}</td>
                      <td class="text-center">@if($item->is_active) <span class="badge bg-success">{{ __('group_show.aktiv') }}</span>@else<span class="badge bg-danger">{{ __('group_show.noaktiv') }}</span>@endif</td>
                      <td>
                        @if($item->end_id!=null) {{ $item->ender->name }} @endif
                      </td>
                      <td class="text-center">@if($item->end_data!=null) {{ $item->end_data->format("Y-m-d") }} @endif</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">{{ __('child_show.group_history_not_found') }}</td>
                    </tr>
                    @endforelse
                  </tbody>
              </table>
            </div>
          </div>
        </div>        
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ __('child_show.tulov_history') }}</h5>
            <div class="table-responsive notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height:300px">
              <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 12px">
                <thead class="table-light text-center">
                  <tr>
                    <th>#</th>
                    <th>{{ __('child_show.statuses') }}</th>
                    <th>{{ __('child_show.pay_sum') }}</th>
                    <th>{{ __('child_show.pay_type') }}</th>
                    <th>{{ __('child_show.pay_stat') }}</th>
                    <th>{{ __('child_show.pay_time') }}</th>
                    <th>{{ __('child_show.pay_about') }}</th>
                    <th>{{ __('child_show.pay_user') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($payments as $item)
                  <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td class="text-center">
                      @if($item->type=='payment')
                        <span class="badge bg-success">{{ __('child_show.tulov') }}</span>
                      @elseif($item->type=='return')
                        <span class="badge bg-danger">{{ __('child_show.return') }}</span>
                      @else
                        <span class="badge bg-warning">{{ __('child_show.chegirma') }}</span>
                      @endif
                    </td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                    <td class="text-center">
                      @if($item->amount_type=='cash')
                        {{ __('moliya.cash') }}
                      @elseif($item->amount_type=='card')
                        {{ __('moliya.card') }}
                      @else
                        {{ __('moliya.bank') }}
                      @endif
                    </td>
                    <td class="text-center">
                      @if($item->status=='pending')
                        <span class="badge bg-warning"> {{ __('child_show.warning') }}</span>
                      @elseif($item->status=='success')
                        <span class="badge bg-success">{{ __('child_show.success') }}</span>
                      @else
                        <span class="badge bg-danger">{{ __('child_show.canceled') }}</span>
                      @endif
                    </td>
                    <td class="text-center">{{ $item->created_at->format('Y-m-d h:i') }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->admin->name }}</td>
                  </tr>
                  @empty
                    <tr>
                      <td class="text-center" colspan="8">{{ __('child_show.tolov_mavjud_emas') }}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body" >
            <h5 class="card-title">{{ __('child_show.guruh_uchun_tulov') }}</h5>
            <div class="div notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height:400px">
              <div class="table-responsive">
                <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
                  <thead class="table-light text-center">
                    <tr>
                      <th>#</th>
                      <th>{{ __('child_show.guruh') }}</th>
                      <th>{{ __('child_show.pay_time') }}</th>
                      <th>{{ __('child_show.pay_about') }}</th>
                      <th>{{ __('child_show.balans') }}</th>
                      <th>{{ __('child_show.yechib_olindi') }}</th>
                      <th>{{ __('child_show.balansdagi_qoldiq') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($groupPay as $item)
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td><a href="{{ route('groups_show',$item->group_id ) }}">{{ $item->group->group_name }}</a></td>
                        <td class="text-center">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->desctiption }}</td>
                        <td class="text-center">{{ number_format($item->balans_start, 0, '.', ' ') }} UZS</td>
                        <td class="text-center">{{ number_format($item->payment, 0, '.', ' ') }} UZS</td>
                        <td class="text-center">{{ number_format($item->balans_end, 0, '.', ' ') }} UZS</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center">{{ __('child_show.guruh_uchun_tulov_mavjud_emas') }}</td>
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

<div class="modal fade" id="tulov" tabindex="-1" aria-hidden="true">
  <form action="{{ route('child_payment') }}" method="post">
    @csrf 
    <input type="hidden" name="child_id" value="{{ $child->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-wallet2 me-2"></i> {{ __('child_show.tulov_qilish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-6">
              <label for="amount" class="mb-2">{{ __('child_show.pay_sum') }}</label>
              <input type="text" name="amount" required class="form-control" id="amount1">
            </div>
            <div class="col-6">
              <label for="amount_type" class="mb-2">{{ __('child_show.pay_type') }}</label>
              <select name="amount_type" required class="form-select">
                <option value="">{{ __('child_show.tanlang') }}</option>
                <option value="cash">{{ __('child_show.naqt_tulov') }}</option>
                <option value="card">{{ __('child_show.karta_tulov') }}</option>
                <option value="bank">{{ __('child_show.bank_tulov') }}</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">{{ __('child_show.pay_about') }}</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal"> {{ __('child_show.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">{{ __('child_show.tulov_qilish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="return" tabindex="-1" aria-hidden="true">
  <form action="{{ route('child_return') }}" method="post">
    @csrf 
    <input type="hidden" name="child_id" value="{{ $child->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-wallet2 me-2"></i> {{ __('child_show.tulov_qaytarish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="text-warning">{{ __('child_show.desc') }}</p>
          <div class="row">
            <div class="col-6">
              <label for="amount" class="mb-2">{{ __('child_show.ret_pay') }}</label>
              <input type="text" name="amount" required class="form-control" id="amount4">
            </div>
            <div class="col-6">
              <label for="amount_type" class="mb-2">{{ __('child_show.ret_type') }}</label>
              <select name="amount_type" required class="form-select">
                <option value="">{{ __('child_show.tanlang') }}</option>
                <option value="cash">{{ __('child_show.naqt_tulov') }}</option>
                <option value="card">{{ __('child_show.karta_tulov') }}</option>
                <option value="bank">{{ __('child_show.bank_tulov') }}</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">{{ __('child_show.ret_about') }}</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('child_show.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">{{ __('child_show.tulov_qaytarish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div> 

<div class="modal fade" id="chegirma" tabindex="-1" aria-hidden="true">
  <form action="{{ route('child_descount') }}" method="post">
    @csrf 
    <input type="hidden" name="child_id" value="{{ $child->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">
            <i class="bi bi-percent me-2"></i> {{ __('child_show.chegirma') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">{{ __('child_show.cheg_sum') }}</label>
          <input type="text" name="amount" required class="form-control" id="amount2">
          <label for="start_comment" class="my-2">{{ __('child_show.cheg_about') }}</label>
          <textarea name="start_comment" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('child_show.cancel') }}</button>
          <button type="submit" class="btn btn-warning text-white px-5 shadow-sm">{{ __('child_show.cheg_save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="taxrirlash" tabindex="-1" aria-hidden="true">
  <form action="{{ route('child_update') }}" method="post">
    @csrf 
    <input type="hidden" name="child_id" value="{{ $child->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">
            <i class="bi bi-pencil-square me-2"></i>{{ __('child_show.taxrirlash') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">          
          <div class="row">
            <div class="col-lg-6">
              <label for="name" class="mb-2">{{ __('child_show.fio') }}</label>
              <input type="text" name="name" value="{{ $child->name }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="ota_ona" class="mb-2">{{ __('child_show.ota_onasi') }}</label>
              <input type="text" name="ota_ona" value="{{ $child->ota_ona }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="phone" class="my-2">{{ __('child_show.phone') }}</label>
              <input type="text" name="phone" value="{{ $child->phone }}" required class="form-control phone">
            </div>
            <div class="col-lg-6">
              <label for="phone_two" class="my-2">{{ __('child_show.phone') }}</label>
              <input type="text" name="phone_two" value="{{ $child->phone_two }}" required class="form-control phone">
            </div>
            <div class="col-lg-6">
              <label for="address" class="my-2">{{ __('child_show.address') }}</label>
              <input type="text" name="address" value="{{ $child->address }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="guvohnoma" class="my-2">{{ __('child_show.guvohnoma') }}</label>
              <input type="text" name="guvohnoma" value="{{ $child->guvohnoma }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="tkun" class="my-2">{{ __('child_show.tkun') }}</label>
              <input type="date" name="tkun"  value="{{ $child->tkun->format("Y-m-d") }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="jinsi" class="my-2">{{ __('child_show.jinsi') }}</label>
              <select name="jinsi" id="" class="form-control" required>
                <option value="">{{ __('child_show.tanlang') }}</option>
                <option value="male" {{ $child->jinsi === "male" ? 'selected' : '' }}>{{ __('child_show.male') }}</option>
                <option value="female" {{ $child->jinsi === "female" ? 'selected' : '' }}>{{ __('child_show.girl') }}</option>
              </select>
            </div>
            <div class="col-12">
              <label for="description" class="my-2">{{ __('child_show.bola_haqida') }}</label>
              <textarea name="description" required class="form-control">{{ $child->description }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('child_show.cancel') }}</button>
          <button type="submit" class="btn btn-info text-white px-5 shadow-sm">{{ __('child_show.taxrirlash') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="groupAdd" tabindex="-1" aria-hidden="true">
  <form action="{{ route('child_add_group') }}" method="post">
    @csrf 
    <input type="hidden" name="child_id" value="{{ $child->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-cash me-2"></i> {{ __('child_show.guruhga_qoshish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="group_id" class="mb-2">{{ __('child_show.g_tanlang') }}</label>
          <select name="group_id" class="form-select">
            <option value="">{{ __('child_show.tanlang') }}</option>
            @foreach ($groups as $item)
              <option value="{{ $item['id'] }}">{{ $item['group_name'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('child_show.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('child_show.guruhga_qoshish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection