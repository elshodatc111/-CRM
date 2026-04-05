<?php

namespace App\Http\Controllers;

use App\Models\SettingSalary;
use Illuminate\Http\Request;

class SettingSalaryController extends Controller{
    public function salary(){
        $setting = SettingSalary::get();
        return view('setting.salary',compact('setting'));
    }

    public function tarbiyachi(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Tarbiyachi ish haqi yangilandi");
    }

    public function kichik_tarbiyachi(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Tarbiyachi ish haqi yangilandi");
    }
    
    public function yordamchi(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Yordamchi tarbiyachi ish haqi yangilandi");
    }

    public function kichik_yordamchi(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Yordamchi tarbiyachi ish haqi yangilandi");
    }
    
    public function oshpaz(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Oshpaz ish haqi yangilandi");
    }
    
    public function admin(Request $request){
        dd($request);
        return redirect()->back()->with('success', "Oshpaz ish haqi yangilandi");
    }
}
