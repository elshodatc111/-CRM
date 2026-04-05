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
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'child_pay' => 'required|numeric',
            'hisobot'   => 'required|numeric',
            'shikoyat'  => 'required|numeric',
            'bayramlar' => 'required|numeric',
            'item*'     => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_tarbiyachi'));
    }

    public function kichik_tarbiyachi(Request $request){
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'child_pay' => 'required|numeric',
            'hisobot'   => 'required|numeric',
            'shikoyat'  => 'required|numeric',
            'bayramlar' => 'required|numeric',
            'item*'     => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_tarbiyachi'));
    }
    
    public function yordamchi(Request $request){
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'child_pay' => 'required|numeric',
            'hisobot'   => 'required|numeric',
            'shikoyat'  => 'required|numeric',
            'bayramlar' => 'required|numeric',
            'item*'     => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_yordamchi'));
    }

    public function kichik_yordamchi(Request $request){
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'child_pay' => 'required|numeric',
            'hisobot'   => 'required|numeric',
            'shikoyat'  => 'required|numeric',
            'bayramlar' => 'required|numeric',
            'item*'     => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_yordamchi'));
    }
    
    public function oshpaz(Request $request){
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'child_pay' => 'required|numeric',
            'item*'     => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_oshpaz'));
    }
    
    public function admin(Request $request){
        $validated = $request->validate([
            'id'        => 'required|exists:setting_salaries,id',
            'role'      => 'required|string',
            'new_child' => 'required|numeric',
            'new_lead'   => 'required|numeric', 
        ]);
        $res = SettingSalary::findOrFail($request->id);
        $res->update($request->all());
        return redirect()->back()->with('success', __('setting_payment.update_administrator'));
    }
}
