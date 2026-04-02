@extends('layouts.admin')

@section('title', "Guruh haqida")

@section('content')
  <div class="pagetitle">
    <h1>Guruh haqida</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">Guruh haqida</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-4">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title w-100 text-center">{{ $group['group_name'] }}</h5>
            <table class="table table-borderd">
              <tr>
                <th>Guruh narxi</th>
                <td style="text-align: right">{{ number_format($group['group_price'], 0, '.', ' ') }} UZS</td>
              </tr>
              <tr>
                <th>Guruh ochildi</th>
                <td style="text-align: right">{{ $group->created_at->format('Y-m-d h:i') }}</td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">{{ $group->about }}</td>
              </tr>
            </table>
            @if(auth()->user()->role=='direktor' || auth()->user()->role=='superadmin')
            <button class="btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#updateGroup"><i class="bi bi-pencil"></i> Guruhni taxrirlash</button>
            <form action="{{ route('groups_delete') }}" method="post"
              onsubmit="return confirm('Haqiqatan ham ushbu guruhni o\'chirmoqchimisiz?\nGuruh o\'chirilgach guruh haqidagi barcha malumotlar o\'chib ketadi.')">
              @csrf 
              <input type="hidden" name="group_id" value="{{ $group->id }}">
            <button type="submit" class="btn btn-danger w-100 mt-2"><i class="bi bi-trash"></i> Guruhni o'chirish</button>
            </form>
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">
              <div class="row">
                <div class="col-6">Guruh tarbiyachilari</div>
                <div class="col-6" style="text-align: right">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user"><i class="bi bi-person-add"></i> Tarbiyachi qo'shish</button>
                </div>
              </div>
            </h5>
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>Tarbiyachi</th>
                  <th>Guruhga qo'shildi</th>
                  <th>Guruhdagi holati</th>
                  <th>Guruhdan o'chirildi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tarbiyachilar as $item)
                <tr>
                  <td class="text-center">{{ $loop->index+1 }}</td>
                  <td>{{ $item->user->name }} <i>
                    ( 
                      @if($item->user->role=='tarbiyachi')
                      Tarbiyachi
                      @else
                      Yordamchi Tarbiyachi
                      @endif 
                    )</i>
                  </td>
                  <td class="text-center">{{ $item->start_data->format("Y-m-d") }}</td>
                  <td class="text-center">
                    @if($item->is_active==true)
                      Aktiv
                    @else
                      NoAktiv
                    @endif
                  </td>
                  <td class="text-center">
                    @if($item->is_active==true)
                      <form action="{{ route('groups_delete_user') }}" method="post" onsubmit="return confirm('Haqiqatan ham ushbu tarbiyachini guruhdan o\'chirmoqchimisiz?')">
                        @csrf 
                        <input type="hidden" name="id" value="{{ $item['id'] }}" class="p-0 m-0">
                        <button type="submit" class="btn btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                      </form>
                    @else
                      {{ $item->end_data->format('Y-m-d') }}
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="text-center" colspan="5">Tarbiyachilar mavjud emas.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">
              Guruhdagi bolalar
            </h5>
            <table class="table table-bordered" style="font-size: 12px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>Bola</th>
                  <th>Guruhga qo'shildi</th>
                  <th>Guruhga qoshdi</th>
                  <th>Guruhdagi holati</th>
                  <th>Guruhdan o'chirildi</th>
                  <th>Guruhdan o'chirdi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($child as $key=>$item)
                <tr>
                  <td class="text-center">{{ $loop->index+1 }}</td>
                  <td>
                    <a href="{{ route('child_show',$item->child->id) }}">{{ $item->child->name }}</a>
                  </td>
                  <td class="text-center">{{ $item->start_data->format("Y-m-d") }}</td>
                  <td class="text-center">{{ $item->starter->name }}</td>
                  <td class="text-center">
                    @if($item->is_active)
                    Aktiv
                    @else
                    O'chirilgan
                    @endif
                  </td>
                  <td class="text-center">
                    @if(!$item->is_active)
                    {{ $item->end_data->format('Y-m-d') }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if($item->is_active)
                      <form action="{{ route('groups_delete_child') }}" method="post" onsubmit="return confirm('Haqiqatan ham ushbu tarbiyachini guruhdan o\'chirmoqchimisiz?')">
                        @csrf 
                        <input type="hidden" name="id" value="{{ $item['id'] }}" class="p-0 m-0">
                        <button type="submit" class="btn btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                      </form>
                    @else
                      {{ $item->ender->name }}
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center">Guruhdagi bolalar mavjud emas</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="modal fade" id="updateGroup" tabindex="-1" aria-hidden="true">
  <form action="{{ route('groups_update') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-pencil me-2"></i> Guruhni taxrirlash</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <label for="group_name" class="mb-2">Guruh nomi</label>
          <input type="text" name="group_name" required value="{{ $group->group_name }}" class="form-control">
          <label for="group_price" class="mb-2">Guruh nomi</label>
          <input type="text" name="group_price" required value="{{ $group->group_price }}" class="form-control" id="amount1">
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">Guruhni taxrirlash</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="add_user" tabindex="-1" aria-hidden="true">
  <form action="{{ route('groups_store_user') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-person-add me-2"></i>Guruhga tarbiyachi qo'shish</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body py-4">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <label for="" class="mb-2">Guruhga qo'shmoqchi bo'lgan tarbiyachini tanlang</label>
          <select name="user_id" required class="form-select">
            <option value=""> Tanlang... </option>
            @foreach ($newUser as $item)
              <option value="{{ $item['user_id'] }}">{{ $item['name'] }} ({{ $item['role']=='tarbiyachi'?"Tarbiyachi":"Yordamchi tarbiyachi" }})</option>
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