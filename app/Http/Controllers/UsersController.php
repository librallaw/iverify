<?php

namespace App\Http\Controllers;

use App\Libraries\Messenger;
use App\Models\Accountlog;
use App\Models\Credit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //

    public function allUsers()
    {

        $data['active'] = "users";
        $data['users'] = User::where("level","!=", 1) -> orderBy("users.id","desc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id")->paginate(20);
        return view("users.all",$data);
    }


    public function showUser($id)
    {
        $data['active'] = "users";
        $data['user'] = User::where("users.unique_id",$id)->leftJoin("wallets","users.unique_id","=","wallets.unique_id")->first();

        $builder = Accountlog::where("unique_id",$id)->where("action","Verify");
        $data['sum'] = $builder->count();


        $data['logs'] = $builder->orderBy("id","desc")->paginate(10);
        $data['name'] = "Verification";
        $data['userd'] = $id;

        return view("users.view",$data);

    }

    public function doCreditWallet(Request $request)
    {
        $request -> validate([

            'orgid' => 'required',
            'amount' => 'required',
            'password' => 'required',
        ]);


       // dd("sss");

        if(Auth::user()->level == 1) {

            if (Hash::check($request->password, Auth::user()->password)) {

                //update wallet balance

                $wallet = Wallet::where("unique_id", $request->orgid)->first();

                //check if user has a wallet first
                if (!empty($wallet)) {

                    //update wallet balance
                    $prev = $wallet->balance;

                    $wallet->balance = $wallet->balance + $request->amount;
                    $wallet->save();

                    $credit = new Credit();
                    $credit->loader_id = Auth::user()->unique_id;
                    $credit->receiver_id = $request->orgid;
                    $credit->amount = $request->amount;
                    $credit->prev = $prev;

                    $credit->save();

                    $log = new Accountlog();
                    $log->unique_id = Auth::user()->unique_id;
                    $log->action = "Credit Wallet";
                    $log->trigger =  $request->orgid;
                    $log->message = "Added: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ";
                    $log->status = 1;
                    $log ->save();



                    return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Credited with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                        ->with("type", "success");


                } else {


                    return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "No Wallet found for this organisation")
                        ->with("type", "danger");


                }

            }

        }

        else {


            //dd($request->post("orgid"));

            return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "Not Enough Privilege")
                ->with("type", "danger");


        }



    }


    public function doWithdrawWallet(Request $request)
    {
        $request -> validate([

            'orgid' => 'required',
            'amount' => 'required',
            'password' => 'required',
        ]);


        $dataArr = array(

            'amount' => $request->post("amount"),
            'password' => $request->post("password"),
            'orgid' => $request->post("orgid"),
        );



        if(Auth::user()->level ==1){

            if(Hash::check($request->password, Auth::user()->password)) {

                //update wallet balance

                $wallet = Wallet::where("unique_id",$request->orgid)->first();

                //check if user has a wallet first
                if(!empty($wallet)){

                    //update wallet balance
                    $prev = $wallet-> balance;


                    //check that wallet has enough balance
                    if($prev < $request->amount){


                        return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "Wallet does not have enough balance to perform this withdrawal.")->with("type", 'danger');


                    }else{


                        $wallet-> balance = $wallet->balance - $request->amount;
                        $wallet->save();

                        $log = new Accountlog();
                        $log->unique_id = Auth::user()->unique_id;
                        $log->action = "Withdraw Wallet";
                        $log->trigger =  $request->orgid;
                        $log->message = "Withdraw: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ";
                        $log->status = 1;
                        $log ->save();


                        return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Withdrawn with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                            ->with("type", "success");

                    }


                }else{


                    return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "No wallet found for this Organisation")->with("type", 'danger');

                }


            }else{


                return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "Access Denied")->with("type", 'danger');


            }
        }

        else {


            //dd($request->post("orgid"));

            return Redirect::to(route("showUser", ['id' => $request->post("orgid")]))->with("message", "Not Enough Privilege")
                ->with("type", "danger");


        }




    }


    public function doEditUser(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'orgid' => 'required',
        ]);


        $user = User::where('unique_id', $request->post("orgid"))->first();

        $user -> name = $request->post("name");
        $user -> email= $request->post("email");
        $user -> phone= $request->post("phone");

        $user -> save();

        return Redirect::to(route("showUser",['id'=>$request->post("orgid")]))->with("message","Profile Update was successful")->with("type","success");



    }


    public function ActivateOrganisation($id)
    {

        

            $user = User::where("unique_id",$id)->first();
        
            


        if(!empty($user)) {

            $user->active = $user->active == 1 ? 0 : 1;
            $user->save();


            return Redirect::to(route("showUser",['id'=>$id]))->with("message","Status update was successful")->with("type","success");

        }else {

            return Redirect::to(route("showUser",['id'=>$id]))->with("message", "Organisation not found")
                ->with("type", 'danger');

        }

    }
}
