<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller{

    public function index(Request $request){
        $query = Child::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('guvohnoma', 'LIKE', "%{$search}%");
            });
        }
        $childs = $query->orderBy('created_at', 'desc')->paginate(10);
        if ($request->ajax()) {
            return view('child._table', compact('childs'))->render();
        }
        return view('child.index', compact('childs'));
    }
    
    public function show($id){
        return view('child.show', compact('id'));
    }
}
