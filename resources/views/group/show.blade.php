@extends('layouts.admin')

@section('title', __('group_show.title'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('group_show.title') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('groups_index') }}">{{ __('menu.groups') }}</a></li>
        <li class="breadcrumb-item active">{{ __('group_show.title') }}</li>
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
                <th>{{ __('group_show.group_price') }}</th>
                <td style="text-align: right">{{ number_format($group['group_price'], 0, '.', ' ') }} UZS</td>
              </tr>
              <tr>
                <th>{{ __('group_show.group_create') }}</th>
                <td style="text-align: right">{{ $group->created_at->format('Y-m-d h:i') }}</td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">{{ $group->about }}</td>
              </tr>
            </table>
            @if(auth()->user()->role=='direktor' || auth()->user()->role=='superadmin')
            @if($group->status=='aktiv')
            <button class="btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#updateGroup"><i class="bi bi-pencil"></i> {{ __('group_show.group_update') }}</button>
            <form action="{{ route('groups_delete') }}" method="post" id="delete-group-form">
              @csrf 
              <input type="hidden" name="group_id" value="{{ $group->id }}">
              <button type="button" onclick="confirmDelete()" class="btn btn-danger w-100 mt-2"><i class="bi bi-trash"></i> {{ __('group_show.group_del') }}</button>
            </form>
            <script>
              function confirmDelete() {
                  const message = @json(__('group_show.group_del_about'));
                  if (confirm(message)) {
                      document.getElementById('delete-group-form').submit();
                  }
              }
            </script>
            @endif
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">
              <div class="row">
                <div class="col-6">{{ __('group_show.group_all_user') }}</div>
                @if($group->status=='aktiv')
                <div class="col-6" style="text-align: right">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user"><i class="bi bi-person-add"></i> {{ __('group_show.group_create_user') }}</button>
                </div>
                @endif
              </div>
            </h5>
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>{{ __('group_show.users') }}</th>
                  <th>{{ __('group_show.group_plus') }}</th>
                  <th>{{ __('group_show.group_status') }}</th>
                  <th>{{ __('group_show.group_del_data') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tarbiyachilar as $item)
                <tr>
                  <td class="text-center">{{ $loop->index+1 }}</td>
                  <td>{{ $item->user->name }} <i>
                    ( 
                      @if($item->user->role=='tarbiyachi')
                      {{ __('group_show.tarbiyachi') }}
                      @else
                      {{ __('group_show.yordamchi') }}
                      @endif 
                    )</i>
                  </td>
                  <td class="text-center">{{ $item->start_data->format("Y-m-d") }}</td>
                  <td class="text-center">
                    @if($item->is_active==true)
                      {{ __('group_show.aktiv') }}
                    @else
                      {{ __('group_show.noaktiv') }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if($item->is_active==true)
                      <form action="{{ route('groups_delete_user') }}" method="post">
                        @csrf 
                        <input type="hidden" name="id" value="{{ $item['id'] }}" class="p-0 m-0">
                        <button type="button" onclick="confirmUserDelete()" class="btn btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                      </form>
                      <script>
                        function confirmUserDelete() {
                            const message = @json(__('group_show.del_user_abouts'));
                            if (confirm(message)) {
                                document.getElementById('delete-group-form').submit();
                            }
                        }
                      </script>
                    @else
                      {{ $item->end_data->format('Y-m-d') }}
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="text-center" colspan="5">{{ __('group_show.notfountuser') }}</td>
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
              {{ __('group_show.groups_childs') }}
            </h5>
            <table class="table table-bordered" style="font-size: 12px;">
              <thead>
                <tr class="text-center">
                  <th>#</th>
                  <th>{{ __('group_show.child') }}</th>
                  <th>{{ __('group_show.child_plus') }}</th>
                  <th>{{ __('group_show.child_plus_admin') }}</th>
                  <th>{{ __('group_show.chils_status') }}</th>
                  <th>{{ __('group_show.child_delete') }}</th>
                  <th>{{ __('group_show.child_del_admin') }}</th>
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
                    {{ __('group_show.aktiv') }}
                    @else
                    {{ __('group_show.noaktiv') }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if(!$item->is_active)
                    {{ $item->end_data->format('Y-m-d') }}
                    @endif
                  </td>
                  <td class="text-center">
                    @if($item->is_active)
                      <form action="{{ route('groups_delete_child') }}" method="post">
                        @csrf 
                        <input type="hidden" name="id" value="{{ $item['id'] }}" class="p-0 m-0">
                        <button type="button" onclick="confirmChildDelete()" class="btn btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                      </form>
                      <script>
                        function confirmChildDelete() {
                            const message = @json(__('group_show.del_child_abouts'));
                            if (confirm(message)) {
                                document.getElementById('delete-group-form').submit();
                            }
                        }
                      </script>
                    @else
                      {{ $item->ender->name }}
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center">{{ __('group_show.not_fount_child') }}</td>
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
          <h5 class="modal-title"><i class="bi bi-pencil me-2"></i> {{ __('group_show.group_update') }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <label for="group_name" class="mb-2">{{ __('group_show.group_name') }}</label>
          <input type="text" name="group_name" required value="{{ $group->group_name }}" class="form-control">
          <label for="group_price" class="mb-2">{{ __('group_show.group_price') }}</label>
          <input type="text" name="group_price" required value="{{ $group->group_price }}" class="form-control" id="amount1">
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('group_show.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('group_show.group_update') }}</button>
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
          <h5 class="modal-title"><i class="bi bi-person-add me-2"></i> {{ __('group_show.new_user') }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body py-4">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <label for="" class="mb-2">{{ __('group_show.new_user_about') }}</label>
          <select name="user_id" required class="form-select">
            <option value=""> {{ __('group_show.tanlang') }} </option>
            @foreach ($newUser as $item)
              <option value="{{ $item['user_id'] }}">{{ $item['name'] }} ({{ $item['role']=='tarbiyachi'?__('group_show.tarbiyachi'):__('group_show.yordamchi') }})</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('group_show.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('group_show.group_plus') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection