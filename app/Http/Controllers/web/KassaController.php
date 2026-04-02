<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Kassa;
use Illuminate\Http\Request;

class KassaController extends Controller{
    
    public function index(){
        $kassa = Kassa::getInstance();
        return view('kassa.index',compact('kassa'));
    }

}
