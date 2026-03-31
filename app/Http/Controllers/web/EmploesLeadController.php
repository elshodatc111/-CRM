<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmploesLeadController extends Controller{
    public function index(){
        return view('emploesLead.index');
    }
    public function show($id){
        return view('emploesLead.show', compact('id'));
    }
}
