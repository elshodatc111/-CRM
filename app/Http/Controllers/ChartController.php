<?php

namespace App\Http\Controllers;

use App\Models\ChildLead;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller{
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
        //dd($sexMonch);
        return view('chart.lead',compact('hafta','oylik','yillik','sexMonch'));
    }

    public function child(){
        return view('chart.child');
    }

    public function payment(){
        return view('chart.payment');
    }

    public function moliya(){
        return view('chart.moliya');
    }
    
}
