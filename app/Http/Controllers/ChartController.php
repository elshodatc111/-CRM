<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller{
    
    public function lead(){
        return view('chart.lead');
    }

    public function child(){
        return view('chart.child');
    }

    public function payment(){
        return view('chart.payment');
    }

    public function moliya(){
        return view('chart.moliya');
    }
    
}
