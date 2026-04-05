<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\EmployeeStoreRequest;
use App\Http\Requests\Emploes\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmploesController extends Controller{

    public function index(){
        $emploes = User::where('role','!=','superadmin')->get();
        return view('emploes.index', compact('emploes'));
    }

    public function show($id){
        $userT = User::findOrFail($id);
        return view('emploes.show', compact('userT'));
    }

    public function store(EmployeeStoreRequest $request){
        $validated = $request->validated(); 
        $validated['password'] = Hash::make(Str::slug($request->phone));
        $validated['status'] = 'true';
        $validated['addres'] = $request->address;
        User::create($validated);
        return redirect()->back()->with('success', __('emploes_page.success_message'));
    }

    public function update(UpdateUserRequest $request){
        $validated = $request->validated();
        $user = User::findOrFail($request->user_id);
        $user->update($validated);
        return redirect()->back()->with('success', __('emploes_page.emploes_update'));
    }

}
