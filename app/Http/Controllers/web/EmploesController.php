<?php

namespace App\Http\Controllers\web;

use App\Exports\SalaryAdminReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\EmployeeStoreRequest;
use App\Http\Requests\Emploes\StoreUserPaymentRequest;
use App\Http\Requests\Emploes\UpdateUserRequest;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\ChildLead;
use App\Models\ChildPayment;
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
        $fileName = 'administrator_ish_haqi_' . $data['monch'] . '_' . $data['user_id'] . '.xlsx';
        return Excel::download(new SalaryAdminReportExport($data), $fileName);
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
