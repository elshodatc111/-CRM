@extends('layouts.admin')

@section('title', "Bola haqida")

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>Bola haqida</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('child_index') }}">{{ __('menu.child') }}</a></li>
            <li class="breadcrumb-item active">Bola haqida</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6" style="text-align: right">
      <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tulov"><i class="bi bi-wallet2 me-1"></i> To'lov qilish</button>
      @if(auth()->user()->role=='superadmin' || auth()->user()->role=='direktor')
      <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#return"><i class="bi bi-wallet2 me-1"></i> To'lov qaytarish</button>
      <button class="btn btn-warning mt-2 text-white" data-bs-toggle="modal" data-bs-target="#chegirma"><i class="bi bi-percent me-1"></i> Chegirma</button>
      @endif
      <button class="btn btn-info mt-2 text-white" data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil-square me-1"></i> Tahrirlash</button>
      @if(!$child->is_active)
      <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#groupAdd"><i class="bi bi-people-fill me-1"></i> Guruhga qo'shish</button>
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
                  <th>Ota onasi</th>
                  <td style="text-align: right">{{ $child->ota_ona }}</td>
                </tr>
                <tr>
                  <th>Telefon raqam</th>
                  <td style="text-align: right">{{ $child->phone." | ".$child->phone_two }}</td>
                </tr>
                <tr>
                  <th>Guvohnoma</th>
                  <td style="text-align: right">{{ $child->guvohnoma }}</td>
                </tr>
                <tr>
                  <th>Yashash manzili</th>
                  <td style="text-align: right">{{ $child->address }}</td>
                </tr>
                <tr>
                  <th>Tug'ilgan kuni</th>
                  <td style="text-align: right">{{ $child->tkun->format("Y-m-d") }}</td>
                </tr>
                <tr>
                  <th>Jinsi</th>
                  <td style="text-align: right">
                    @if($child->jinsi=='male') O'g'il bola @else Qiz bola @endif
                  </td>
                </tr>
                <tr>
                  <th>Statusi</th>
                  <td style="text-align: right">@if($child->is_active) Aktiv @else NoAktiv @endif</td>
                </tr>
                <tr>
                  <th>Hisobot davri</th>
                  <td style="text-align: right">{{ $child->month_pay==null?"Hisiblanmagan":$child->month_pay }}</td>
                </tr>
                <tr>
                  <th>Ro'yhatga oldi</th>
                  <td style="text-align: right">{{ $child->creator->name }}</td>
                </tr>
                <tr>
                  <th>Ro'yhatga olindi</th>
                  <td style="text-align: right">{{ $child->created_at->format("Y-m-d h:i") }}</td>
                </tr>
                <tr><td colspan="2" class="text-center">{{ $child->description }}</td></tr>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body" >
            <h5 class="card-title">Bola davomadi</h5>
            <div class="div notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height:400px">
              <div class="table-responsive">
                <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
                    <thead class="table-light text-center">
                    </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bola guruhlar tarixi</h5>
            <div class="table-responsive notes-wrapper" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;height:200px">
              <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 12px">
                  <thead class="table-light text-center">
                    <tr>
                      <th>#</th>
                      <th>Guruh</th>
                      <th>Guruhga qo'shildi</th>
                      <th>Guruhdan qo'shdi</th>
                      <th>Guruhdagi holati</th>
                      <th>Guruhdan o'chirildi</th>
                      <th>Guruhdan o'chirdi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($childgouphistory as $item)
                    <tr>
                      <td class="text-center">{{ $loop->index+1 }}</td>
                      <td><a href="{{ route('groups_show',$item->group_id ) }}">{{ $item->group->group_name }}</a></td>
                      <td class="text-center">{{ $item->start_data->format("Y-m-d") }}</td>
                      <td>{{ $item->starter->name }}</td>
                      <td class="text-center">@if($item->is_active) <span class="badge bg-success">Aktiv</span>@else<span class="badge bg-danger">Noaktiv</span>@endif</td>
                      <td>
                        @if($item->end_id!=null) {{ $item->ender->name }} @endif
                      </td>
                      <td class="text-center">@if($item->end_data!=null) {{ $item->end_data->format("Y-m-d") }} @endif</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">Guruhlar tarixi mavjud emas.</td>
                    </tr>
                    @endforelse
                  </tbody>
              </table>
            </div>
          </div>
        </div>        
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">To'lovlar tarixi</h5>
            <div class="table-responsive notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;height:500px">
              <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 12px">
                <thead class="table-light text-center">
                  <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>To'lov summasi</th>
                    <th>To'lov turi</th>
                    <th>To'lov holati</th>
                    <th>To'lov vaqt</th>
                    <th>To'lov haqida</th>
                    <th>Hodim</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($payments as $item)
                  <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td class="text-center">
                      @if($item->type=='payment')
                        <span class="badge bg-success">To'lov</span>
                      @elseif($item->type=='return')
                        <span class="badge bg-danger">Qaytarildi</span>
                      @else
                        <span class="badge bg-warning">Qaytarildi</span>
                      @endif
                    </td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                    <td class="text-center">
                      @if($item->amount_type=='cash')
                        Naqt
                      @elseif($item->amount_type=='card')
                        Karta
                      @else
                        Bank
                      @endif
                    </td>
                    <td class="text-center">
                      @if($item->status=='pending')
                        <span class="badge bg-warning">Kutilmoqda</span>
                      @elseif($item->status=='success')
                        <span class="badge bg-success">Qabul qilindi</span>
                      @else
                        <span class="badge bg-danger">Bekor qilindi</span>
                      @endif
                    </td>
                    <td class="text-center">{{ $item->created_at->format('Y-m-d h:i') }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->admin->name }}</td>
                  </tr>
                  @empty
                    <tr>
                      <td class="text-center" colspan="8">To'lovlar mavjud emas.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body" >
            <h5 class="card-title">Guruh uchun to'lovlar</h5>
            <div class="div notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height:400px">
              <div class="table-responsive">
                <table class="table table-hover table-bordered border-primary align-middle" style="font-size: 14px">
                    <thead class="table-light text-center">
                    </thead>
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
            <i class="bi bi-wallet2 me-2"></i>To'lov qilish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-6">
              <label for="amount" class="mb-2">To'lov summasi</label>
              <input type="text" name="amount" required class="form-control" id="amount1">
            </div>
            <div class="col-6">
              <label for="amount_type" class="mb-2">To'lov turi</label>
              <select name="amount_type" required class="form-select">
                <option value="">Tanlang...</option>
                <option value="cash">Naqt to'lov</option>
                <option value="card">Karta to'lov</option>
                <option value="bank">Bank orqali to'lov</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">To'lov haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">To'lov qilish</button>
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
            <i class="bi bi-wallet2 me-2"></i> To'lov qaytarish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="text-warning">To'lov qaytarish uchun balansda yetarli mablag' mavjud bo'lishi kerak.</p>
          <div class="row">
            <div class="col-6">
              <label for="amount" class="mb-2">Qaytarish summasi</label>
              <input type="text" name="amount" required class="form-control" id="amount4">
            </div>
            <div class="col-6">
              <label for="amount_type" class="mb-2">Qaytarish turi</label>
              <select name="amount_type" required class="form-select">
                <option value="">Tanlang...</option>
                <option value="cash">Naqt to'lov</option>
                <option value="card">Karta to'lov</option>
                <option value="bank">Bank orqali to'lov</option>
              </select>
            </div>
          </div>
          <label for="description" class="my-2">Qaytarish haqida</label>
          <textarea name="description" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-success px-5 shadow-sm">To'lov qilish</button>
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
            <i class="bi bi-percent me-2"></i>Chegirma
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="amount" class="mb-2">Chegirma summasi</label>
          <input type="text" name="amount" required class="form-control" id="amount2">
          <label for="start_comment" class="my-2">Chegirma haqida</label>
          <textarea name="start_comment" required class="form-control"></textarea>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-warning text-white px-5 shadow-sm">Chegirmani saqlash</button>
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
            <i class="bi bi-pencil-square me-2"></i>Taxrirlash
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">          
          <div class="row">
            <div class="col-lg-6">
              <label for="name" class="mb-2">Bola FIO</label>
              <input type="text" name="name" value="{{ $child->name }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="ota_ona" class="mb-2">Ota onasi</label>
              <input type="text" name="ota_ona" value="{{ $child->ota_ona }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="phone" class="my-2">Telefon raqam</label>
              <input type="text" name="phone" value="{{ $child->phone }}" required class="form-control phone">
            </div>
            <div class="col-lg-6">
              <label for="phone_two" class="my-2">Qo'shimcha telefon raqam</label>
              <input type="text" name="phone_two" value="{{ $child->phone_two }}" required class="form-control phone">
            </div>
            <div class="col-lg-6">
              <label for="address" class="my-2">Yashash manzili</label>
              <input type="text" name="address" value="{{ $child->address }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="guvohnoma" class="my-2">Guvohnoma raqami</label>
              <input type="text" name="guvohnoma" value="{{ $child->guvohnoma }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="tkun" class="my-2">Tug'ilgan kuni</label>
              <input type="date" name="tkun"  value="{{ $child->tkun->format("Y-m-d") }}" required class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="jinsi" class="my-2">Jinsi</label>
              <select name="jinsi" id="" class="form-control" required>
                <option value="">Tanlang...</option>
                <option value="male" {{ $child->jinsi === "male" ? 'selected' : '' }}>O'g'il bola</option>
                <option value="female" {{ $child->jinsi === "female" ? 'selected' : '' }}>Qiz bola</option>
              </select>
            </div>
            <div class="col-12">
              <label for="description" class="my-2">Bola haqida</label>
              <textarea name="description" required class="form-control">{{ $child->description }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-info text-white px-5 shadow-sm">O'zgarishlarni saqlash</button>
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
            <i class="bi bi-cash me-2"></i> Guruhga qo'shish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <label for="group_id" class="mb-2">Guruhni tanlang</label>
          <select name="group_id" class="form-select">
            <option value="">Tanlang...</option>
            @foreach ($groups as $item)
              <option value="{{ $item['id'] }}">{{ $item['group_name'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">Guruhga qo'shish</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection