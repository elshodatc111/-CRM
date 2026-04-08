<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BalansHistoryExport;
use App\Exports\KassaHistoryExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller{

    public function index(){
        return view('report.index');
    }

    public function report(Request $request){
        $time = date("Y-m-d-H-i");
        $type = $request->type;
        if($type == "balans_histories"){
            return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "kassa_histories"){
            return Excel::download(new KassaHistoryExport, "kassa-history-".$time.".xlsx");
        }elseif($type == "children"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "child_leads"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "child_payments"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "group_users"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "group_children"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "group_payments"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "group_hisobots"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "group_davomads"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "users"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "user_davomads"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "user_leads"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "user_payments"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }elseif($type == "user_shikoyats"){
            // return Excel::download(new BalansHistoryExport, "balans-history-".$time.".xlsx");
        }else{
            return redirect()->back()->with('success', 'not fount error 404');
        }
        dd($type);
    }

}
