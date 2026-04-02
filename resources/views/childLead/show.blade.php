@extends('layouts.admin')

@section('title', __('childLead_show.ariza_haqida'))

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="pagetitle">
      <h1>{{  __('childLead_show.ariza_haqida') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('childLead_index') }}">{{ __('menu.childLead') }}</a></li>
          <li class="breadcrumb-item active">{{  __('childLead_show.ariza_haqida') }}</li>
        </ol>
      </nav>
    </div>
  </div>
  @if($childLead['status'] == 'new' || $childLead['status'] == 'pending')
  <div class="col-lg-6" style="text-align: right">
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#leadCancel">{{ __('childLead_show.arizani_bekor_qilish') }}</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leadSuccess">{{ __('childLead_show.bolani_qabul_qilish') }}</button>
  </div>
  @endif
</div>

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-6">
      <div class="card info-card welcome-card">
        <div class="card-body">
          <h5 class="card-title w-100">
            <div class="row">
              <div class="col-6">{{  __('childLead_show.ariza_haqida') }}</div>
              <div class="col-6" style="text-align: right">
                @if($childLead['status'] == 'new')
                <span class="badge bg-info text-white">{{ __('childLead_show.new') }}</span>
                @elseif($childLead['status'] == 'pending')
                <span class="badge bg-warning text-white">{{ __('childLead_show.pending') }}</span>
                @elseif($childLead['status'] == 'success')
                <span class="badge bg-success text-white">{{ __('childLead_show.success') }}</span>
                @else
                <span class="badge bg-danger text-white">{{ __('childLead_show.cancel') }}</span>
                @endif
              </div>
            </div>
          </h5>
          <table class="table table-bordered" style="font-size: 12px">
            <tr><th>{{ __('childLead_show.name') }}</th><td style="text-align: right">{{ $childLead['name'] }}</td></tr>
            <tr><th>{{ __('childLead_show.ota_ona') }}</th><td style="text-align: right">{{ $childLead['ota_ona'] }}</td></tr>
            <tr><th>{{ __('childLead_show.phone') }}</th><td style="text-align: right">{{ $childLead['phone'] }}</td></tr>
            <tr><th>{{ __('childLead_show.phone_two') }}</th><td style="text-align: right">{{ $childLead['phone_two'] }}</td></tr>
            <tr><th>{{ __('childLead_show.tkun') }}</th><td style="text-align: right">{{ $childLead['address'] }}</td></tr>
            <tr><th>{{ __('childLead_show.jinsi') }}</th><td style="text-align: right">{{ $childLead->tkun->format('Y-m-d') }}</td></tr>
            <tr><th>{{ __('childLead_show.holati') }}</th><td style="text-align: right">{{ $childLead['jinsi']=='male'?"O'gil bola":"Qiz bola"}}</td></tr>
            <tr><th>{{ __('childLead_show.reg_data') }} </th><td style="text-align: right">{{ $childLead->creator->name }}</td></tr>
            <tr><th>{{ __('childLead_show.reg_user') }} </th><td style="text-align: right">{{ $childLead['created_at']->format("Y-m-d h:i") }}</td></tr>
            <tr><td colspan="2" class="text-center">{{ $childLead['description'] }}</td></tr>
          </table>            
        </div>
      </div>
    </div>      
    <div class="col-lg-6">
      <div class="card info-card welcome-card">
        <div class="card-body">
          <h5 class="card-title">{{ __('emploes_lead_page_show.eslatmalar') }}</span></h5>
          <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;height: 300px;">
            <table class="table table-bordered table-hover" style="font-size: 12px">
              <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                <tr class="text-center">
                  <th>{{ __('emploes_lead_page_show.eslatma_matni') }}</th>
                  <th>{{ __('emploes_lead_page_show.menejer') }}</th>
                  <th>{{ __('emploes_lead_page_show.eslatma_vaqti') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($childLeadNote as $note)
                  <tr>
                    <td>{{ $note->content }}</td>
                    <td class="text-center text-nowrap">{{ $note->admin ? $note->admin->name : 'Noma\'lum' }}</td>
                    <td class="text-end text-nowrap">{{ $note->created_at->format('d.m.Y H:i') }}</td>
                  </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center">{{ __('emploes_lead_page_show.no_notes') }}</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <hr>    
          <form action="{{ route('childLead_store_node') }}" method="post">
            @csrf
            <div class="row g-2">
              <div class="col-9">
                <input type="hidden" name="type" value="childLead">
                <input type="hidden" name="user_id" value="{{ $childLead->id }}">
                <input type="text" name="content" class="form-control" required autocomplete="off">
              </div>
              <div class="col-3">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>



<div class="modal fade" id="leadCancel" tabindex="-1" aria-hidden="true">
  <form action="{{ route('childLead_cancel') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i> {{ __('childLead_show.arizani_bekor_qilish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">          
          <div class="row g-1">
            <input type="hidden" name="user_id" value="{{ $childLead->id }}">
            <label for="content">{{ __('childLead_show.arizani_bekor_qilish_sababi') }}</label>
            <textarea name="content" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-danger px-5 shadow-sm">{{ __('childLead_show.bekor_qilish')}}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="leadSuccess" tabindex="-1" aria-hidden="true">
  <form action="{{ route('childLead_success') }}" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i> {{ __('childLead_show.bolani_qabul_qilish') }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body">          
          <div class="row g-1">
            <input type="hidden" name="user_id" value="{{ $childLead->id }}">            
            <div class="row">
              <div class="col-12">
                <label for="name" class="my-2">{{ __('childLead_show.name') }}</label>
                <input type="text" name="name" value="{{ $childLead->name }}" class="form-control" required>
              </div>
              <div class="col-6">
                <label for="ota_ona" class="my-2">{{ __('childLead_show.ota_ona') }}</label>
                <input type="text" name="ota_ona" value="{{ $childLead->ota_ona }}" required class="form-control">
              </div>
              <div class="col-6">                
                <label for="address" class="my-2">{{ __('childLead_show.address') }}</label>
                <input type="text" name="address" value="{{ $childLead->address }}" required class="form-control">
              </div>
              <div class="col-6">
                <label for="phone" class="my-2">{{ __('childLead_show.phone') }}</label>
                <input type="text" name="phone" class="form-control phone" value="{{ $childLead->phone }}" required>
              </div>
              <div class="col-6">
                <label for="phone_two" class="my-2">{{ __('childLead_show.phone_two') }}</label>
                <input type="text" name="phone_two" class="form-control phone" value="{{ $childLead->phone_two }}" required>
              </div>
              <div class="col-4">
                <label for="guvohnoma" class="my-2">{{ __('childLead_show.guvohnoma') }}</label>
                <input type="text" name="guvohnoma" required class="form-control">
              </div>
              <div class="col-4">
                <label for="tkun" class="my-2">{{ __('childLead_show.tkun') }}</label>
                <input type="date" name="tkun" value="{{ $childLead->tkun->format('Y-m-d') }}" required class="form-control">
              </div>
              <div class="col-4">
                <label for="jinsi" class="my-2">{{ __('childLead_show.jinsi') }}</label>
                <select name="jinsi" required class="form-select">
                  <option value="">{{ __('childLead_show.tanlang') }}</option>
                  <option value="male" {{ $childLead->jinsi === "male" ? 'selected' : '' }}>{{ __('childLead_show.male') }}</option>
                  <option value="female" {{ $childLead->jinsi === "female" ? 'selected' : '' }}>{{ __('childLead_show.female') }}</option>
                </select>
              </div>
              <div class="col-12">
                <label for="description" class="my-2">{{ __('childLead_show.child_about') }}</label>
                <textarea name="description" required class="form-control">{{ $childLead->description }}</textarea>
              </div>
              <div class="col-12">
                <label for="group_id" class="my-2">{{ __('childLead_show.bola_guruhi_tanlang') }}</label>
                <select name="group_id" required class="form-select">
                  <option value="">{{ __('childLead_show.tanlang') }}</option>
                  @foreach ($groups as $item)
                    <option value="{{ $item['id'] }}">{{ $item['group_name'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">{{ __('childLead_show.bekor_qilish') }}</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">{{ __('childLead_show.bolani_qabul_qilish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection