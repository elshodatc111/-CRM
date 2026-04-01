<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildLeadController extends Controller
{
    public function index()
    {
        return view('childLead.index');
    }
    public function show($id)
    {
        return view('childLead.show', compact('id'));
    }
}
