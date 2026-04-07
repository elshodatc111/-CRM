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
        $group_id = null;
        foreach ($groupUsers as $key => $value) {
            if($value->is_active){
                $group_id = $value->group_id;
            }
        }
        return view('emploes.show', compact('userT','userDavomad','shikoyat','groupUsers','balans','payments','oxirgiOltiOy','salary','group_id'));
    }

    public function calcEmploesAndExport(Request $request){
        $user = User::find($request['user_id']);
        $monch = $request['monch'];
        if($request->role=='admin'){
            return view('emploes.ish_haqi.administrator',compact('user','monch'));
        }elseif($request->role=='oshpaz'){
            return view('emploes.ish_haqi.oshpaz',compact('user','monch'));
        }elseif($request->role=='tarbiyachi'){
            return view('emploes.ish_haqi.tarbiyachi',compact('user','monch'));
        }elseif($request->role=='yordamchi'){
            return view('emploes.ish_haqi.yordamchi',compact('user','monch'));
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
