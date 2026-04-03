<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Balans;
use Illuminate\Http\Request;

class BalansController extends Controller{

    public function index(){
        $balans = Balans::getInstance();
        return view('balans.index',compact('balans'));
    }

    

}
