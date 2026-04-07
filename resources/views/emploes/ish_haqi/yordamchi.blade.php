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
        <b class="btn btn-primary mt-2">{{ __('emploes_show.hisoblandi') }} {{ $monch }}</b>
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
                <!-- SHIKOYATLAR -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 320px; overflow-y: auto; overflow-x: hidden;min-height:320px;">
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
                                @forelse($shikoyatlar['shikoyat'] as $item)
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
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 320px; overflow-y: auto; overflow-x: hidden;min-height:320px;">
                        <h2 class="card-title">{{ __('emploes_show.hodim_davomadi') }}</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('emploes_show.dav_status') }}</th>
                                        <th>{{ __('emploes_show.dav_kun') }}</th>
                                        <th>{{ __('emploes_show.dav_about') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($davomad['davomad'] as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
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
                                            <td>{{ $item['data']->format('Y-m-d') }}</td>
                                            <td>{{ $item['description'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('emploes_show.not_found_davomad') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection