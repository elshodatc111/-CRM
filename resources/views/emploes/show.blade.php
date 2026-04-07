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
    @if(auth()->user()->role == 'superadmin' || auth()->user()->role=='direktor')
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
    <!-- HODIM HAQIDA -->
    <div class="col-lg-4">
      <div class="card info-card welcome-card">
        <div class="card-body">
          <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">{{ $userT['name'] }}</h2>
            <table class="table table-bordered" style="font-size: 12px;">
              <tr><th>{{ __('emploes_show.lavozim') }}</th><td style="text-align: right">
                @if($userT['role']==="direktor") {{ __('emploes_page.roles.direktor') }}
                @elseif($userT['role']==="admin") {{ __('emploes_page.roles.admin') }}
                @elseif($userT['role']==="tarbiyachi") {{ __('emploes_lead_page.tarbiyachi') }}
                @elseif($userT['role']==="yordamchi") {{ __('emploes_lead_page.yordamchi') }}
                @elseif($userT['role']==="teacher") {{ __('emploes_lead_page.teacher') }}
                @elseif($userT['role']==="oshpaz") {{ __('emploes_lead_page.oshpaz') }}
                @elseif($userT['role']==="farrosh") {{ __('emploes_lead_page.farrosh') }}
                @elseif($userT['role']==="xodim") {{ __('emploes_lead_page.xodim') }} 
                @endif
              </td></tr>
              <tr><th>{{ __('emploes_lead_page.phone') }}</th><td style="text-align: right">{{ $userT['phone'] }}</td></tr>
              <tr><th>{{ __('emploes_lead_page.phone_two') }}</th><td style="text-align: right">{{ $userT['phone_two'] }}</td></tr>
              <tr><th>{{ __('emploes_lead_page.address') }}</th><td style="text-align: right">{{ $userT['addres'] }}</td></tr>
              <tr><th>{{ __('emploes_show.maosh_miqdori') }}</th><td style="text-align: right">{{ number_format($userT['salary'], 0, '.', ' ') }} UZS</td></tr>
              <tr><th>{{ __('emploes_lead_page.birth_date') }}</th><td style="text-align: right">{{ $userT['tkun']->format("Y-m-d") }}</td></tr>
              <tr><th>{{ __('emploes_lead_page_show.pasport') }}</th><td style="text-align: right">{{ $userT['pasport'] }}</td></tr>
              <tr><th>{{ __('emploes_show.ishga_olindi') }}</th><td style="text-align: right">{{ $userT['created_at']->format("Y-m-d H:i") }}</td></tr>
              <tr><td colspan="2" class="text-center">{{ $userT['about'] }}</td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- SHIKOYATLAR -->
    <div class="col-lg-4">
      <div class="card info-card welcome-card">
        <div class="card-body">
          <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">{{ __('emploes_show.shikoyatlar') }}</h2>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size:12px;">
                <thead>
                  <tr class="text-center">
                    <th>{{ __('emploes_show.shikoyat_matni') }}</th>
                    <th>{{ __('emploes_show.administrator') }}</th>
                    <th>{{ __('emploes_show.shikoyat_vaqti') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($shikoyat as $item)
                  <tr>
                    <td>{{ $item->desctiption }}</td>
                    <td>{{ $item->admin->name }}</td>
                    <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="text-center">{{ __('emploes_show.not_found_shikoyat') }}</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- DAVOMAD -->
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
                      <td class="text-center">{{ $item->data->format("Y-m-d") }}</td>
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
              <h2 class="card-title">{{ __('emploes_show.xodim_ish_haqi_hisoblash') }}</h2>
              <form action="{{ route('user_emploes_calc') }}" method="post">
                @csrf 
                <input type="hidden" name="user_id" value="{{ $userT['id'] }}">
                <input type="hidden" name="name" value="{{ $userT['name'] }}">
                <input type="hidden" name="role" value="{{ $userT['role'] }}">
                <input type="hidden" name="group_id" value="{{ $group_id }}">
                <label for="monch" class="mb-2">Hisoblash davrini tanlang.</label>
                <select name="monch" id="" class="form-control">
                  <?php $i=0; ?>
                  @foreach ($oxirgiOltiOy as $item)
                    <?php $i++;?>
                    @if($i<=2)
                    <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                    @endif
                  @endforeach
                </select>
                <button class="btn btn-primary w-100 mt-2">{{ __('emploes_show.ish_haqi_hisoblash') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif
    <!-- ISH haqi to'lovlar tarixi -->
    <div class="{{ in_array($userT->role, ['admin', 'oshpaz', 'tarbiyachi', 'yordamchi']) ? 'col-lg-8' : 'col-lg-12' }}">
      <div class="card">
        <div class="card-body">
          <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;min-height:400px;">
            <h2 class="card-title">{{ __('emploes_show.ish_haqi_tulovlari') }}</h2>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size:12px;">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('emploes_show.ish_haqi_tulov_summasi') }}</th>
                    <th>{{ __('emploes_show.ish_haqi_tulov_turi') }}</th>
                    <th>{{ __('emploes_show.ish_haqi_tulovi_haqida') }}</th>
                    <th>{{ __('emploes_page.roles.direktor') }}</th>
                    <th>{{ __('emploes_show.ish_haqi_tulov_vaqti') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($payments as $item)
                    <tr>
                      <td class="text-center">{{ $loop->index+1 }}</td>
                      <td class="text-center">{{ number_format($item->salary, 0, '.', ' ') }} UZS</td>
                      <td class="text-center">
                        @if($item->type==="cash"){{ __('moliya.cash') }}
                        @elseif($item->type==="card"){{ __('moliya.card') }}
                        @elseif($item->type==="bank"){{ __('moliya.bank') }}
                        @elseif($item->type==="sub"){{ __('moliya.subsidya') }}
                        @endif
                      </td>
                      <td>{{ $item->description }}</td>
                      <td>{{ $item->admin->name }}</td>
                      <td class="text-center">{{ $item->created_at->format("Y-m-d H:i") }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">{{ __('emploes_show.ish_haqi_tulovlar_mavjud_emas') }}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(in_array($userT->role, ['tarbiyachi', 'yordamchi']))
    <!-- TARBIYACHILAR GURUHLARI -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;min-height:300px;">
          <h2 class="card-title">{{ __('emploes_show.tarbiyachi_guruhlar_tarixi') }}</h2>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size:12px;">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('emploes_show.group_name') }}</th>
                    <th>{{ __('emploes_show.group_plus_time') }}</th>
                    <th>{{ __('emploes_show.group_plus') }}</th>
                    <th>{{ __('emploes_show.group_status') }}</th>
                    <th>{{ __('emploes_show.group_delete_time') }}</th>
                    <th>{{ __('emploes_show.group_delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($groupUsers as $item)
                    <tr>
                      <td class="text-center">{{ $loop->index+1 }}</td>
                      <td><a href="{{ route('groups_show',$item->group_id) }}">{{ $item->group->group_name }}</a></td>
                      <td class="text-center">{{ $item->start_data->format('Y-m-d') }}</td>
                      <td>{{ $item->assignedBy->name }}</td>
                      <td class="text-center">
                        @if($item->is_active)
                          <i class="text-success"> {{ __('emploes_show.aktiv') }}</i>
                        @else
                          <i class="text-danger"> {{ __('emploes_show.ochirilgan') }}</i>
                        @endif
                      </td>
                      <td>{{ $item->end_data!=null?$item->end_data->format('Y-m-d'):"-" }}</td>
                      <td>{{ $item->end_id!=null?$item->removedBy->name:"-" }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center">{{ __('emploes_show.not_found_group_history') }}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
<!-- ISH HAQI TO"LOV QILISH -->
<div class="modal fade" id="create_payment" tabindex="-1" aria-hidden="true">
  <form action="{{ route('user_store_payment') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            <i class="bi bi-cash-stack me-2"></i> {{ __('emploes_show.ish_haqi_tulash') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="">{{ __('emploes_show.balansda_mavjud_mablag') }}</label>
          <table class="table table-bordered text-center" style="font-size: 12px;">
            <tr><th>{{ __('moliya.cash') }}</th><th>{{ __('moliya.card') }}</th><th>{{ __('moliya.bank') }}</th><th>{{ __('moliya.subsidya') }}</th></tr>
            <tr>
              <td>{{ number_format($balans->cash, 0, '.', ' ') }}</td><td>{{ number_format($balans->card, 0, '.', ' ') }}</td>
              <td>{{ number_format($balans->bank, 0, '.', ' ') }}</td><td>{{ number_format($balans->sub, 0, '.', ' ') }}</td>
            </tr>
          </table>
          <input type="hidden" name="user_id" value="{{ $userT['id'] }}">
          <label for="salary" class="mb-2">{{ __('emploes_show.ish_haqi_tulov_summasi') }}</label>
          <input type="text" name="salary" class="form-control" id="amount5" required>
          <label for="type" class="my-2">{{ __('emploes_show.ish_haqi_tulov_turi') }}</label>
          <select name="type" required class="form-select">
            <option value="">{{ __('emploes_show.tanlang') }}</option>
            <option value="cash">{{ __('moliya.cash') }}</option>
            <option value="card">{{ __('moliya.card') }}</option>
            <option value="bank">{{ __('moliya.bank') }}</option>
            <option value="sub">{{ __('moliya.subsidya') }}</option>
          </select>
          <label for="description" class="my-2">{{ __('emploes_show.ish_haqi_tulovi_haqida') }}</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm"><i class="bi bi-save me-1"></i> {{ __('emploes_show.ish_haqi_tulash') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- TAXRIRLASH --> 
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