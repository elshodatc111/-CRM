@extends('layouts.admin')

@section('title', __('menu.salary'))

@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.salary') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.salary') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section salary">
    <div class="row">

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.tarbiyachi') }}</h5>
            <form action="{{ route('setting_salary_terbiyachi') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[0]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[0]['role'] }}">
              <div class="row">
                <div class="col-lg-6">
                  <label for="child_pay" class="mb-1">{{ __('setting_payment.payment') }}</label>
                  <input type="text" name="child_pay" value="{{ $setting[0]['child_pay'] }}" class="form-control" id="price_0_1" required>
                </div>
                <div class="col-lg-6">
                  <label for="hisobot" class="mb-1">{{ __('setting_payment.hsiobot') }}</label>
                  <input type="text" name="hisobot" value="{{ $setting[0]['hisobot'] }}" class="form-control" id="price_0_2" required>
                </div>
                <div class="col-lg-6">
                  <label for="shikoyat" class="my-1">{{ __('setting_payment.shikoyat') }}</label>
                  <input type="text" name="shikoyat" value="{{ $setting[0]['shikoyat'] }}" class="form-control"  id="price_0_3" required>
                </div>
                <div class="col-lg-6">
                  <label for="bayramlar" class="my-1">{{ __('setting_payment.bayramlar') }}</label>
                  <input type="text" name="bayramlar" value="{{ $setting[0]['bayramlar'] }}" class="form-control" id="price_0_4" required>
                </div>
                <div class="col-lg-4">
                  <label for="item5" class="my-1">6-9</label>
                  <input type="text" name="item5" value="{{ $setting[0]['item5'] }}" class="form-control" id="price_0_5" required>
                </div>
                <div class="col-lg-4">
                  <label for="item10" class="my-1">11-14</label>
                  <input type="text" name="item10" value="{{ $setting[0]['item10'] }}" class="form-control" id="price_0_6" required>
                </div>
                <div class="col-lg-4">
                  <label for="item15" class="my-1">16-19</label>
                  <input type="text" name="item15" value="{{ $setting[0]['item15'] }}" class="form-control" id="price_0_7" required>
                </div>
                <div class="col-lg-4">
                  <label for="item20" class="my-1">21-24</label>
                  <input type="text" name="item20" value="{{ $setting[0]['item20'] }}" class="form-control" id="price_0_8" required>
                </div>
                <div class="col-lg-4">
                  <label for="item25" class="my-1">26-29</label>
                  <input type="text" name="item25" value="{{ $setting[0]['item25'] }}" class="form-control" id="price_0_9" required>
                </div>
                <div class="col-lg-4">
                  <label for="item30" class="my-1">31-34</label>
                  <input type="text" name="item30" value="{{ $setting[0]['item30'] }}" class="form-control" id="price_0_10" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">O'zgarishlarni saqlash</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.tarbiyachi_kichik') }}</h5>
            <form action="{{ route('setting_salary_terbiyachikichik') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[1]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[1]['role'] }}">
              <div class="row">
                <div class="col-lg-6">
                  <label for="child_pay" class="mb-1">{{ __('setting_payment.payment') }}</label>
                  <input type="text" name="child_pay" value="{{ $setting[1]['child_pay'] }}" class="form-control" id="price_1_1" required>
                </div>
                <div class="col-lg-6">
                  <label for="hisobot" class="mb-1">{{ __('setting_payment.hsiobot') }}</label>
                  <input type="text" name="hisobot" value="{{ $setting[1]['hisobot'] }}" class="form-control" id="price_1_2" required>
                </div>
                <div class="col-lg-6">
                  <label for="shikoyat" class="my-1">{{ __('setting_payment.shikoyat') }}</label>
                  <input type="text" name="shikoyat" value="{{ $setting[1]['shikoyat'] }}" class="form-control"  id="price_1_3" required>
                </div>
                <div class="col-lg-6">
                  <label for="bayramlar" class="my-1">{{ __('setting_payment.bayramlar') }}</label>
                  <input type="text" name="bayramlar" value="{{ $setting[1]['bayramlar'] }}" class="form-control" id="price_1_4" required>
                </div>
                <div class="col-lg-4">
                  <label for="item5" class="my-1">6-9</label>
                  <input type="text" name="item5" value="{{ $setting[1]['item5'] }}" class="form-control" id="price_1_5" required>
                </div>
                <div class="col-lg-4">
                  <label for="item10" class="my-1">11-14</label>
                  <input type="text" name="item10" value="{{ $setting[1]['item10'] }}" class="form-control" id="price_1_6" required>
                </div>
                <div class="col-lg-4">
                  <label for="item15" class="my-1">16-19</label>
                  <input type="text" name="item15" value="{{ $setting[1]['item15'] }}" class="form-control" id="price_1_7" required>
                </div>
                <div class="col-lg-4">
                  <label for="item20" class="my-1">21-24</label>
                  <input type="text" name="item20" value="{{ $setting[1]['item20'] }}" class="form-control" id="price_1_8" required>
                </div>
                <div class="col-lg-4">
                  <label for="item25" class="my-1">26-29</label>
                  <input type="text" name="item25" value="{{ $setting[1]['item25'] }}" class="form-control" id="price_1_9" required>
                </div>
                <div class="col-lg-4">
                  <label for="item30" class="my-1">31-34</label>
                  <input type="text" name="item30" value="{{ $setting[1]['item30'] }}" class="form-control" id="price_1_10" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('setting_payment.save') }}</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.yordamchi') }}</h5>
            <form action="{{ route('setting_salary_yordamchi') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[2]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[2]['role'] }}">              
              <div class="row">
                <div class="col-lg-6">
                  <label for="child_pay" class="mb-1">{{ __('setting_payment.payment') }}</label>
                  <input type="text" name="child_pay" value="{{ $setting[2]['child_pay'] }}" class="form-control" id="price_2_1" required>
                </div>
                <div class="col-lg-6">
                  <label for="hisobot" class="mb-1">{{ __('setting_payment.hsiobot') }}</label>
                  <input type="text" name="hisobot" value="{{ $setting[2]['hisobot'] }}" class="form-control" id="price_2_2" required>
                </div>
                <div class="col-lg-6">
                  <label for="shikoyat" class="my-1">{{ __('setting_payment.shikoyat') }}</label>
                  <input type="text" name="shikoyat" value="{{ $setting[2]['shikoyat'] }}" class="form-control"  id="price_2_3" required>
                </div>
                <div class="col-lg-6">
                  <label for="bayramlar" class="my-1">{{ __('setting_payment.bayramlar') }}</label>
                  <input type="text" name="bayramlar" value="{{ $setting[2]['bayramlar'] }}" class="form-control" id="price_2_4" required>
                </div>
                <div class="col-lg-4">
                  <label for="item5" class="my-1">6-9</label>
                  <input type="text" name="item5" value="{{ $setting[2]['item5'] }}" class="form-control" id="price_2_5" required>
                </div>
                <div class="col-lg-4">
                  <label for="item10" class="my-1">11-14</label>
                  <input type="text" name="item10" value="{{ $setting[2]['item10'] }}" class="form-control" id="price_2_6" required>
                </div>
                <div class="col-lg-4">
                  <label for="item15" class="my-1">16-19</label>
                  <input type="text" name="item15" value="{{ $setting[2]['item15'] }}" class="form-control" id="price_2_7" required>
                </div>
                <div class="col-lg-4">
                  <label for="item20" class="my-1">21-24</label>
                  <input type="text" name="item20" value="{{ $setting[2]['item20'] }}" class="form-control" id="price_2_8" required>
                </div>
                <div class="col-lg-4">
                  <label for="item25" class="my-1">26-29</label>
                  <input type="text" name="item25" value="{{ $setting[2]['item25'] }}" class="form-control" id="price_2_9" required>
                </div>
                <div class="col-lg-4">
                  <label for="item30" class="my-1">31-34</label>
                  <input type="text" name="item30" value="{{ $setting[2]['item30'] }}" class="form-control" id="price_2_10" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('setting_payment.save') }}</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.yordamchi_kichik') }}</h5>
            <form action="{{ route('setting_salary_yordamchi_kichik') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[3]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[3]['role'] }}">
              <div class="row">
                <div class="col-lg-6">
                  <label for="child_pay" class="mb-1">{{ __('setting_payment.payment') }}</label>
                  <input type="text" name="child_pay" value="{{ $setting[3]['child_pay'] }}" class="form-control" id="price_3_1" required>
                </div>
                <div class="col-lg-6">
                  <label for="hisobot" class="mb-1">{{ __('setting_payment.hsiobot') }}</label>
                  <input type="text" name="hisobot" value="{{ $setting[3]['hisobot'] }}" class="form-control" id="price_3_2" required>
                </div>
                <div class="col-lg-6">
                  <label for="shikoyat" class="my-1">{{ __('setting_payment.shikoyat') }}</label>
                  <input type="text" name="shikoyat" value="{{ $setting[3]['shikoyat'] }}" class="form-control"  id="price_3_3" required>
                </div>
                <div class="col-lg-6">
                  <label for="bayramlar" class="my-1">{{ __('setting_payment.bayramlar') }}</label>
                  <input type="text" name="bayramlar" value="{{ $setting[3]['bayramlar'] }}" class="form-control" id="price_3_4" required>
                </div>
                <div class="col-lg-4">
                  <label for="item5" class="my-1">6-9</label>
                  <input type="text" name="item5" value="{{ $setting[3]['item5'] }}" class="form-control" id="price_3_5" required>
                </div>
                <div class="col-lg-4">
                  <label for="item10" class="my-1">11-14</label>
                  <input type="text" name="item10" value="{{ $setting[3]['item10'] }}" class="form-control" id="price_3_6" required>
                </div>
                <div class="col-lg-4">
                  <label for="item15" class="my-1">16-19</label>
                  <input type="text" name="item15" value="{{ $setting[3]['item15'] }}" class="form-control" id="price_3_7" required>
                </div>
                <div class="col-lg-4">
                  <label for="item20" class="my-1">21-24</label>
                  <input type="text" name="item20" value="{{ $setting[3]['item20'] }}" class="form-control" id="price_3_8" required>
                </div>
                <div class="col-lg-4">
                  <label for="item25" class="my-1">26-29</label>
                  <input type="text" name="item25" value="{{ $setting[3]['item25'] }}" class="form-control" id="price_3_9" required>
                </div>
                <div class="col-lg-4">
                  <label for="item30" class="my-1">31-34</label>
                  <input type="text" name="item30" value="{{ $setting[3]['item30'] }}" class="form-control" id="price_3_10" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('setting_payment.save') }}</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.administrator') }}</h5>            
            <form action="{{ route('setting_salary_admin') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[5]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[5]['role'] }}">
              <div class="row">
                <div class="col-lg-12">
                  <label for="new_child" class="mb-1">{{ __('setting_payment.new_child') }}</label>
                  <input type="text" name="new_child" value="{{ $setting[5]['new_child'] }}" id='amount0' class="form-control" required>
                </div>
                <div class="col-lg-12">
                  <label for="new_lead" class="my-1">{{ __('setting_payment.new_lead') }}</label>
                  <input type="text" name="new_lead" value="{{ $setting[5]['new_lead'] }}" id='amount1' class="form-control" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('setting_payment.save') }}</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card welcome-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('setting_payment.oshpazlar') }}</h5>
            <form action="{{ route('setting_salary_oshpaz') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $setting[4]['id'] }}">
              <input type="hidden" name="role" value="{{ $setting[4]['role'] }}">
              <div class="row">
                <div class="col-lg-12">
                  <label for="child_pay" class="mb-1">{{ __('setting_payment.payment') }}</label>
                  <input type="text" name="child_pay" class="form-control" required  value="{{ $setting[4]['child_pay'] }}" id="amount2">
                </div>
                <div class="col-lg-4">
                  <label for="item5" class="my-1">6-9</label>
                  <input type="text" name="item5" class="form-control" required  value="{{ $setting[4]['item5'] }}" id="amount3">
                </div>
                <div class="col-lg-4">
                  <label for="item10" class="my-1">11-14</label>
                  <input type="text" name="item10" class="form-control" required  value="{{ $setting[4]['item10'] }}" id="amount4">
                </div>
                <div class="col-lg-4">
                  <label for="item15" class="my-1">16-19</label>
                  <input type="text" name="item15" class="form-control" required  value="{{ $setting[4]['item15'] }}" id="amount5">
                </div>
                <div class="col-lg-4">
                  <label for="item20" class="my-1">21-24</label>
                  <input type="text" name="item20" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_1">
                </div>
                <div class="col-lg-4">
                  <label for="item25" class="my-1">26-29</label>
                  <input type="text" name="item25" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_2">
                </div>
                <div class="col-lg-4">
                  <label for="item30" class="my-1">31-34</label>
                  <input type="text" name="item30" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_3">
                </div>
                <div class="col-lg-4">
                  <label for="item35" class="my-1">36-39</label>
                  <input type="text" name="item35" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_4">
                </div>
                <div class="col-lg-4">
                  <label for="item40" class="my-1">41-44</label>
                  <input type="text" name="item40" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_5">
                </div>
                <div class="col-lg-4">
                  <label for="item45" class="my-1">46-49</label>
                  <input type="text" name="item45" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_6">
                </div>
                <div class="col-lg-4">
                  <label for="item50" class="my-1">51-54</label>
                  <input type="text" name="item35" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_7">
                </div>
                <div class="col-lg-4">
                  <label for="item55" class="my-1">56-59</label>
                  <input type="text" name="item55" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_8">
                </div>
                <div class="col-lg-4">
                  <label for="item60" class="my-1">61-64</label>
                  <input type="text" name="item60" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_9">
                </div>
                <div class="col-lg-4">
                  <label for="item65" class="my-1">66-69</label>
                  <input type="text" name="item65" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_10">
                </div>
                <div class="col-lg-4">
                  <label for="item70" class="my-1">71-74</label>
                  <input type="text" name="item70" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_11">
                </div>
                <div class="col-lg-4">
                  <label for="item75" class="my-1">76-79</label>
                  <input type="text" name="item75" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_12">
                </div>
                <div class="col-lg-4">
                  <label for="item80" class="my-1">81-84</label>
                  <input type="text" name="item80" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_13">
                </div>
                <div class="col-lg-4">
                  <label for="item85" class="my-1">86-89</label>
                  <input type="text" name="item85" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_14">
                </div>
                <div class="col-lg-4">
                  <label for="item90" class="my-1">91-94</label>
                  <input type="text" name="item90" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_15">
                </div>
                <div class="col-lg-4">
                  <label for="item95" class="my-1">96-99</label>
                  <input type="text" name="item95" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_16">
                </div>
                <div class="col-lg-4">
                  <label for="item100" class="my-1">101-104</label>
                  <input type="text" name="item100" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_17">
                </div>
                <div class="col-lg-4">
                  <label for="item105" class="my-1">106-109</label>
                  <input type="text" name="item105" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_18">
                </div>
                <div class="col-lg-4">
                  <label for="item110" class="my-1">111-114</label>
                  <input type="text" name="item110" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_19">
                </div>
                <div class="col-lg-4">
                  <label for="item115" class="my-1">116-119</label>
                  <input type="text" name="item115" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_20">
                </div>
                <div class="col-lg-4">
                  <label for="item120" class="my-1">121-124</label>
                  <input type="text" name="item120" class="form-control" required  value="{{ $setting[4]['item110'] }}" id="item_oshpaz_21">
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('setting_payment.save') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection