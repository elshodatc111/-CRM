<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Child\AddChildToGroupRequest;
use App\Http\Requests\Child\UpdateChildRequest;
use App\Models\Child;
use App\Models\ChildPayment;
use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupDavomad;
use App\Models\GroupPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller{

    public function index(Request $request){
        $query = Child::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('guvohnoma', 'LIKE', "%{$search}%");
            });
        }
        $childs = $query->orderBy('created_at', 'desc')->paginate(10);
        if ($request->ajax()) {
            return view('child._table', compact('childs'))->render();
        }
        return view('child.index', compact('childs'));
    }
    
    public function show($id){
        $child = Child::findOrFail($id);
        $groups = Group::where('status','aktiv')->get();
        $childgouphistory = GroupChild::where('child_id',$id)->orderby('is_active', 'desc')->get();
        $payments = ChildPayment::where('child_id',$id)->orderby('created_at','desc')->get();
        $davomad = GroupDavomad::where('child_id',$id)->orderby('date','desc')->get();
        $groupPay = GroupPayment::where('child_id',$id)->orderby('created_at','desc')->get();
        return view('child.show', compact('child','groups','childgouphistory','payments','davomad','groupPay'));
    }

    public function update(UpdateChildRequest $request){
        $validated = $request->validated();
        $child = Child::findOrFail($validated['child_id']);
        $child->update($validated);
        return back()->with('success', __('emploes_show.bola_malumotlari_yangilandi'));
    }

    public function add_group(AddChildToGroupRequest $request){
         DB::transaction(function () use ($request) {
            GroupChild::create([
                'child_id' => $request->child_id,
                'group_id' => $request->group_id,
                'start_id' => Auth::id(),
                'start_data' => now(),
                'is_active'=>true,
            ]);
            $child = Child::findOrFail($request['child_id']);
            $child->is_active = true;
            $child->save();
         });
        return back()->with('success', __('emploes_show.bola_guruhga_movaqiyatli_qoshildi'));
    }
}
