@extends('layouts.admin')

@section('title', "Ariza haqida")

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="pagetitle">
      <h1>Ariza haqida</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('childLead_index') }}">{{ __('menu.childLead') }}</a></li>
          <li class="breadcrumb-item active">Ariza haqida</li>
        </ol>
      </nav>
    </div>
  </div>
  @if($childLead['status'] == 'new' || $childLead['status'] == 'pending')
  <div class="col-lg-6" style="text-align: right">
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#leadCancel">Arizani bekor qilish</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leadSuccess">Bolani qabul qilish</button>
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
              <div class="col-6">Ariza haqida</div>
              <div class="col-6" style="text-align: right">
                @if($childLead['status'] == 'new')
                <span class="badge bg-info text-white">Yangi</span>
                @elseif($childLead['status'] == 'pending')
                <span class="badge bg-warning text-white">Jarayonda</span>
                @elseif($childLead['status'] == 'success')
                <span class="badge bg-success text-white">Qabul qilindi</span>
                @else
                <span class="badge bg-danger text-white">Bekor qilindi</span>
                @endif
              </div>
            </div>
          </h5>
          <table class="table table-bordered" style="font-size: 12px">
            <tr><th>Bola FIO</th><td style="text-align: right">{{ $childLead['name'] }}</td></tr>
            <tr><th>Ota onasi</th><td style="text-align: right">{{ $childLead['ota_ona'] }}</td></tr>
            <tr><th>Telefon raqam</th><td style="text-align: right">{{ $childLead['phone'] }}</td></tr>
            <tr><th>Qo'shimcha telefon</th><td style="text-align: right">{{ $childLead['phone_two'] }}</td></tr>
            <tr><th>Tug'ilgan kuni</th><td style="text-align: right">{{ $childLead['address'] }}</td></tr>
            <tr><th>Jinsi</th><td style="text-align: right">{{ $childLead->tkun->format('Y-m-d') }}</td></tr>
            <tr><th>Holati</th><td style="text-align: right">{{ $childLead['jinsi']=='male'?"O'gil bola":"Qiz bola"}}</td></tr>
            <tr><th>Ro'yhatga olindi</th><td style="text-align: right">{{ $childLead->creator->name }}</td></tr>
            <tr><th>Ro'yhatga oldi</th><td style="text-align: right">{{ $childLead['created_at']->format("Y-m-d h:i") }}</td></tr>
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
            <i class="bi bi-shield-lock me-2"></i> Arizani bekor qilish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">          
          <div class="row g-1">
            <input type="hidden" name="user_id" value="{{ $childLead->id }}">
            <label for="content">Arizani bekor qilish sababi</label>
            <textarea name="content" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-danger px-5 shadow-sm">Bekor qilish</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="leadSuccess" tabindex="-1" aria-hidden="true">
  <form action="#" method="post">
    @csrf 
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock me-2"></i> Arizani qabul qilish
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body p-4">          
          <div class="row g-1">
            <input type="hidden" name="user_id" value="{{ $childLead->id }}">
            <label for="new_password">ssssss</label>
            <input type="password" name="password" class="form-control" required>
            <label for="new_password">ssssss</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection