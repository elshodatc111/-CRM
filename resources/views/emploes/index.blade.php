@extends('layouts.admin')

@section('title', 'UMKA Kindergarten CRM')

@section('content')
  <div class="row">
    <div class="col-6">
      <div class="pagetitle">
        <h1>Hodimlar</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li class="breadcrumb-item active">Hodimlar</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-6" style="text-align: right">
      <button class="btn btn-primary">Hodim qo'shish</button>
    </div>
  </div>

  <section class="section employes">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">Hodimlar</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size: 12px;">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>FIO</th>
                    <th>Telefon raqam</th>
                    <th>Lavozim</th>
                    <th>Holati</th>
                    <th>Ishga olindi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($emploes as $emploe)
                    <tr class="text-center">
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <a href="{{ route('emploes_show', $emploe['id']) }}">{{ $emploe->name }}</a>
                      </td>
                      <td>{{ $emploe->phone }}</td>
                      <td>{{ $emploe->position }}</td>
                      <td>{{ $emploe->status }}</td>
                      <td>{{ $emploe->hired_at }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Hodimlar mavjud emas</td>
                    </tr>
                  @endforelse
                </tbody >
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection