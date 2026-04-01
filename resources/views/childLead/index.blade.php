@extends('layouts.admin')

@section('title',  __('menu.childLead') )

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="pagetitle">
        <h1>{{ __('menu.childLead') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.childLead') }}</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-lg-6" style="text-align: right">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_child_lead">
        <i class="bi bi-person-plus me-1"></i> {{ __('childLead.create_lead') }}
      </button>
    </div>
  </div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
          <h5 class="card-title m-0">{{ __('menu.childLead') }}</h5>
          <div class="search-bar w-25">
            <input type="text" id="live_search" class="form-control" placeholder="{{ __('child.search') }}">
          </div> 
        </div>
        <div class="card-body pt-3" id="table_data">
          @include('childLead._table')
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetch_data(page, search) {
            $.ajax({
                url: "{{ route('childLead_index') }}?page=" + page + "&search=" + search,
                success: function(data) {
                    $('#table_data').html(data);
                }
            });
        }
        $(document).on('keyup', '#live_search', function() {
            var search = $(this).val();
            var page = 1;
            fetch_data(page, search);
        });
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var search = $('#live_search').val();
            fetch_data(page, search);
        });
    });
</script>


<div class="modal fade" id="create_child_lead" tabindex="-1" aria-hidden="true">
    <form action="{{ route('childLead_store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-plus me-2"></i> {{ __('childLead.create_lead') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">{{ __('childLead.fio') }}</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" id="modal_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-bold">{{ __('childLead.asosiy_phone') }}</label>
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control phone" id="modal_phone" value="+998" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_two" class="form-label fw-bold">{{ __('childLead.qoshimcha_phone') }}</label>
                            <div class="input-group">
                                <input type="text" name="phone_two" class="form-control phone" id="modal_phone_two" value="+998" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="ota_ona" class="form-label fw-bold">{{ __('childLead.ota_onasi') }}</label>
                            <input type="text" name="ota_ona" class="form-control" id="modal_ota_ona" required>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label fw-bold">{{ __('childLead.address') }}</label>
                            <input type="text" name="address" class="form-control" id="modal_address" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tkun" class="form-label fw-bold">{{ __('childLead.tkun') }}</label>
                            <input type="date" name="tkun" class="form-control" id="modal_tkun" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('childLead.jinsi') }} <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jinsi" id="jinsi_male" value="male" checked required>
                                    <label class="form-check-label" for="jinsi_male">{{ __('childLead.ogil') }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jinsi" id="jinsi_female" value="female" required>
                                    <label class="form-check-label" for="jinsi_female">{{ __('childLead.qiz') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold">{{ __('childLead.comment') }}</label>
                            <textarea name="description" class="form-control" id="modal_description" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">{{ __('childLead.canceld') }}</button>
                    <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="bi bi-check-circle me-1"></i> {{ __('childLead.saqlash') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection