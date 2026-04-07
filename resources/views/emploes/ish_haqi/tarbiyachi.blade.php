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
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;min-height:500px;">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2 class="card-title">{{ $user['name'] }} ({{ __('emploes_show.kichik_guruh') }})</h2>
                            </div>
                            <div class="col-lg-4" style="text-align: right">
                                <h2 class="card-title">{{ $monch }}</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">KPI</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('emploes_show.kunlik_hisobot') }}</th>
                                        <th>{{ __('emploes_show.bay_tadbir') }}</th>
                                        <th>{{ __('emploes_show.shikoy') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('emploes_show.holati') }}</td>
                                        <td>
                                            @if($salary['hisobot_status']=='true')
                                                <i class='text-success'>{{ __('emploes_show.topshirgan') }}</i>
                                            @else
                                                <i class='text-danger'>{{ __('emploes_show.topshirmagan') }}</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['tadbir_status']=='true')
                                                <i class='text-success'>{{ __('emploes_show.navjud') }}</i>
                                            @else
                                                <i class='text-danger'>{{ __('emploes_show.no_mavjud') }}</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['shikoyat_status']=='false')
                                                <i class='text-danger'>{{ __('emploes_show.navjud') }}</i>
                                            @else
                                                <i class='text-success'>{{ __('emploes_show.no_mavjud') }}</i>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $kpi = 0; ?>
                                    <tr>
                                        <td>{{ __('emploes_show.tulov') }}</td>
                                        <td>
                                            @if($salary['hisobot_status']=='true')
                                                <?php $kpi = $kpi +  $salary['kichik_guruh']['hisobot'] ?>
                                                {{ number_format($salary['kichik_guruh']['hisobot'], 0, '.', ' ') }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['tadbir_status']=='true')
                                                <?php $kpi = $kpi +  $salary['kichik_guruh']['bayramlar'] ?>
                                                {{ number_format($salary['kichik_guruh']['bayramlar'], 0, '.', ' ') }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['shikoyat_status']=='false')
                                                0
                                            @else
                                                <?php $kpi = $kpi +  $salary['kichik_guruh']['shikoyat'] ?>
                                                {{ number_format($salary['kichik_guruh']['shikoyat'], 0, '.', ' ') }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <th>{{ __('emploes_show.dabomad_soni') }}</th>
                                        <td style="text-align: right">{{ $salary['kichik_guruh']['allDavomad'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.ortacha_davomad') }}</th>
                                        <td style="text-align: right">{{ $salary['kichik_guruh']['ortacha_davomad'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.tarif_narxi') }}</th>
                                        <td style="text-align: right">{{ number_format($salary['kichik_guruh']['tarif'], 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.bonusli_davomad_soni') }}</th>
                                        <td style="text-align: right">{{ $salary['kichik_guruh']['tarif_bonus_count'] }}</td> 
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.bonus_summasi') }}</th>
                                        <td style="text-align: right">{{ number_format($salary['kichik_guruh']['tarif_bonus'], 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>KPI</th>
                                        <td style="text-align: right">{{ number_format($kpi, 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.hisoblandi') }}</th>
                                        <?php $ishHaqi = $kpi + $salary['kichik_guruh']['ish_haqi']; ?>
                                        <td style="text-align: right">{{ number_format($ishHaqi, 0, '.', ' ') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;min-height:500px;">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2 class="card-title">{{ $user['name'] }} ({{ __('emploes_show.katta_guruh') }})</h2>
                            </div>
                            <div class="col-lg-4" style="text-align: right">
                                <h2 class="card-title">{{ $monch }}</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">KPI</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('emploes_show.kunlik_hisobot') }}</th>
                                        <th>{{ __('emploes_show.bay_tadbir') }}</th>
                                        <th>{{ __('emploes_show.shikoy') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('emploes_show.holati') }}</td>
                                        <td>
                                            @if($salary['hisobot_status']=='true')
                                                <i class='text-success'>{{ __('emploes_show.topshirgan') }}</i>
                                            @else
                                                <i class='text-danger'>{{ __('emploes_show.topshirmagan') }}</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['tadbir_status']=='true')
                                                <i class='text-success'>{{ __('emploes_show.navjud') }}</i>
                                            @else
                                                <i class='text-danger'>{{ __('emploes_show.no_mavjud') }}</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['shikoyat_status']=='false')
                                                <i class='text-danger'>{{ __('emploes_show.navjud') }}</i>
                                            @else
                                                <i class='text-success'>{{ __('emploes_show.no_mavjud') }}</i>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $kpi2 = 0; ?>
                                    <tr>
                                        <td>{{ __('emploes_show.tulov') }}</td>
                                        <td>
                                            @if($salary['hisobot_status']=='true')
                                                <?php $kpi2 = $kpi2 +  $salary['katta_guruh']['hisobot'] ?>
                                                {{ number_format($salary['katta_guruh']['hisobot'], 0, '.', ' ') }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['tadbir_status']=='true')
                                                <?php $kpi2 = $kpi2 +  $salary['katta_guruh']['bayramlar'] ?>
                                                {{ number_format($salary['katta_guruh']['bayramlar'], 0, '.', ' ') }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($salary['shikoyat_status']=='false')
                                                0
                                            @else
                                                <?php $kpi2 = $kpi2 +  $salary['katta_guruh']['shikoyat'] ?>
                                                {{ number_format($salary['katta_guruh']['shikoyat'], 0, '.', ' ') }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <th>{{ __('emploes_show.dabomad_soni') }}</th>
                                        <td style="text-align: right">{{ $salary['katta_guruh']['allDavomad'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.ortacha_davomad') }}</th>
                                        <td style="text-align: right">{{ $salary['katta_guruh']['ortacha_davomad'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.tarif_narxi') }}</th>
                                        <td style="text-align: right">{{ number_format($salary['katta_guruh']['tarif'], 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.bonusli_davomad_soni') }}</th>
                                        <td style="text-align: right">{{ $salary['katta_guruh']['tarif_bonus_count'] }}</td> 
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.bonus_summasi') }}</th>
                                        <td style="text-align: right">{{ number_format($salary['katta_guruh']['tarif_bonus'], 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>KPI</th>
                                        <td style="text-align: right">{{ number_format($kpi2, 0, '.', ' ') }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('emploes_show.hisoblandi') }}</th>
                                        <?php $ishHaqi2 = $kpi2 + $salary['katta_guruh']['ish_haqi']; ?>
                                        <td style="text-align: right">{{ number_format($ishHaqi2, 0, '.', ' ') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hisobotlar -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 320px; overflow-y: auto; overflow-x: hidden;min-height:320px;">
                        <h2 class="card-title">{{ __('emploes_show.hisobotlar') }}</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('emploes_show.hisobotlar') }}</th>
                                        <th>{{ __('emploes_show.hisobot_status') }}</th>
                                        <th>{{ __('emploes_show.otqazish_vaqti') }}</th>
                                        <th>{{ __('emploes_show.administrator') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($hisobot['tadbirlar'] as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>
                                                @if($item['is_active'])
                                                    <i class="text-success">Yuborildi</i>
                                                @else
                                                    <i class="text-danger">Yuborilmadi</i>
                                                @endif
                                            </td>
                                            <td>{{ $item['data']->format('Y-m-d') }}</td>
                                            <td>{{ $item->admin->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('emploes_show.hisobotlar_mavjud_emas') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Batram tadbirlari -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="notes-wrapper" style="max-height: 320px; overflow-y: auto; overflow-x: hidden;min-height:320px;">
                        <h2 class="card-title">{{ __('emploes_show.bayram_tadbirlar') }}</h2> 
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('emploes_show.bayram_tadbirlar') }}</th>
                                        <th>{{ __('emploes_show.otqazish_vaqti') }}</th>
                                        <th>{{ __('emploes_show.administrator') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tadbirlar['tadbirlar'] as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['data']->format('Y-m-d') }}</td>
                                            <td>{{ $item->admin->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('emploes_show.bayram_tadbirlari_mavjud_emas') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHIKOYATLAR -->
        <div class="col-lg-6">
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
        <div class="col-lg-6">
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