@extends('layouts.admin')
@section('title', __('menu.group_davomad'))
@section('content')
  <div class="pagetitle">
    <h1>Davomad olish</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('groups_davomad') }}">{{ __('menu.group_davomad') }}</a></li>
        <li class="breadcrumb-item active">Davomad olish</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="card info-card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title text-primary">{{ $group->group_name }}</h5>
          </div>
          <div class="col-6" style="text-align: right">
            <h5 class="card-title text-primary">{{ date('d.m.Y') }}</h5>
          </div>
        </div>
        <form action="{{ route('groups_davomad_store') }}" method="POST">
          @csrf
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" style="font-size: 14px">
              <thead>
                <tr class="text-center">
                  <th style="width: 50px;">#</th>
                  <th>Bola</th>
                  <th style="width: 400px;">Davomad Holati</th>
                </tr>
              </thead>
              <tbody>
                @foreach($child as $key => $student)
                <tr>
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td>{{ $student['name'] }}</td>
                  <td>
                    <div class="d-flex justify-content-around">   
                      <span class="btn btn-danger py-0 my-0 pt-1">
                        <div class="form-check">
                          <input class="form-check-input" type="radio"
                            name="attendance[{{ $student['child_id'] }}]" 
                            id="absent{{ $student['child_id'] }}" 
                            value="kelmadi" 
                            @checked(isset($student['status']) && ($student['status'] == '0' || $student['status'] == 'kelmadi'))>
                          <label class="form-check-label text-white" for="absent{{ $student['child_id'] }}">
                            Kelmadi
                          </label>
                        </div>
                      </span>
                      <span class="btn btn-warning py-0 my-0 pt-1">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" 
                            name="attendance[{{ $student['child_id'] }}]" 
                            id="reason{{ $student['child_id'] }}" 
                            value="kechikdi" 
                            @checked(isset($student['status']) && ($student['status'] == '2' || $student['status'] == 'sababli' || $student['status'] == 'kechikdi'))>
                          <label class="form-check-label text-white" for="reason{{ $student['child_id'] }}">
                            Kechikdi
                          </label>
                        </div>
                      </span>                   
                      <span class="btn btn-success py-0 my-0 pt-1">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" 
                            name="attendance[{{ $student['child_id'] }}]" 
                            id="present{{ $student['child_id'] }}"
                            value="keldi" 
                            @checked(!isset($student['status']) || $student['status'] == '1' || $student['status'] == 'keldi')>
                          <label class="form-check-label text-white" for="present{{ $student['child_id'] }}">
                            Keldi
                          </label>
                        </div>
                      </span>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="text-end mt-3">
            <button type="submit" class="btn btn-outline-primary px-5">
                <i class="bi bi-check"></i> Davomadni saqlash
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection