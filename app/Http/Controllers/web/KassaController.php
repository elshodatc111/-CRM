<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kassa\KassaCostRequest;
use App\Http\Requests\Kassa\KassahOutRequest;
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
        return back()->with('success', "Kassadan chiqim muvaffaqiyatli bajarildi! Tasdiqlash kutilmoqda.");
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
        return back()->with('success', "Kassadan xarajat muvaffaqiyatli bajarildi! Tasdiqlash kutilmoqda.");
    }

    public function successKassa(Request $request){

    }

    public function cancelKassa(Request $request){
        
    }

}
