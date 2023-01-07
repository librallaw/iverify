<?php

namespace App\Http\Controllers;

use App\Models\Accountlog;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function showDashboard()
    {
        $data['balance'] = Wallet::where("unique_id", Auth::user()->unique_id)->first()->balance;
        $builder  = Accountlog::where("unique_id",Auth::user()->unique_id)->where("action","Verify");
        $data['total'] = $builder->count();
        $data['success'] = $builder->where("status",1)->count();
        $data['failed'] = $builder->where("status",0)->count();

        $data['recents'] = Accountlog::where("unique_id",Auth::user()->unique_id)->where("action","Verify")->orderBy("id","desc")->take(10)->get();

        $data['active'] = 'dashboard';


        return view("dashboard",$data);
    }
}
