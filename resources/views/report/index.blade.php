@extends('layouts.admin')

@section('title', __('menu.reports'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.reports') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.reports') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section reports">
    <div class="card info-card welcome-card">
      <div class="card-body">
        <h5 class="card-title">{{ __('menu.reports') }}</h5>
        <form action="{{ route('report_post') }}" method="post">
          @csrf 
          <div class="row">
            <div class="col-lg-7 mt-2">
              <select name="type" required class="form-select">
                <option value="">{{ __('group_show.tanlang') }}</option>
                <option value="balans_histories">{{ __('report.balans_histories') }}</option>
                <option value="kassa_histories">{{ __('report.kassa_histories') }}</option>
                <option value="children">{{ __('report.children') }}</option>
                <option value="child_leads">{{ __('report.child_leads') }}</option>
                <option value="child_payments">{{ __('report.child_payments') }}</option>
                <option value="group_users">{{ __('report.group_users') }}</option>
                <option value="group_children">{{ __('report.group_children') }}</option>
                <option value="group_payments">{{ __('report.group_payments') }}</option>
                <option value="group_hisobots">{{ __('report.group_hisobots') }}</option>
                <option value="group_davomads">{{ __('report.group_davomads') }}</option>
                <option value="users">{{ __('report.users') }}</option>
                <option value="user_davomads">{{ __('report.user_davomads') }}</option>
                <option value="user_leads">{{ __('report.user_leads') }}</option>
                <option value="user_payments">{{ __('report.user_payments') }}</option>
                <option value="user_shikoyats">{{ __('report.user_shikoyats') }}</option>
              </select>
            </div>
            <div class="col-lg-5 mt-2">
              <button type="submit" class="btn btn-primary w-100">{{ __('group_show.yuklash') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection