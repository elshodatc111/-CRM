<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller{
    
    public function index(){
        $groups = Group::where('status','aktiv')->get();
        $group = [];
        foreach ($groups as $key => $value) {
            $group[$key]['id'] = $value->id;
            $group[$key]['group_name'] = mb_strtoupper($value->group_name);
            $group[$key]['group_price'] = $value->group_price;
            $group[$key]['childs'] = count(GroupChild::where('group_id',$value->id)->where('is_active',true)->get());
            $group[$key]['users'] = count(GroupUser::where('group_id',$value->id)->where('is_active',true)->get());
        }
        return view('group.index',compact('group'));
    }

    public function show($id){
        $group = Group::findOrFail($id);
        $tarbiyachilar = GroupUser::where('group_id',$id)->get();
        $users = User::whereIn('role',['tarbiyachi', 'yordamchi'])->where('status',true)->get();
        $newUser = [];
        foreach ($users as $key => $value) {
            $check = GroupUser::where('user_id',$value->id)->where('is_active',true)->first();
            if(!$check){
                $newUser[$key]['user_id'] = $value->id;
                $newUser[$key]['name'] = $value->name;
                $newUser[$key]['role'] = $value->role;
            }
        }
        $child = GroupChild::where('group_id',$id)->orderby('is_active','desc')->get();
        return view('group.show',compact('group','tarbiyachilar','newUser','child'));
    }

    public function store(StoreGroupRequest $request){
        Group::create([
            'group_name' => $request['group_name'],
            'group_price' => $request['group_price'],
            'about' => $request['about'],
            'status' => $request['status'],
            'created_by' => Auth::id(),
        ]);
        return redirect()->back()->with('success', __('groups.new_group_success'));
    }

    public function storeUser(Request $request){
        GroupUser::create([
            'user_id' => $request->user_id,
            'group_id' => $request->group_id,
            'start_id' => Auth::id(),
            'start_data' => now(),
            'is_active' => true,
        ]);
        return redirect()->back()->with('success', __('group_show.new_user'));
    }

    public function deleteUser(Request $request){
        $id = $request->id;
        $group = GroupUser::findOrFail($id);
        $group->end_data = now();
        $group->end_id = Auth::id();
        $group->is_active = false;
        $group->save();
        return redirect()->back()->with('success', __('group_show.del_user'));
    }

    public function updateUpdate(Request $request){
        $group = Group::findOrFail($request->group_id);
        $group->group_name = $request->group_name;
        $group->group_price = $request->group_price;
        $group->save();
        return redirect()->back()->with('success', __('group_show.update_group'));
    }

    public function deleteChild(Request $request){
        DB::transaction(function () use ($request) {
            $GroupChild = GroupChild::findOrFail($request->id);
            $GroupChild->end_data = now();
            $GroupChild->is_active = false;
            $GroupChild->end_id = Auth::id();
            $GroupChild->save();
            $child_id = $GroupChild->child_id;
            $Child = Child::findOrFail($child_id);
            $Child->is_active = false;
            $Child->save();
        });
        return redirect()->back()->with('success', __('group_show.del_child'));
    }

    public function deleteGroup(Request $request){
        DB::transaction(function () use ($request) {
            $groupId = $request->group_id;
            $authId = Auth::id();
            $now = now();
            $group = Group::findOrFail($groupId);
            $group->update(['status' => 'delete']);
            GroupUser::where('group_id', $groupId)->where('is_active', true)->update(['end_id'    => $authId,'end_data'  => $now,'is_active' => false,]);
            $activeChildIds = GroupChild::where('group_id', $groupId)->where('is_active', true)->pluck('child_id');
            if ($activeChildIds->isNotEmpty()) {
                GroupChild::where('group_id', $groupId)->where('is_active', true)->update(['end_id'    => $authId,'end_data'  => $now,'is_active' => false,]);
                Child::whereIn('id', $activeChildIds)->update(['is_active' => false]);
            }
        });
        return redirect()->route('groups_index')->with('success', __('group_show.del_group'));
    }

}
