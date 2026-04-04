<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Carbon\Carbon;

class TKunController extends Controller{

    public function index(){
        $startOfThisWeek = Carbon::now()->startOfWeek(); 
        $endOfThisWeek = Carbon::now()->endOfWeek();
        $startOfNextWeek = Carbon::now()->addWeek()->startOfWeek();
        $endOfNextWeek = Carbon::now()->addWeek()->endOfWeek();
        $currentWeekBirthdays = Child::whereRaw("DATE_FORMAT(tkun, '%m-%d') BETWEEN ? AND ?", [$startOfThisWeek->format('m-d'),$endOfThisWeek->format('m-d')])->orderByRaw("DATE_FORMAT(tkun, '%m-%d') ASC")->get();
        $nextWeekBirthdays = Child::whereRaw("DATE_FORMAT(tkun, '%m-%d') BETWEEN ? AND ?", [$startOfNextWeek->format('m-d'),$endOfNextWeek->format('m-d')])->orderByRaw("DATE_FORMAT(tkun, '%m-%d') ASC")->get();
        return view('child.tkun',compact('currentWeekBirthdays','nextWeekBirthdays'));
    }

}
