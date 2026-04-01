<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\StoreEmployeeLeadRequest;
use App\Models\User;
use App\Models\UserLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploesLeadController extends Controller{
    public function index(){
        $userLead = UserLead::orderBy('created_at', 'desc')->get();
        return view('emploesLead.index', compact('userLead'));
    }
    public function show($id){
        return view('emploesLead.show', compact('id'));
    }

    public function store(StoreEmployeeLeadRequest $request){
        $request = $request->validated();
        $request['passport_seria'] = 'AA1234567';
        $request['status'] = 'new';
        $request['admin_id'] = Auth::id();
        $request['phone'] = "+998".str_replace(' ', '', $request['phone']);
        $request['phone_two'] = "+998".str_replace(' ', '', $request['phone_two']);
        UserLead::create($request);
        return redirect()->back()->with('success', __('empoles_lead_page.success'));
    }
}
