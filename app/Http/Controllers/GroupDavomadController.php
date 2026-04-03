<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupDavomad;
use App\Models\GroupUser;
use Illuminate\Http\Request;

class GroupDavomadController extends Controller{

    public function davomad(){
        $today = date("Y-m-d");
        $groups = Group::where('status', 'aktiv')->with(['children' => function($q) { $q->where('is_active', 'true'); }, 'davomads' => function($q) use ($today) { $q->where('date', $today); } ])->get();
        $res = [];
        $totals = [
            'groups_count' => $groups->count(),
            'groups_with_attendance' => 0,
            'all_users' => 0,
            'all_keldi' => 0,
            'all_kelmadi' => 0,
            'all_kechikdi' => 0,
        ];
        foreach ($groups as $group) {
            $usersCount = $group->children->count();
            $davomads = $group->davomads;
            $attendanceCount = $davomads->count();
            if ($attendanceCount > 0) { $totals['groups_with_attendance']++; }
            $keldi = $davomads->where('status', 'keldi')->count();
            $kelmadi = $davomads->where('status', 'kelmadi')->count();
            $kechikdi = $davomads->where('status', 'kechikdi')->count();
            $totals['all_users'] += $usersCount;
            $totals['all_keldi'] += $keldi;
            $totals['all_kelmadi'] += $kelmadi;
            $totals['all_kechikdi'] += $kechikdi;
            $percent = function($count, $total) {
                if ($total == 0) return "0 (0%)";
                $p = round(($count / $total) * 100);
                return "{$count} ({$p}%)";
            };
            $res['groups'][] = [
                'group_id'     => $group->id,
                'group_name'   => $group->group_name,
                'is_done'      => $attendanceCount > 0, // Davomad qilinganmi?
                'users_count'  => $usersCount,
                'keldi'        => $percent($keldi, $usersCount),
                'kelmadi'      => $percent($kelmadi, $usersCount),
                'kechikdi'     => $percent($kechikdi, $usersCount),
            ];
        }
        $allUsers = $totals['all_users'];
        $res['chart'] = [
            'group_count'    => $totals['groups_count'],
            'group_davomad'  => $totals['groups_with_attendance'] . " / " . $totals['groups_count'],
            'total_users'    => $allUsers,
            'total_keldi'    => $allUsers > 0 ? $totals['all_keldi'] . " / " . round(($totals['all_keldi'] / $allUsers) * 100) . "%" : 0,
            'total_kelmadi'  => $allUsers > 0 ? $totals['all_kelmadi'] . " / " . round(($totals['all_kelmadi'] / $allUsers) * 100) . "%" : 0,
            'total_kechikdi' => $allUsers > 0 ? $totals['all_kechikdi'] . " / " . round(($totals['all_kechikdi'] / $allUsers) * 100) . "%" : 0,
        ];
        return view('group.davomad', compact('res'));
    }

    public function davomadShow($id){
        return view('group.davomad_show');
    }

}
