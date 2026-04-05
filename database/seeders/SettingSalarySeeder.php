<?php

namespace Database\Seeders;

use App\Models\SettingSalary;
use Illuminate\Database\Seeder;

class SettingSalarySeeder extends Seeder{

    public function run(): void{
        $roles = [
            'tarbiyachi',
            'kichik_tarbiyachi',
            'yordamchi',
            'kichik_yordamchi',
            'oshpaz'
        ];
        foreach ($roles as $role) {
            if($role=='tarbiyachi'){
                $child_pay = 7333;
            }elseif($role=='kichik_tarbiyachi'){
                $child_pay = 9904;
            }elseif($role=='yordamchi'){
                $child_pay = 3666;
            }elseif($role=='kichik_yordamchi'){
                $child_pay = 4952;
            }else{
                $child_pay = 2095;
            }
            $data = [
                'role'      => $role,
                'child_pay' => $child_pay,
                'hisobot'   => $role=='oshpaz'?0:100000,
                'shikoyat'  => $role=='oshpaz'?0:100000,
                'bayramlar' => $role=='oshpaz'?0:100000,
            ];
            for ($i = 5; $i <= 120; $i += 5) {
                if($role=='tarbiyachi'){
                    if($i<30){
                        $data["item{$i}"] = 100000;
                    }else{
                        $data["item{$i}"] = 150000;
                    }
                }elseif($role=='kichik_tarbiyachi'){
                    if($i<30){
                        $data["item{$i}"] = 160000;
                    }else{
                        $data["item{$i}"] = 240000;
                    }
                }elseif($role=='yordamchi'){
                    if($i<30){
                        $data["item{$i}"] = 50000;
                    }else{
                        $data["item{$i}"] = 75000;
                    }
                }elseif($role=='kichik_yordamchi'){
                    if($i<30){
                        $data["item{$i}"] = 80000;
                    }else{
                        $data["item{$i}"] = 120000;
                    }
                }else{
                    $data["item{$i}"] = 30000;
                }
            }
            SettingSalary::create($data);
        }
    }
}
