<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardQBController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    public function dashboardView(){
          $users = DB::table('users')->get();
        return view('dashboardqb', compact('users'));
    }
}
