<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller{
    
    public function index(){
        return view('group.index');
    }

    public function show($id){
        return view('group.show');
    }

}
