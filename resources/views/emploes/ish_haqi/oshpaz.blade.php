@extends('layouts.admin')
@section('title', "Ish haqi")
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="pagetitle">
            <h1>Ish haqi</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('emploes_index') }}">{{ __('menu.emploes') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('emploes_show',$user['id']) }}">{{ __('emploes_show.title') }}</a></li>
                <li class="breadcrumb-item active">Ish haqi</li>
            </ol>
            </nav>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right">
        <b class="btn btn-outline-primary mt-2">{{ $monch }}</b>
    </div>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Hisoblandi</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Shikoyatlar</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Davomadi</h2>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection