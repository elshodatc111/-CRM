@extends('layouts.admin')

@section('title', 'Bolalar ro\'yxati')

@section('content')
<div class="pagetitle">
    <h1>{{ __('menu.child') }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('menu.child') }}</li>
        </ol>
    </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
          <h5 class="card-title m-0">{{ __('child.list') }}</h5>
          <div class="search-bar w-25">
            <input type="text" id="live_search" class="form-control" placeholder="{{ __('child.search') }}">
          </div> 
        </div>
        <div class="card-body pt-3" id="table_data">
          @include('child._table')
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
                url: "{{ route('child_index') }}?page=" + page + "&search=" + search,
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
@endsection