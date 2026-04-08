<?php

namespace App\Http\Controllers;

use App\Models\ChildLead;
use App\Models\ChildPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller{
    # Lead START
    public function leadHafta(){
        $date = now()->subWeek()->format("Y-m-d");
        $child_lead = ChildLead::where('created_at','>=',$date." 00:00:00")->get();
        $pending = 0;
        $cancel = 0;
        $success = 0;
        foreach ($child_lead as $value) {
            if($value->status=='pending' || $value->status=='new'){
                $pending = $pending + 1;
            }elseif($value->status=='success'){
                $success = $success + 1;
            }else{
                $cancel = $cancel + 1;
            }
        }
        return ['lead' => $pending+$cancel+$success,'pending'=>$pending,'cancel'=>$cancel,'success'=>$success];
    }    
    public function leadOylik(){
        $date = date("Y-m");
        $child_lead = ChildLead::where('created_at','>=',$date."-01 00:00:00")->get();
        $pending = 0;
        $cancel = 0;
        $success = 0;
        foreach ($child_lead as $value) {
            if($value->status=='pending' || $value->status=='new'){
                $pending = $pending + 1;
            }elseif($value->status=='success'){
                $success = $success + 1;
            }else{
                $cancel = $cancel + 1;
            }
        }
        return ['lead' => $pending+$cancel+$success,'pending'=>$pending,'cancel'=>$cancel,'success'=>$success];
    } 
    public function leadYillik(){
        $date = date("Y");
        $child_lead = ChildLead::where('created_at','>=',$date."-01-01 00:00:00")->get();
        $pending = 0;
        $cancel = 0;
        $success = 0;
        foreach ($child_lead as $value) {
            if($value->status=='pending' || $value->status=='new'){
                $pending = $pending + 1;
            }elseif($value->status=='success'){
                $success = $success + 1;
            }else{
                $cancel = $cancel + 1;
            }
        }
        return ['lead' => $pending+$cancel+$success,'pending'=>$pending,'cancel'=>$cancel,'success'=>$success];
    } 
    public function leadSexMonch(){
        $months = [];
        $all = [];
        $success = [];
        $cancel = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = [
                'db_format'    => $date->format('Y-m'),
                'chart_format' => $date->format('Y-M'),
                'month_name'   => $date->translatedFormat('F'),
            ];
            $all[] = ChildLead::where('created_at','>=',$date->format('Y-m')."-01 00:00:00")->where('created_at','<=',$date->format('Y-m')."-31 23:59:59")->count();
            $success[] = ChildLead::where('status','success')->where('created_at','>=',$date->format('Y-m')."-01 00:00:00")->where('created_at','<=',$date->format('Y-m')."-31 23:59:59")->count();
            $cancel[] = ChildLead::where('status','cancel')->where('created_at','>=',$date->format('Y-m')."-01 00:00:00")->where('created_at','<=',$date->format('Y-m')."-31 23:59:59")->count();
        }
        return [
            'monchs' => $months,
            'all' => $all,
            'success' => $success,
            'cancel' => $cancel,
        ];
    }
    public function lead(){
        $hafta = $this->leadHafta();
        $oylik = $this->leadOylik();
        $yillik = $this->leadYillik();
        $sexMonch = $this->leadSexMonch();
        return view('chart.lead',compact('hafta','oylik','yillik','sexMonch'));
    } #Lead END
    
    # Payment START
    public function getPaymentTenDays(){
        $days = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $days[] = [
                'db_format'    => $date->format('Y-m-d'),
                'chart_format' => $date->format('M-d'),
            ];
        }
        $pay = [];
        $ret = [];
        $des = [];
        foreach ($days as $key => $value) {
            $ChildPaymart = ChildPayment::where('status', 'success')->whereDate('created_at', $value['db_format'])->get();
            $payment = 0;
            $return = 0;
            $descount = 0;
            foreach ($ChildPaymart as $item) {
                if($item->type=='payment'){
                    $payment = $payment + $item['amount'];
                }elseif($item->type=='return'){
                    $return = $return + $item['amount'];
                }elseif($item->type=='discount'){
                    $descount = $descount + $item['amount'];
                }
            }
            $pay[$key] = $payment;
            $ret[$key] = $return;
            $des[$key] = $descount;
        }
        return [
            'days' => $days,
            'payment' => $pay,
            'return' => $ret,
            'descount' => $des,
        ];
    }
    public function getPaymentTenMonch(){
        $months = [];
        $pay = [];
        $ret = [];
        $des = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = now()->subMonths($i);            
            $months[] = [
                'db_format'    => $date->format('Y-m'),
                'chart_format' => $date->format('Y-M'),
                'month_name'   => $date->translatedFormat('F'),
            ];
            $query = ChildPayment::where('status', 'success')->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month);
            $pay[] = (clone $query)->where('type', 'payment')->sum('amount');
            $ret[] = (clone $query)->where('type', 'return')->sum('amount');
            $des[] = (clone $query)->where('type', 'discount')->sum('amount');
        }
        return [
            'months'   => $months,
            'payment'  => $pay,
            'return'   => $ret,
            'descount' => $des,
        ];
    }
    public function payment(){
        $tenDayData = $this->getPaymentTenDays();
        $tenMonthData = $this->getPaymentTenMonch();
        return view('chart.payment',compact('tenDayData','tenMonthData'));
    }
    # END PAYMENT

    #Start CHILD DAVOMAD
    public function child(){
        return view('chart.child');
    }
    #END CHILD DAVOMAD


    public function moliya(){
        return view('chart.moliya');
    }
    
}
