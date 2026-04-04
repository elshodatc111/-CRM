<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moliya\BalanceExpenseRequest;
use App\Http\Requests\Moliya\IncomeRequest;
use App\Http\Requests\Moliya\ReturnToKassaRequest;
use App\Http\Requests\Moliya\SubsidyRequest;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\Kassa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BalansController extends Controller{

    public function index(){
        $balans = Balans::getInstance();
        $history = BalansHistory::where('created_at', '>=', now()->subDays(45))->orderBy('id', 'desc')->get();
        return view('balans.index',compact('balans','history'));
    }

    public function subsedyaToBalans(SubsidyRequest $request){
        DB::transaction(function () use ($request) {
            $balans = Balans::first();
            $balans->increment('sub', $request['amount']);  
            BalansHistory::create([
                'type' => 'subToBalans',
                'status' => 'success',
                'amount' => $request->amount,
                'amount_type' => 'sub',
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
        });
        return back()->with('success', __('moliya.sub_add_plus'));
    }

    public function balansToKassa(ReturnToKassaRequest $request){
        DB::transaction(function () use ($request) {
            $balans = Balans::first();
            $kassa = Kassa::first();
            $type = $request->amount_type;
            if($type=='cash'){
                $balans->decrement('cash', $request['amount']);  
                $kassa->increment('cash', $request['amount']);  
            }elseif($type=='card'){
                $balans->decrement('card', $request['amount']);  
                $kassa->increment('card', $request['amount']);  
            }elseif($type=='bank'){
                $balans->decrement('bank', $request['amount']);  
                $kassa->increment('bank', $request['amount']);  
            }
            BalansHistory::create([
                'type' => 'balansToKassa',
                'status' => 'success',
                'amount' => $request->amount,
                'amount_type' => $type,
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
        });
        return back()->with('success', __('moliya.balansToKassaSuccess'));
    }

    public function daromad(IncomeRequest $request){
        DB::transaction(function () use ($request) {
            $balans = Balans::first();
            $type = $request->amount_type;
            if($type=='cash'){
                $balans->decrement('cash', $request['amount']); 
            }elseif($type=='card'){
                $balans->decrement('card', $request['amount']); 
            }elseif($type=='bank'){
                $balans->decrement('bank', $request['amount']); 
            }elseif($type=='sub'){
                $balans->decrement('sub', $request['amount']); 
            }
            BalansHistory::create([
                'type' => 'balansOut',
                'status' => 'success',
                'amount' => $request->amount,
                'amount_type' => $type,
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
        });
        return back()->with('success', __('moliya.balans_out_success'));
    }
    
    public function xarajat(BalanceExpenseRequest $request){
        DB::transaction(function () use ($request) {
            $balans = Balans::first();
            $type = $request->amount_type;
            if($type=='cash'){
                $balans->decrement('cash', $request['amount']); 
            }elseif($type=='card'){
                $balans->decrement('card', $request['amount']); 
            }elseif($type=='bank'){
                $balans->decrement('bank', $request['amount']); 
            }elseif($type=='sub'){
                $balans->decrement('sub', $request['amount']); 
            }
            BalansHistory::create([
                'type' => 'balansCost',
                'status' => 'success',
                'amount' => $request->amount,
                'amount_type' => $type,
                'description' => $request->description,
                'admin_id' => Auth::id(),
            ]);
        });
        return back()->with('success', __('moliya.balans_cost_out_succerss'));
    }

}
