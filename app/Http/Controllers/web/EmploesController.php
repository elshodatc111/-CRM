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

    public function oshpazSalary($monch,$id,$group_id=null){
        $startDate = Carbon::parse($monch)->startOfMonth();
        $endDate = Carbon::parse($monch)->endOfMonth();
        if($group_id==null){
            $allDavomad = GroupDavomad::whereIn('status',['keldi','kelmadi'])->whereBetween('date', [$startDate, $endDate])->get();
        }else{
            $allDavomad = GroupDavomad::whereIn('status',['keldi','kelmadi'])->whereBetween('date', [$startDate, $endDate])->where('group_id',$group_id)->get();
        }
        $allCount = count($allDavomad);
        $ortacha_davomad = round($allCount/21);
        $SettingPayment = SettingSalary::find($id);
        $tarif = $SettingPayment->child_pay;
        if($ortacha_davomad<=5){$tarif_bonus = 0;$tarif_bonus_count = 0;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = $allCount*$tarif;}
        elseif($ortacha_davomad<10){$tarif_bonus = $SettingPayment['item5'];$tarif_bonus_count = $ortacha_davomad-5;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*5;}
        elseif($ortacha_davomad<15){$tarif_bonus = $SettingPayment['item10'];$tarif_bonus_count = $ortacha_davomad-10;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*10;}
        elseif($ortacha_davomad<20){$tarif_bonus = $SettingPayment['item15'];$tarif_bonus_count = $ortacha_davomad-15;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*15;}
        elseif($ortacha_davomad<25){$tarif_bonus = $SettingPayment['item20'];$tarif_bonus_count = $ortacha_davomad-20;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*20;}
        elseif($ortacha_davomad<30){$tarif_bonus = $SettingPayment['item25'];$tarif_bonus_count = $ortacha_davomad-25;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*25;}
        elseif($ortacha_davomad<35){$tarif_bonus = $SettingPayment['item30'];$tarif_bonus_count = $ortacha_davomad-30;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*30;}
        elseif($ortacha_davomad<40){$tarif_bonus = $SettingPayment['item35'];$tarif_bonus_count = $ortacha_davomad-35;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*35;}
        elseif($ortacha_davomad<45){$tarif_bonus = $SettingPayment['item40'];$tarif_bonus_count = $ortacha_davomad-40;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*40;}
        elseif($ortacha_davomad<50){$tarif_bonus = $SettingPayment['item45'];$tarif_bonus_count = $ortacha_davomad-45;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*45;}
        elseif($ortacha_davomad<55){$tarif_bonus = $SettingPayment['item50'];$tarif_bonus_count = $ortacha_davomad-50;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*50;}
        elseif($ortacha_davomad<60){$tarif_bonus = $SettingPayment['item55'];$tarif_bonus_count = $ortacha_davomad-55;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*55;}
        elseif($ortacha_davomad<65){$tarif_bonus = $SettingPayment['item60'];$tarif_bonus_count = $ortacha_davomad-60;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*60;}
        elseif($ortacha_davomad<70){$tarif_bonus = $SettingPayment['item65'];$tarif_bonus_count = $ortacha_davomad-65;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*65;}
        elseif($ortacha_davomad<75){$tarif_bonus = $SettingPayment['item70'];$tarif_bonus_count = $ortacha_davomad-70;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*70;}
        elseif($ortacha_davomad<80){$tarif_bonus = $SettingPayment['item75'];$tarif_bonus_count = $ortacha_davomad-75;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*75;}
        elseif($ortacha_davomad<85){$tarif_bonus = $SettingPayment['item80'];$tarif_bonus_count = $ortacha_davomad-80;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*80;}
        elseif($ortacha_davomad<90){$tarif_bonus = $SettingPayment['item85'];$tarif_bonus_count = $ortacha_davomad-85;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*85;}
        elseif($ortacha_davomad<95){$tarif_bonus = $SettingPayment['item90'];$tarif_bonus_count = $ortacha_davomad-90;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*90;}
        elseif($ortacha_davomad<100){$tarif_bonus = $SettingPayment['item95'];$tarif_bonus_count = $ortacha_davomad-95;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*95;}
        elseif($ortacha_davomad<105){$tarif_bonus = $SettingPayment['item100'];$tarif_bonus_count = $ortacha_davomad-100;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*100;}
        elseif($ortacha_davomad<110){$tarif_bonus = $SettingPayment['item105'];$tarif_bonus_count = $ortacha_davomad-105;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*105;}
        elseif($ortacha_davomad<115){$tarif_bonus = $SettingPayment['item110'];$tarif_bonus_count = $ortacha_davomad-110;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*110;}
        elseif($ortacha_davomad<120){$tarif_bonus = $SettingPayment['item115'];$tarif_bonus_count = $ortacha_davomad-115;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*115;}
        else{$tarif_bonus = $SettingPayment['item120'];$tarif_bonus_count = $ortacha_davomad-120;$bonus = $tarif_bonus_count * $tarif_bonus;$tarif_buyicha_hisoblash = 21*$tarif*120;}
        $ish_haqi = $bonus + $tarif_buyicha_hisoblash;
        $hisobot = $SettingPayment['hisobot'];
        $shikoyat = $SettingPayment['shikoyat'];
        $bayramlar = $SettingPayment['bayramlar'];
        return [
            'hisobot' => $hisobot,  // Barcha davomad
            'shikoyat' => $shikoyat,  // Barcha davomad
            'bayramlar' => $bayramlar,  // Barcha davomad
            'allDavomad' => $allCount,  // Barcha davomad
            'ortacha_davomad' => $ortacha_davomad, // O'rtacha davomad
            'tarif' => $tarif, // Tarif narxi
            'tarif_buyicha_bolalar' => $allCount,
            'tarif_buyicha_hisoblash' => $tarif_buyicha_hisoblash,
            'tarif_bonus_count' => $tarif_bonus_count,
            'tarif_bonus' => $tarif_bonus,
            'bonus' => $bonus,
            'ish_haqi' => $ish_haqi,
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
            return view('emploes.ish_haqi.administrator',compact('user','monch','davomad','shikoyatlar','salary'));
        }elseif($request->role=='oshpaz'){
            $salary = $this->oshpazSalary($monch,5);
            return view('emploes.ish_haqi.oshpaz',compact('user','monch','davomad','shikoyatlar','salary'));
        }elseif($request->role=='tarbiyachi'){
            $salary_katta = $this->oshpazSalary($monch,1,$request->group_id);
            $salary_kichik = $this->oshpazSalary($monch,2,$request->group_id);
            dd($salary_katta);
            return view('emploes.ish_haqi.tarbiyachi',compact('user','monch','davomad','shikoyatlar','tadbirlar','hisobot'));
        }elseif($request->role=='yordamchi'){
            $salary_katta = $this->oshpazSalary($monch,3,$request->group_id);
            $salary_kichik = $this->oshpazSalary($monch,4,$request->group_id);
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
