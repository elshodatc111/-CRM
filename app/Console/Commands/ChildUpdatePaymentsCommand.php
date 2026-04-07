<?php

namespace App\Console\Commands;

use App\Models\Child;
use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChildUpdatePaymentsCommand extends Command{

    protected $signature = 'child_payment:update';

    protected $description = 'Har 5 minutda tolovlarni va balansni tekshiradi';

    public function checkChilds(){
        $currentYear = date('Y');
        $currentMonth = date('m');
        $childs = Child::where('is_active', true)->where(function ($query) use ($currentYear, $currentMonth) {
            $query->whereMonth('month_pay', '!=', $currentMonth)->orWhereYear('month_pay', '!=', $currentYear)->orWhereNull('month_pay');
        })->get();
        $res = [];
        foreach ($childs as $key => $value) {
            $child_id = $value->id;
            $GroupChild = GroupChild::where('child_id', $child_id)->where('is_active', true)->first();
            if ($GroupChild) {
                $group = Group::find($GroupChild->group_id);
                if ($group) {
                    $res[] = [
                        'child_id' => $child_id,
                        'group_id' => $GroupChild->group_id,
                        'payment'  => $group->group_price
                    ];
                }
            }
        }
        return $res;
    }

    public function hisoblash($array){
        if($array){
            foreach ($array as $value) {
                $child = Child::find($value['child_id']);
                $start_balans = $child->balans;
                $payment = $value['payment'];
                $end_balans = $start_balans - $payment;
                GroupPayment::create([
                    'child_id' => $value['child_id'],
                    'group_id' => $value['group_id'],
                    'month_pay' => date('Y-m'),
                    'desctiption' => date("Y-M")." oy uchun to'lov yichib olindi",
                    'balans_start' => $start_balans,
                    'payment' => $payment,
                    'balans_end' => $end_balans,
                ]);
                $child->balans = $end_balans;
                $child->month_pay = date('Y-m');
                $child->save();
            }
        }
    }

    public function handle(){
        Log::info('To\'lovlarni yangilash boshlandi...'.now());
        $array = $this->checkChilds();
        Log::info('Foydalanuvchilar: '.count($array));
        if(count($array)>0){
            $this->hisoblash($array);
        }
    }
}
