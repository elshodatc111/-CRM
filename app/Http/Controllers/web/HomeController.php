<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\StoreEmploesDavomadrRequest;
use App\Http\Requests\Group\StoreGroupHisobotRequest;
use App\Models\Group;
use App\Models\GroupHisobot;
use App\Models\User;
use App\Models\UserDavomad;
use App\Models\UserShikoyat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller{
    
    public function index(){
        $users = User::where('status','true')->where('role','!=','superadmin')->where('role','!=','direktor')->get();
        $userDavomad = [];
        $today = date('Y-m-d');
        foreach ($users as $key => $value) {
            $userDavomad[$key]['id'] = $value->id;
            $userDavomad[$key]['name'] = $value->name;
            $userDav = UserDavomad::where('user_id',$value->id)->where('data',$today)->first();
            if($userDav){
                $userDavomad[$key]['status'] = $userDav->status;
                $userDavomad[$key]['description'] = $userDav->description;
            }else{
                $userDavomad[$key]['status'] = 'kelmadi';
                $userDavomad[$key]['description'] = '';
            }
        }
        $groups = Group::where('status','aktiv')->get();
        $hisobot = [];
        foreach ($groups as $key => $value) {
            $hisobot[$key]['group_id'] = $value->id;
            $hisobot[$key]['group_name'] = $value->group_name;
            $group_hisobot = GroupHisobot::where('group_id',$value->id)->where('data',$today)->where('type','hisobot')->first();
            $hisobot_status = 'olinmadi';
            if($group_hisobot){
                if($group_hisobot->is_active){
                    $hisobot_status = 'topshirdi';
                }else{
                    $hisobot_status = 'topshirmadi';
                }
            }
            $hisobot[$key]['hisobot_status'] = $hisobot_status;
            $hisobot[$key]['description'] = $value->title;
        }
        return view('index',compact('userDavomad','hisobot','groups','users'));
    }

    public function hodimDavomad(StoreEmploesDavomadrRequest $request){
        $data = $request->validated();
        $today = Carbon::now()->format('Y-m-d');
        foreach ($data['attendance'] as $item) {
            UserDavomad::updateOrCreate(
                ['user_id' => $item['user_id'],'data'    => $today,],
                ['status'      => $item['status'],'description' => $item['description'] ?? null,'admin_id'    => Auth::id(),'is_active'   => true,]
            );
        }
        return redirect()->back()->with('success', __('home.hodim_davomad_save'));
    }

    public function groupHisobot(StoreGroupHisobotRequest $request){
        $validated = $request->validated();
        $today = Carbon::now()->toDateString();
        foreach ($validated['reports'] as $report) {
            GroupHisobot::updateOrCreate(
                [
                    'group_id' => $report['group_id'],
                    'data'     => $today,
                    'type'     => 'hisobot',
                ],
                [
                    'title'     => $report['title'] ?? 'Kunlik hisobot',
                    'is_active' => isset($report['is_active']) ? (bool)$report['is_active'] : false,
                    'admin_id'  => Auth::id(),
                ]
            );
        }
        return redirect()->back()->with('success', __('home.kunlik_hisobot_saqlandi'));
    }

    public function groupTadbirlar(Request $request){
        GroupHisobot::create([
            'group_id' => $request->group_id,
            'title' => $request->title,
            'type' => 'tadbir',
            'data' => date("Y-m-d"),
            'is_active' => true,
            'admin_id' => Auth::id(),
        ]);
        return redirect()->back()->with('success', __('home.bayram_haqida_save'));
    }

    public function groupShikoyat(Request $request){
        UserShikoyat::create([
            'user_id' => $request->user_id,
            'desctiption' => $request->desctiption,
            'admin_id' => Auth::id(),
        ]);
        return redirect()->back()->with('success', __('home.shikoyat_save_form'));
    }

}
