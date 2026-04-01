<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildLead\StoreChildLeadRequest;
use App\Models\ChildLead;
use App\Models\Note;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChildLeadController extends Controller{

    public function index(Request $request){
        $query = ChildLead::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        $childLead = $query->orderBy('created_at', 'desc')->paginate(10);
        if ($request->ajax()) {
            return view('childLead._table', compact('childLead'))->render();
        }
        return view('childLead.index', compact('childLead'));
    }

    public function show($id){
        $childLead = ChildLead::findOrFail($id);
        $childLeadNote = Note::where('user_id',$id)->where('type','childLead')->get();
        return view('childLead.show', compact('childLead','childLeadNote'));
    }

    public function store(StoreChildLeadRequest $request){
        DB::transaction(function () use ($request) {
            ChildLead::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'phone_two' => $request->phone_two,
                'ota_ona' => $request->ota_ona,
                'address' => $request->address,
                'tkun' => $request->tkun,
                'jinsi' => $request->jinsi,
                'description' => $request->description,
                'created_by' => Auth::id(),
                'status' => 'new'
            ]);            
        });
        return back()->with('success', 'Yangi ariza qo\'shildi');
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
        $userLead = ChildLead::findOrFail($validated['user_id']);
        $userLead->update(['status'  => 'pending']);
        return redirect()->back()->with('success', __('emploes_lead_page_show.note_success'));
    }

    public function cancel(Request $request){
        $validated = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:user_leads,id',
        ]);
        $userLead = ChildLead::findOrFail($validated['user_id']);
        $userLead->update(['status'  => 'cancel']);
        Note::create([
            'type'     => 'childLead',
            'user_id'  => $validated['user_id'],
            'admin_id' => Auth::id(),
            'content'  => $validated['content'],
        ]);
        return redirect()->back()->with('success',"Ariza bekor qilindi.");
    }


}
