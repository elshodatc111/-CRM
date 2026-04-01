<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller{
    
    public function index(){
        $group = Group::where('status','aktiv')->get();
        return view('group.index',compact('group'));
    }

    public function show($id){
        return view('group.show');
    }

    public function store(StoreGroupRequest $request){
        Group::create([
            'group_name' => $request['group_name'],
            'group_price' => $request['group_price'],
            'about' => $request['about'],
            'status' => $request['status'],
            'created_by' => Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Guruh muvaffaqiyatli ochildi!');
    }

}
