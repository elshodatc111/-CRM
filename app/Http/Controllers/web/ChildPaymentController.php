<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Child\ChildDiscountRequest;
use App\Http\Requests\Child\ChildPaymentRequest;
use App\Models\Child;
use App\Models\ChildPayment;
use App\Models\Kassa;
use App\Models\KassaHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChildPaymentController extends Controller{

    public function payment(ChildPaymentRequest $request){
        DB::transaction(function () use ($request) {
            $amount_type = $request->amount_type;
            $child = Child::findOrFail($request->child_id);
            $kassa = Kassa::getInstance();
            $childPayment = ChildPayment::create([
                'child_id'=>$request->child_id,
                'type'=>'payment',
                'amount'=>$request->amount,
                'amount_type'=>$request->amount_type,
                'description'=>$request->description,
                'status'=>'pending',
                'admin_id'=>Auth::id(),
            ]);
            if($amount_type=='cash'){
                $child->increment('balans', $request->amount);
                $kassa->increment('cash', $request->amount);
                $childPayment->success;
                KassaHistory::create([
                    'type' => 'payment',
                    'amount' => $request->amount,
                    'amount_type' => 'cash',
                    'status' => 'success',
                    'start_data' => now(),
                    'start_admin' => Auth::id(),
                    'start_comment' => $request->description,
                    'child_payment_id' => $childPayment->id,
                ]);
            }elseif($amount_type=='card'){
                $kassa->increment('pending_card', $request->amount);
                KassaHistory::create([
                    'type' => 'payment',
                    'amount' => $request->amount,
                    'amount_type' => 'card',
                    'status' => 'pending',
                    'start_data' => now(),
                    'start_admin' => Auth::id(),
                    'start_comment' => $request->description,
                    'child_payment_id' => $childPayment->id,
                ]);
            }elseif($amount_type=='bank'){
                $kassa->increment('pending_bank', $request->amount);
                KassaHistory::create([
                    'type' => 'payment',
                    'amount' => $request->amount,
                    'amount_type' => 'bank',
                    'status' => 'pending',
                    'start_data' => now(),
                    'start_admin' => Auth::id(),
                    'start_comment' => $request->description,
                    'child_payment_id' => $childPayment->id,
                ]);
            }
            $childPayment->save();
        });
        return redirect()->back()->with('success',"To'lov qabul qilindi");
    }

    public function descount(ChildDiscountRequest $request){
        DB::transaction(function () use ($request) {
            ChildPayment::create([
                'child_id' => $request->child_id,
                'type' => 'discount',
                'amount' => $request->amount,
                'amount_type' => 'cash',
                'description' => $request->start_comment,
                'status' => 'success',
                'admin_id' => Auth::id(),
            ]);
            $child = Child::findOrFail($request->child_id);
            $child->increment('balans', $request->amount);
        });
        return redirect()->back()->with('success',"Chegirma qabul qilindi");
    }

    public function return(Request $request){
        DB::transaction(function () use ($request) {

        });
        return redirect()->back()->with('success',"To'lov qaytarildi");
    }
}
