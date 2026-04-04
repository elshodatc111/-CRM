<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kassa\KassaCostRequest;
use App\Http\Requests\Kassa\KassahOutRequest;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\ChildPayment;
use App\Models\Kassa;
use App\Models\KassaHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KassaController extends Controller{
    
    public function index(){
        $kassa = Kassa::getInstance();
        $history = KassaHistory::where('status','pending')->get();
        return view('kassa.index',compact('kassa','history'));
    }

    public function kassaToBalans(KassahOutRequest $request){
        DB::transaction(function () use ($request) {
            $kassa = Kassa::first();
            $kassa->decrement('cash', $request['amount']);  
            $kassa->increment('out_cash_pending', $request['amount']);  
            KassaHistory::create([
                'type' => 'out',
                'amount' => $request->amount,
                'amount_type' => 'cash',
                'status' => 'pending',
                'start_data' => now(),
                'start_admin' => Auth::id(),
                'start_comment' => $request->start_comment
            ]);
        });
        return back()->with('success', __('kassa.kassadan_chiqim_success'));
    }

    public function kassaToCost(KassaCostRequest $request){
        DB::transaction(function () use ($request) {
            $kassa = Kassa::first();
            $kassa->decrement('cash', $request['amount']);  
            $kassa->increment('cost_cash_pending', $request['amount']);  
            KassaHistory::create([
                'type' => 'cost',
                'amount' => $request->amount,
                'amount_type' => 'cash',
                'status' => 'pending',
                'start_data' => now(),
                'start_admin' => Auth::id(),
                'start_comment' => $request->start_comment
            ]);
        });
        return back()->with('success', __('kassa.kassadan_xarajad_success'));
    }

    public function cancelKassa(Request $request){
        DB::transaction(function () use ($request) {
            $his_id = $request->kassaHistoryId;
            $history = KassaHistory::find($his_id);
            $type = $history->type;
            $history->status = 'cancel';
            $history->end_data = now();
            $history->end_admin = Auth::id();
            $history->save();
            $kassa = Kassa::first();
            if($type=='cost'){  
                $kassa->increment('cash', $history->amount);  
                $kassa->decrement('cost_cash_pending', $history->amount); 
            }elseif($type=='out'){
                $kassa->increment('cash', $history->amount);  
                $kassa->decrement('out_cash_pending', $history->amount); 
            }elseif($type=='payment'){
                $payment = ChildPayment::find($history->child_payment_id);
                $payment->status = 'cancel';
                $payment->save();
                if($payment->amount_type == 'cash'){
                    $kassa->decrement('cash', $history->amount); 
                }elseif($payment->amount_type == 'card'){
                    $kassa->decrement('pending_card', $history->amount); 
                }elseif($payment->amount_type == 'bank'){
                    $kassa->decrement('pending_bank', $history->amount); 
                }
            }
        });
        return back()->with('success', __('kassa.tranzaksion_cancel'));
    }
    
    public function successKassa(Request $request){
        DB::transaction(function () use ($request) {
            $his_id = $request->kassaHistoryId;
            $history = KassaHistory::find($his_id);
            $type = $history->type;
            $history->status = 'success';
            $history->end_data = now();
            $history->end_admin = Auth::id();
            $history->save();
            $kassa = Kassa::first();
            if($type=='cost'){  
                $kassa->decrement('cost_cash_pending', $history->amount); 
                BalansHistory::create([
                    'type' => 'kassaCost',
                    'status' => 'success',
                    'amount' => $history->amount,
                    'amount_type' => $history->amount_type,
                    'description' => $history->start_comment,
                    'admin_id' => Auth::id()
                ]);
            }elseif($type=='out'){
                $kassa->decrement('out_cash_pending', $history->amount); 
                BalansHistory::create([
                    'type' => 'kassaToBalans',
                    'status' => 'success',
                    'amount' => $history->amount,
                    'amount_type' => $history->amount_type,
                    'description' => $history->start_comment,
                    'admin_id' => Auth::id()
                ]);
                $balans = Balans::first();
                if($history->amount_type == 'cash'){
                    $balans->increment('cash', $history->amount);  
                }elseif($history->amount_type == 'card'){
                    $balans->increment('card', $history->amount);  
                }if($history->amount_type == 'bank'){
                    $balans->increment('bank', $history->amount);  
                }
            }elseif($type=='payment'){
                $payment = ChildPayment::find($history->child_payment_id);
                $payment->status = 'success';
                $payment->save();
                $balans = Balans::first();
                if($payment->amount_type == 'cash'){
                    $kassa->decrement('cash', $history->amount); 
                    $balans->increment('cash', $history->amount);  
                }elseif($payment->amount_type == 'card'){
                    $kassa->decrement('pending_card', $history->amount); 
                    $balans->increment('card', $history->amount);  
                }elseif($payment->amount_type == 'bank'){
                    $kassa->decrement('pending_bank', $history->amount); 
                    $balans->increment('bank', $history->amount);  
                }
                BalansHistory::create([
                    'type' => 'kassaToBalans',
                    'status' => 'success',
                    'amount' => $history->amount,
                    'amount_type' => $history->amount_type,
                    'description' => $history->start_comment,
                    'admin_id' => Auth::id()
                ]);
            }
        });
        return back()->with('success', __('kassa.tranzaksion_success'));
    }



}
