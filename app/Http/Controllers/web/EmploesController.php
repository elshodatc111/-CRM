<?php

namespace App\Http\Controllers\web;

use App\Exports\SalaryAdminReportExport;
use App\Exports\SalaryOshpazReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\EmployeeStoreRequest;
use App\Http\Requests\Emploes\StoreUserPaymentRequest;
use App\Http\Requests\Emploes\UpdateUserRequest;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\Child;
use App\Models\ChildLead;
use App\Models\ChildPayment;
use App\Models\GroupDavomad;
use App\Models\GroupHisobot;
use App\Models\GroupUser;
use App\Models\SettingSalary;
use App\Models\User;
use App\Models\UserDavomad;
use App\Models\UserPayment;
use App\Models\UserShikoyat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmploesController extends Controller{

    public function index(){
        $emploes = User::where('role','!=','superadmin')->get();
        return view('emploes.index', compact('emploes'));
    }

    function getLastSixMonths(): array{
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths($i);
            $months[] = [
                'value' => $date->format('Y-m'),
                'label' => $date->format('Y-M'),
            ];
        }
        return $months;
    }

    public function show($id){
        $userT = User::findOrFail($id);
        $userDavomad = UserDavomad::where('user_id',$id)->orderby('data','desc')->get();
        $shikoyat = UserShikoyat::where('user_id',$id)->orderby('id','desc')->get();
        $groupUsers = GroupUser::where('user_id',$id)->orderby('id','desc')->get();
        $balans = Balans::getInstance();
        $payments = UserPayment::where('user_id',$id)->orderby('id','desc')->get();
        $oxirgiOltiOy = $this->getLastSixMonths();
        $salary = SettingSalary::get();
        $group_id = null;
        foreach ($groupUsers as $key => $value) {
            if($value->is_active){
                $group_id = $value->group_id;
            }
        }
        return view('emploes.show', compact('userT','userDavomad','shikoyat','groupUsers','balans','payments','oxirgiOltiOy','salary','group_id'));
    }

    public function davomad($monch,$user_id){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        $davomad = UserDavomad::where('user_id', $user_id)->whereBetween('data', [$startDate, $endDate])->get();
        $keldi = 0;
        $keldi_formasiz = 0;
        $kechikdi_formasiz = 0;
        $kechikdi_sababli = 0;
        $kechikdi_sababsiz = 0;
        $kelmadi = 0;
        $kelmadi_sababli = 0;
        foreach ($davomad as $key => $value) {
            if($value->status == 'keldi'){$keldi = $keldi + 1;}
            elseif($value->status == 'keldi_formasiz'){$keldi_formasiz = $keldi_formasiz+1;}
            elseif($value->status == 'kechikdi_formasiz'){$kechikdi_formasiz = $kechikdi_formasiz+1;}
            elseif($value->status == 'kechikdi_sababli'){$kechikdi_sababli = $kechikdi_sababli+1;}
            elseif($value->status == 'kechikdi_sababsiz'){$kechikdi_sababsiz = $kechikdi_sababsiz+1;}
            elseif($value->status == 'kelmadi'){$kelmadi = $kelmadi+1;}
            elseif($value->status == 'kelmadi_sababli'){$kelmadi_sababli = $kelmadi_sababli+1;}
        }
        $all = $keldi + $keldi_formasiz + $kechikdi_formasiz + $kechikdi_sababli + $kechikdi_sababsiz + $kelmadi + $kelmadi_sababli;
        return [
            'davomad' => $davomad,
            'davomad_olindi' => $all,
            'keldi' => $keldi,
            'keldi_formasiz' => $keldi_formasiz,
            'kechikdi_formasiz' => $kechikdi_formasiz,
            'kechikdi_sababli' => $kechikdi_sababli,
            'kechikdi_sababsiz' => $kechikdi_sababsiz,
            'kelmadi' => $kelmadi,
            'kelmadi_sababli' => $kelmadi_sababli,
        ];
    }

    public function tadbirlar($monch,$group_id){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        if($group_id==null){
            return [
                'soni' => 0,
                'tadbirlar' => [],
            ];
        }
        $tadbirlar = GroupHisobot::where('group_id', $group_id)->where('type','tadbir')->whereBetween('data', [$startDate, $endDate])->get();
        return [
            'soni' => count($tadbirlar),
            'tadbirlar' => $tadbirlar,
        ];
    }

    public function hisobot($monch,$group_id){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        if($group_id==null){
            return [
                'yubordi' => 0,
                'yubormadi' => 0,
                'tadbirlar' => [],
            ];
        }
        $tadbirlar = GroupHisobot::where('group_id', $group_id)->where('type','hisobot')->whereBetween('data', [$startDate, $endDate])->get();
        $yubordi = 0;
        $yubormadi = 0;
        foreach ($tadbirlar as $key => $value) {
            if($value->is_active){
                $yubordi = $yubordi + 1;
            }else{
                $yubormadi = $yubormadi + 1;
            }
        }
        return [
            'yubordi' => $yubordi,
            'yubormadi' => $yubormadi,
            'tadbirlar' => $tadbirlar,
        ];
    }

    public function shikoyatlar($monch,$user_id){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        $shikoyat = UserShikoyat::where('user_id', $user_id)->whereBetween('created_at', [$startDate, $endDate])->get();
        return [
            'soni' => count($shikoyat),
            'shikoyat' => $shikoyat,
        ];
    }

    public function adminSalary($monch,$user_id){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        $childLeats = ChildLead::where('created_by',$user_id)->whereBetween('created_at', [$startDate, $endDate])->get();
        $child = Child::where('created_by',$user_id)->whereBetween('created_at', [$startDate, $endDate])->get();
        $child_payment = 0;
        foreach ($child as $key => $value) {
            $childPayment = ChildPayment::where('child_id',$value->id)->where('type','payment')->where('status','success')->count();
            if($childPayment>0){
                $child_payment = $child_payment + 1;
            }
        }
        $seetting = SettingSalary::find(6);
        $user = User::find($user_id);
        return [
            'oklad' => $user->salary,
            'new_child' => $child_payment,
            'new_child_pay' => $seetting->new_child,
            'new_lead' => count($childLeats),
            'new_lead_pay' => $seetting->new_lead,
        ];
    }

    public function calcEmploesAndExport(Request $request){
        $user = User::find($request['user_id']);
        $monch = $request['monch'];
        $davomad = $this->davomad($monch,$request->user_id);
        $shikoyatlar = $this->shikoyatlar($monch,$request->user_id);
        $tadbirlar = $this->tadbirlar($monch,$request->group_id);
        $hisobot = $this->hisobot($monch,$request->group_id);
        if($request->role=='admin'){
            $salary = $this->adminSalary($monch,$request->user_id);
            //dd($salary);
            return view('emploes.ish_haqi.administrator',compact('user','monch','davomad','shikoyatlar','salary'));
        }elseif($request->role=='oshpaz'){
            return view('emploes.ish_haqi.oshpaz',compact('user','monch','davomad','shikoyatlar','tadbirlar','hisobot'));
        }elseif($request->role=='tarbiyachi'){
            return view('emploes.ish_haqi.tarbiyachi',compact('user','monch','davomad','shikoyatlar','tadbirlar','hisobot'));
        }elseif($request->role=='yordamchi'){
            return view('emploes.ish_haqi.yordamchi',compact('user','monch','davomad','shikoyatlar','tadbirlar','hisobot'));
        }else{
            return redirect()->back()->with('success', '');
        }
    }

    public function store(EmployeeStoreRequest $request){
        $validated = $request->validated(); 
        $validated['password'] = Hash::make('password');
        $validated['status'] = 'true';
        $validated['addres'] = $request->address;
        User::create($validated);
        return redirect()->back()->with('success', __('emploes_page.success_message'));
    }

    public function update(UpdateUserRequest $request){
        $validated = $request->validated();
        $user = User::findOrFail($request->user_id);
        $user->update($validated);
        return redirect()->back()->with('success', __('emploes_page.emploes_update'));
    }

    public function update_password(Request $request){
        $user = User::findOrFail($request->id);
        $user->password =  Hash::make('password');
        $user->save();
        return redirect()->back()->with('success', __('emploes_show.password_update_success'));
    }

    public function storePayments(StoreUserPaymentRequest $request){
        DB::transaction(function () use ($request) {
            $balans = Balans::first();
            if($request->type=='cash'){$balans->decrement('cash', $request['salary']);  }
            elseif($request->type=='card'){$balans->decrement('card', $request['salary']);  }
            elseif($request->type=='bank'){$balans->decrement('bank', $request['salary']);  }
            elseif($request->type=='sub'){$balans->decrement('sub', $request['salary']);  }
            UserPayment::create([
                'user_id' => $request->user_id,
                'salary' => $request->salary,
                'type' => $request->type,
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
            BalansHistory::create([
                'type' => 'salary',
                'status' => 'success',
                'amount' => $request->salary,
                'amount_type' => $request->type,
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
        });
        return redirect()->back()->with('success',__('emploes_show.ish_haqi_success'));
    }

}
