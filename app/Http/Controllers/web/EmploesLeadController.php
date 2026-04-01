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
        return redirect()->back()->with('success', __('empoles_lead_page.success'));
    }

    public function success(StoreEmployeeFromLeadRequest $request){
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $validated['name'],
                'phone'     => $request->phone, 
                'phone_two' => $request->phone_two,
                'addres'   => $validated['address'],
                'salary'    => $request->salary, 
                'tkun'      => $validated['tkun'],
                'pasport'   => $request->pasport, 
                'role'      => $validated['role'],
                'about'     => $validated['about'],
                'status'    => 'true',
                'password'  => Hash::make('password'),
            ]);
            $userLead = UserLead::findOrFail($validated['user_lead_id']);
            $userLead->update(['status'  => 'success','user_id' => $user->id]);
            Note::create([
                'type' => 'employeLead',
                'user_id' => $validated['user_lead_id'],
                'admin_id' => Auth::id(),
                'content' => $validated['about'],
            ]);
            DB::commit();            
            return redirect()->back()->with('success', __('empoles_lead_page.success'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
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
        $userLead->update(['status'  => 'pending']);
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
