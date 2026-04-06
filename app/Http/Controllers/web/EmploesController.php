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
use App\Models\ChildLead;
use App\Models\ChildPayment;
use App\Models\GroupDavomad;
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
        return view('emploes.show', compact('userT','userDavomad','shikoyat','groupUsers','balans','payments','oxirgiOltiOy','salary'));
    }

    public function calculateAdministratorAndExport(Request $request){
        $Monch = $request->monch;
        $user_id = $request->user_id;
        $leads = ChildLead::where('created_by', $user_id)->whereYear('created_at', date('Y', strtotime($Monch)))->whereMonth('created_at', date('m', strtotime($Monch)))->get();
        $childs = ChildLead::where('created_by', $user_id)->where('child_id','!=',null)->whereYear('created_at', date('Y', strtotime($Monch)))->whereMonth('created_at', date('m', strtotime($Monch)))->get();
        $new_child_count = 0;
        foreach ($childs as $key => $value) {
            $childPayment = ChildPayment::where('child_id', $value->child_id)
                ->where('type','payment')
                ->whereYear('created_at', date('Y', strtotime($Monch)))
                ->whereMonth('created_at', date('m', strtotime($Monch)))
                ->first();
            if($childPayment){
                $new_child_count = $new_child_count + 1;
            }
        }
        $new_lead_count = count($leads);
        $data = [
            'user_id'   => $user_id,
            'new_child_count' => (int) $new_child_count,
            'new_lead_count'  => (int) $new_lead_count,
            'monch'     => $request->monch,
        ];
        $username = User::find($request->user_id)->name;
        $fileName = $username.'_ish_haqi_'.$data['monch'].'_'.time().'.xlsx';
        return Excel::download(new SalaryAdminReportExport($data), $fileName);
    }

    public function ortachaHisobot(int $childCount, int $ishKunlari, int $settingID){
        $ortachaBolalar = $childCount/$ishKunlari;
        $setting = SettingSalary::find($settingID);
        if($ortachaBolalar>119){
            $ItemChild = 120; 
            $ItemChildBonusCount = $childCount - 120;
            $child_pay_bonus = $setting['item120'];
        }elseif($ortachaBolalar>114){
            $ItemChild = 115; 
            $ItemChildBonusCount = $childCount - 115;
            $child_pay_bonus = $setting['item115'];
        }elseif($ortachaBolalar>109){
            $ItemChild = 110; 
            $ItemChildBonusCount = $childCount - 110;
            $child_pay_bonus = $setting['item110'];
        }elseif($ortachaBolalar>104){
            $ItemChild = 105; 
            $ItemChildBonusCount = $childCount - 105;
            $child_pay_bonus = $setting['item105'];
        }elseif($ortachaBolalar>99){
            $ItemChild = 100; 
            $ItemChildBonusCount = $childCount - 100;
            $child_pay_bonus = $setting['item100'];
        }elseif($ortachaBolalar>94){
            $ItemChild = 95; 
            $ItemChildBonusCount = $childCount - 95;
            $child_pay_bonus = $setting['item95'];
        }elseif($ortachaBolalar>89){
            $ItemChild = 90; 
            $ItemChildBonusCount = $childCount - 90;
            $child_pay_bonus = $setting['item90'];
        }elseif($ortachaBolalar>84){
            $ItemChild = 85; 
            $ItemChildBonusCount = $childCount - 85;
            $child_pay_bonus = $setting['item85'];
        }elseif($ortachaBolalar>79){
            $ItemChild = 80; 
            $ItemChildBonusCount = $childCount - 80;
            $child_pay_bonus = $setting['item80'];
        }elseif($ortachaBolalar>74){
            $ItemChild = 75; 
            $ItemChildBonusCount = $childCount - 75;
            $child_pay_bonus = $setting['item75'];
        }elseif($ortachaBolalar>69){
            $ItemChild = 70; 
            $ItemChildBonusCount = $childCount - 70;
            $child_pay_bonus = $setting['item70'];
        }elseif($ortachaBolalar>64){
            $ItemChild = 65; 
            $ItemChildBonusCount = $childCount - 65;
            $child_pay_bonus = $setting['item65'];
        }elseif($ortachaBolalar>59){
            $ItemChild = 60; 
            $ItemChildBonusCount = $childCount - 60;
            $child_pay_bonus = $setting['item60'];
        }elseif($ortachaBolalar>54){
            $ItemChild = 55; 
            $ItemChildBonusCount = $childCount - 55;
            $child_pay_bonus = $setting['item55'];
        }elseif($ortachaBolalar>49){
            $ItemChild = 50; 
            $ItemChildBonusCount = $childCount - 50;
            $child_pay_bonus = $setting['item50'];
        }elseif($ortachaBolalar>44){
            $ItemChild = 45; 
            $ItemChildBonusCount = $childCount - 45;
            $child_pay_bonus = $setting['item45'];
        }elseif($ortachaBolalar>39){
            $ItemChild = 40; 
            $ItemChildBonusCount = $childCount - 40;
            $child_pay_bonus = $setting['item40'];
        }elseif($ortachaBolalar>34){
            $ItemChild = 35; 
            $ItemChildBonusCount = $childCount - 35;
            $child_pay_bonus = $setting['item35'];
        }elseif($ortachaBolalar>29){
            $ItemChild = 30; 
            $ItemChildBonusCount = $childCount - 30;
            $child_pay_bonus = $setting['item30'];
        }elseif($ortachaBolalar>24){
            $ItemChild = 25; 
            $ItemChildBonusCount = $childCount - 25;
            $child_pay_bonus = $setting['item25'];
        }elseif($ortachaBolalar>19){
            $ItemChild = 20; 
            $ItemChildBonusCount = $childCount - 20;
            $child_pay_bonus = $setting['item20'];
        }elseif($ortachaBolalar>14){
            $ItemChild = 15; 
            $ItemChildBonusCount = $childCount - 15;
            $child_pay_bonus = $setting['item15'];
        }elseif($ortachaBolalar>9){
            $ItemChild = 10; 
            $ItemChildBonusCount = $childCount - 10;
            $child_pay_bonus = $setting['item10'];
        }elseif($ortachaBolalar>4){
            $ItemChild = 5; 
            $ItemChildBonusCount = $childCount - 5;
            $child_pay_bonus = $setting['item5'];
        }else{
            $ItemChild = $childCount; 
            $ItemChildBonusCount = 0;
            $child_pay_bonus = 0;
        }
        return [
            'hisobot' => $setting->hisobot,
            'bayramlar' => $setting->bayramlar,
            'shikoyat' => $setting->shikoyat,
            'child_pay' => $setting->child_pay,
            'ish_kunlari' => $ishKunlari,
            'jami_bolalar' => $childCount,
            'kunlik_ortacha_bolalar' => round($childCount/$ishKunlari),
            'child_pay_count' => $ItemChild,
            'child_pay_bonus' => $child_pay_bonus,
            'child_pay_bonus_count' => $ItemChildBonusCount
        ];
    }

    public function calculateOshpazistratorAndExport(Request $request){
        $Monch = $request->monch;
        $childCount = GroupDavomad::whereIn('status', ['keldi', 'kechikdi'])->whereYear('created_at', date('Y', strtotime($Monch)))->whereMonth('created_at', date('m', strtotime($Monch)))->count();
        $array = $this->ortachaHisobot($childCount, $request->countData, 5);
        $req = [
            "user_id" => $request->user_id,
            "name" => User::find($request->user_id)->name,
            "monch" => $request->monch,
            "countData" => $request->countData,
            'child_pay' => $array['child_pay'],
            'jami_bolalar' => $array['jami_bolalar'],
            'kunlik_ortacha_bolalar' => $array['kunlik_ortacha_bolalar'],
            'child_pay_count' => $array['child_pay_count'],
            'child_pay_bonus' => $array['child_pay_bonus'],
            'child_pay_bonus_count' => $array['child_pay_bonus_count'],
        ];
        $fileName = $req['name'].'_ish_haqi_'.$req['monch'].'_'.time(). '.xlsx';
        return Excel::download(new SalaryOshpazReportExport($req), $fileName);
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
