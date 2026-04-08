<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BalansHistoryExport;
use App\Exports\ChildExport;
use App\Exports\ChildLeadExport;
use App\Exports\ChildPaymentExport;
use App\Exports\GroupChildExport;
use App\Exports\GroupDavomadExport;
use App\Exports\GroupHisobotExport;
use App\Exports\GroupPaymentExport;
use App\Exports\GroupUserExport;
use App\Exports\KassaHistoryExport;
use App\Exports\UsersExport;
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
            return Excel::download(new ChildExport, "bolalar-".$time.".xlsx");
        }elseif($type == "child_leads"){
            return Excel::download(new ChildLeadExport, "bolalar-lead-".$time.".xlsx");
        }elseif($type == "child_payments"){
            return Excel::download(new ChildPaymentExport, "bola-tulovlari-".$time.".xlsx");
        }elseif($type == "group_users"){
            return Excel::download(new GroupUserExport, "guruh-tarbiyachilari-".$time.".xlsx");
        }elseif($type == "group_children"){
            return Excel::download(new GroupChildExport, "guruh-bolalari-".$time.".xlsx");
        }elseif($type == "group_payments"){
            return Excel::download(new GroupPaymentExport, "guruh-uchun-tulovlar-".$time.".xlsx");
        }elseif($type == "group_hisobots"){
            return Excel::download(new GroupHisobotExport, "hisobot-".$time.".xlsx");
        }elseif($type == "group_davomads"){
            return Excel::download(new GroupDavomadExport, "bolalar-davomadi-".$time.".xlsx");
        }elseif($type == "users"){
            return Excel::download(new UsersExport, "hodimlar-".$time.".xlsx");
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
