<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildController extends Controller{
    public function index(){
        return view('child.index');
    }
    public function show($id){
        return view('child.show', compact('id'));
    }
}
