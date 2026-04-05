<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Child;
use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupDavomad;
use Carbon\Carbon;

class ViewChildDavomadServiceProvider extends ServiceProvider{

    public function boot(): void{
        View::composer('*', function ($view) {
            $today = date("Y-m-d");
            $groups = Group::where('status', 'aktiv')->get();
            $group = [];
            $all_users = 0;
            $davomad_group = 0;
            $all_keldi = 0;
            $all_kechikdi = 0;
            $all_kelmadi = 0;
            foreach ($groups as $key => $gr) {
                $group[$key]['group_id'] = $gr->id;
                $group[$key]['group_name'] = $gr->group_name;
                $group[$key]['is_done'] = false;
                $davomads = GroupDavomad::where('group_id',$gr->id)->where('date',$today)->get();
                if(count($davomads)>0){
                    $group[$key]['is_done'] = true;
                    $davomad_group = $davomad_group + 1;
                }
                $groupUser = GroupChild::where('group_id',$gr->id)->where('is_active',true)->get();
                $group[$key]['users_count'] = count($groupUser);
                $all_users = $all_users + count($groupUser);
                $keldi = 0;
                $kelmadi = 0;
                $kechikdi = 0;
                foreach ($davomads as $dav) {
                    if($dav->status=='keldi'){
                        $keldi = $keldi + 1;
                        $all_keldi = $all_keldi + 1;
                    }elseif($dav->status == 'kelmadi'){
                        $kelmadi = $kelmadi + 1;
                        $all_kechikdi = $all_kechikdi + 1;
                    }elseif($dav->status == 'kechikdi'){
                        $kechikdi = $kechikdi + 1;
                        $all_kelmadi = $all_kelmadi + 1;
                    }
                }

                $count = count($groupUser);

                $group[$key]['users_count'] = count($groupUser);
                $foiz_keldi = $count==0?0:round(($keldi/$count)*100,1);
                $group[$key]['keldi'] = $keldi." (".$foiz_keldi."%)";
                $foiz_kelmadi = $count==0?0:round(($kelmadi/$count)*100,1);
                $group[$key]['kelmadi'] = $kelmadi." (".$foiz_kelmadi."%)";
                $foiz_kechikdi = $count==0?0:round(($kechikdi/$count)*100,1);
                $group[$key]['kechikdi'] = $kechikdi." (".$foiz_kechikdi."%)";
            }
            if($all_users==0){
                $res_keldi = "-";
                $res_kelmadi = "-";
                $res_kechikdi = "-";
            }else{
                $mmkeldi = round(($all_keldi/$all_users)*100,1);
                $res_keldi = $all_keldi." (" .$mmkeldi." %)";
                $mmkelmadi = round(($all_kelmadi/$all_users)*100,1);
                $res_kelmadi = $all_kelmadi." (" .$mmkelmadi." %)";
                $mmkechikdi = round(($all_kechikdi/$all_users)*100,1);
                $res_kechikdi = $all_kechikdi." (" .$mmkechikdi." %)";
            }
            $res = [];
            $res['groups'] = $group;
            $res['chart'] = [
                "group_count" => count($groups),
                "group_davomad" => $davomad_group." / ".count($groups),
                "total_users" => $all_users,
                "total_keldi" => $res_keldi,
                "total_kelmadi" => $res_kelmadi,
                "total_kechikdi" => $res_kechikdi
            ];
            $view->with('res', $res);
        });
    }

}
