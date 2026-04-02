<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\StoreEmployeeFromLeadRequest;
use App\Http\Requests\Emploes\StoreEmployeeLeadRequest;
use App\Models\Note;
use App\Models\User;
use App\Models\UserLead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class EmploesLeadController extends Controller{

    public function index(){
        $userLead = UserLead::orderBy('created_at', 'desc')->get();
        return view('emploesLead.index', compact('userLead'));
    }

    public function show($id){
        $userLead = UserLead::findOrFail($id);
        $employeLead = Note::where('type', 'employeLead')->where('user_id', $id)->with('admin')->get();
        return view('emploesLead.show', compact('userLead', 'employeLead'));
    }

    public function store(StoreEmployeeLeadRequest $request){
        $request = $request->validated();
        $request['passport_seria'] = 'AA1234567';
        $request['status'] = 'new';
        $request['admin_id'] = Auth::id();
        $request['phone'] = "+998".str_replace(' ', '', $request['phone']);
        $request['phone_two'] = "+998".str_replace(' ', '', $request['phone_two']);
        UserLead::create($request);
        return redirect()->back()->with('success', __('emploes_lead_page.success'));
    }

    public function success(StoreEmployeeFromLeadRequest $request){
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'      => $request['name'],
                'phone'     => $request->phone, 
                'phone_two' => $request->phone_two,
                'addres'   => $request['address'],
                'salary'    => $request->salary, 
                'tkun'      => $request['tkun'],
                'pasport'   => $request->pasport, 
                'role'      => $request['role'],
                'about'     => $request['about'],
                'status'    => 'true',
                'password'  => Hash::make('password'),
            ]);
            $userLead = UserLead::findOrFail($request['user_lead_id']);
            $userLead->update(['status'  => 'success','user_id' => $user->id]);
            Note::create([
                'type' => 'employeLead',
                'user_id' => $request['user_lead_id'],
                'admin_id' => Auth::id(),
                'content' => $request['about'],
            ]);   
        });        
        return redirect()->back()->with('success', __('emploes_lead_page.success'));
    }

    public function note(Request $request){
        $validated = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:user_leads,id',
            'type'    => 'required|string',
        ]);
        Note::create([
            'type'     => $validated['type'],
            'user_id'  => $validated['user_id'],
            'admin_id' => Auth::id(),
            'content'  => $validated['content'],
        ]);
        $userLead = UserLead::findOrFail($validated['user_id']);
        if($userLead->status == 'new'){
            $userLead->update(['status'  => 'pending']);
        }
        return redirect()->back()->with('success', __('emploes_lead_page_show.note_success'));
    }

    public function cancel(Request $request){
        $validated = $request->validate([
            'content' => 'required|string',
            'user_lead_id' => 'required|exists:user_leads,id',
        ]);
        Note::create([
            'type'     => 'employeLead',
            'user_id'  => $validated['user_lead_id'],
            'admin_id' => Auth::id(),
            'content'  => $validated['content'],
        ]);
        $userLead = UserLead::findOrFail($validated['user_lead_id']); 
        $userLead->update(['status'  => 'cancel']);
        return redirect()->back()->with('success', __('emploes_lead_page_show.cancel_success'));
    }   
}
