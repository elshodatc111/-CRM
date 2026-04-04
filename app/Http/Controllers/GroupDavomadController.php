<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupChild;
use App\Models\GroupDavomad;
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
                'is_done'      => $attendanceCount > 0,
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
        $childs = GroupChild::where('group_id',$id)->where('is_active','true')->get();
        $child = [];
        foreach ($childs as $key => $value) {
            $child[$key]['child_id'] = $value->child_id;
            $child[$key]['name'] = $value->child->name;
            $dav = GroupDavomad::where('group_id',$id)->where('child_id',$value->child_id)->where('date',date('Y-m-d'))->first();
            $child[$key]['status'] = $dav?$dav->status:'kelmadi';
        }
        $group = Group::find($id);
        return view('group.davomad_show',compact('child','group'));
    }

    public function davomadStore(Request $request){
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'attendance' => 'required|array',
        ]);
        $groupId = $request->group_id;
        $today = now()->format('Y-m-d');
        try {
            foreach ($request->attendance as $childId => $status) {
                GroupDavomad::updateOrCreate(
                    [
                        'group_id' => $groupId,
                        'child_id' => $childId,
                        'date'     => $today,
                    ],
                    [
                        'status'   => $status,
                    ]
                );
            }
            return redirect()->back()->with('success', __('group_davomad.success_davomad'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }

}
