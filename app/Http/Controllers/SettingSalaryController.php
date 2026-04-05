<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingSalaryController extends Controller{
    public function salary(){
        return view('setting.salary');
    }
}
