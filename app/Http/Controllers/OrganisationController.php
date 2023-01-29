<?php

namespace App\Http\Controllers;

use App\Libraries\Messenger;
use App\Models\Accountlog;
use App\Models\Credit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrganisationController extends Controller
{
    //

    public function showCreateOrganisation()
    {
        return view("organisation.add");
    }


    public function doCreateOrganisation(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required',
        ]);




        User::unguard();
        Wallet::unguard();



        $messenger = new AuthController();
        $unique_id = $messenger->randomId('4','unique_id','users');


      //  dd($unique_id);

        $user = new User();

        if(Auth::user()->level == 1){
            $level = 2;
        }

        if(Auth::user()->level == 2){
            $level = 3;
            $user->sub_unique_id = Auth::user()->unique_id;
        }

        $user->name    = $request->name;
        $user->phone    = $request->phone;
        $user->email        = $request->email;
        $user->username  = $request->username;
        $user->password     = bcrypt($request->password);
        $user->plain     = $request->password;
        $user->level     = $level;
        $user->unique_id    = $unique_id;

        $user->save();


        $wallet = new Wallet();

        $wallet-> balance = 0;
        $wallet-> unique_id = $unique_id;
        $wallet->save();

        User::reguard();
        Wallet::reguard();



            return Redirect::to(route("showOrganisationProfile",['orgid'=>$unique_id]))->with("message","Organisation was successfully Created")->with("type","success");





    }

    public function showOrganisationProfile($orgid)
    {

        $dataArr = array(
            'orgid' => $orgid,
        );




        $builder =  User::where("users.unique_id",$orgid)->leftJoin("wallets","users.unique_id","=","wallets.unique_id");

        $data['account'] = $builder -> first();
        $data['active'] = "organisation";

      //  dd( $data['account']);

        if(Auth::user()->level == 1) {


            $data['access'] =  $builder -> first() ->access;

            $data['cac'] = "";
            $data['cac'] = "";

            return view("organisation.profile", $data);

        }

        if(Auth::user()->level == 2) {

            //dd('s');

            $check = User::where("unique_id",$orgid)->first();




            if($check -> sub_unique_id != Auth::user()->unique_id){

                return \redirect()->to("/dashboard")->with("message","Not Authorized")->with("type","danger");

            }


                $data['balance'] = $builder -> first() ->balance;

                $data['main'] = Wallet::where("unique_id",Auth::user()->unique_id) -> first() -> balance;

                return view("organisation.profile", $data);



        }

    }




    public function doCreditWallet(Request $request)
    {
        $request -> validate([

            'orgid' => 'required',
            'amount' => 'required',
            'password' => 'required',
        ]);





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







                    return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Credited with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                        ->with("type", "success");


                } else {


                    return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "No Wallet found for this organisation")
                        ->with("type", "danger");


                }

            }

        }



        if(Auth::user()->level == 2) {





            $check = User::where("unique_id",$request->orgid)->first();


            if($check -> sub_unique_id != Auth::user()->unique_id){

                return \redirect()->to("/dashboard")->with("message","Not Authorized")->with("type","danger");

            }



           // dd("I got here");





            //   dd("I got here");exit;
            //fetch user credit
            $balance = Wallet::where("unique_id",Auth::user()->unique_id)->first();



            if(!empty($balance)){

                $User_balance = $balance->balance;

            }else{

                $User_balance = 0;

            }




            //check if user has enough credit
            if($request->amount > $User_balance) {

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "You do not have sufficient credit to perform this action")
                    ->with("type", "danger");


            }



            $sub_user = User::where("unique_id",$request->orgid)->first();

           // dd($sub_user);

            //check is organisation exists
            if(empty($sub_user)){


                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Organisation not found")
                    ->with("type", "danger");



            }


            //check of the sub organisation belongs to you
            if($sub_user->sub_unique_id != Auth::user()->unique_id) {

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "You are not authorised to perform this action")
                    ->with("type", "danger");


            }




            $wallet = Wallet::where("unique_id",$request->orgid)->first();




            //check if user has a wallet first
            if(!empty($wallet)){


                //update wallet balance
                $prev = $wallet-> balance;
                $prev_parent = $balance -> balance;


                $wallet-> balance = $wallet->balance + $request->amount;
                $wallet->save();




                //update the parent wallet
                $balance -> balance = $balance -> balance - $request->amount;
                $balance  -> save();




                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Credit Wallet";
                $log->trigger =  $request->orgid;
                $log->message = "Added: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ";
                $log->status = 1;
                $log ->save();


                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Disburse Credit";
                $log->trigger =  $request->orgid;
                $log->message = "Disbursed: {$request->amount}, Previous: {$prev_parent}, New: {$balance-> balance}  Organisation: {$request->orgid} ";
                $log->status = 1;
                $log ->save();





                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Credited with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                    ->with("type", "success");







            }else{


                Wallet::unguard();

                $wallet = new Wallet();

                $wallet-> balance = 0;
                $wallet-> unique_id = $request->orgid;
                $wallet->save();


                Wallet::reguard();

                //update wallet balance
                $prev = $wallet-> balance;
                $prev_parent = $balance -> balance;


                $wallet-> balance = $wallet->balance + $request->amount;
                $wallet->save();


                //update the parent wallet
                $balance -> balance = $balance -> balance - $request->amount;
                $balance  -> save();



                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Credit Wallet";
                $log->trigger =  $request->orgid;
                $log->message = "Added: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ";
                $log->status = 1;
                $log ->save();


                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Disburse Credit";
                $log->trigger =  $request->orgid;
                $log->message = "Disbursed: {$request->amount}, Previous: {$prev_parent}, New: {$balance-> balance}  Organisation: {$request->orgid} ";
                $log->status = 1;
                $log ->save();





                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Credited with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                    ->with("type", "success");



            }


        }



    }





    public function doWithdrawWallet(Request $request, Messenger $messenger)
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

                        $messenger->log(Auth::user()->unique_id,"Withdraw Wallet", $request->orgid,"Insufficient balance",0);

                        return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Wallet does not have enough balance to perform this withdrawal.")->with("type", 'danger');


                    }else{


                        $wallet-> balance = $wallet->balance - $request->amount;
                        $wallet->save();

                        $messenger->log(Auth::user()->unique_id,"Withdraw Wallet", $request->orgid,"Withdraw: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ",1);

                        return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Credited with: " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                            ->with("type", "success");

                    }


                }else{

                    $messenger->log(Auth::user()->unique_id,"Withdraw Wallet", $request->orgid,"No wallet found for this Organisation",0);

                    return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "No wallet found for this Organisation")->with("type", 'danger');

                }


            }else{

                $messenger->log(Auth::user()->unique_id,"Withdraw Wallet", $request->orgid,"Access Denied",
                    0);

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Access Denied")->with("type", 'danger');


            }
        }




        if(Auth::user()->level == 2) {





            //   dd("I got here");exit;
            //fetch user credit
            $balance = Wallet::where("unique_id",$request->orgid)->first();


            $check = User::where("unique_id",$request ->orgid)->first();

            if(Auth::user() -> unique_id != $check->sub_unique_id){

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Not enough privilege")
                    ->with("type", "danger");
            }





            if(!empty($balance)){

                $User_balance = $balance->balance;

            }else{

                $User_balance = 0;

            }




            //check if user has enough credit
            if($request->amount > $User_balance) {

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Amount exceeds user's balance")
                    ->with("type", "danger");


            }



            $sub_user = User::where("unique_id",$request->orgid)->first();

            // dd($sub_user);

            //check is organisation exists
            if(empty($sub_user)){


                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "Organisation not found")
                    ->with("type", "danger");



            }


            //check of the sub organisation belongs to you
            if($sub_user->sub_unique_id != Auth::user()->unique_id) {

                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "You are not authorised to perform this action")
                    ->with("type", "danger");


            }




            $wallet = Wallet::where("unique_id",$request->orgid)->first();
            $owner = Wallet::where("unique_id",Auth::user()->unique_id)->first();




            //check if user has a wallet first
            if(!empty($wallet)){


                //update wallet balance
                $prev = $wallet -> balance;
                $owner_balance = $owner -> balance;


                $wallet-> balance = $wallet->balance - $request->amount;
                $wallet->save();


                //credit owner
                $owner -> balance = $owner_balance +  $request->amount;
                $owner -> save();




                $messenger->log($request->orgid,"Withdraw Wallet", $request->orgid,"Withdraw: {$request->amount}, Previous: {$prev}, New: {$wallet-> balance} ",1);


                $messenger->log(Auth::user()->unique_id,"Withdraw Credit", $request->orgid,"Withdrew: {$request->amount}, Previous: {$prev}, New: {$balance-> balance}  Organisation: {$request->orgid} ",1);




                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "sub-Wallet Successfully Withdrew : " . $request->post("amount") . "credit(s) <-> Main wallet balance: " . $wallet->balance)
                    ->with("type", "success");







            }else{





                return Redirect::to(route("showOrganisationProfile", ['orgid' => $request->post("orgid")]))->with("message", "An error occured")
                    ->with("type", "danger");



            }


        }



    }


    public function doEditOrganisation(Request $request, Messenger $messenger)
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

            return Redirect::to(route("showOrganisationProfile",['orgid'=>$request->post("orgid")]))->with("message","Profile Update was successful")->with("type","success");



    }


    public function showAllOrganisations(Messenger $messenger)
    {
        if(Auth::user()->level == 1){
            $level = 2;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->orderBy("name","asc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");
        }

        if(Auth::user()->level == 2){

            $level = 3;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->where("sub_unique_id",Auth::user()->unique_id)->orderBy("id","desc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");
        }



        $data['organisations'] = $builder -> paginate(20);
        $data['page'] = "All Organisations";
        $data['active'] = "vieworganisation";

        return view("organisation.active",$data);
    }


    public function showActiveOrganisations(Messenger $messenger)
    {

      //  dd("dd");

        if(Auth::user()->level == 1){
            $level = 2;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->where("active",1)->orderBy("name","asc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");
        }

        if(Auth::user()->level == 2){

            $level = 3;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->where("active",1)->where("sub_unique_id",Auth::user()->unique_id)->orderBy("name","asc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");
        }



        $data['organisations'] = $builder -> paginate(20);
        $data['page'] = "Active Organisations";


        return view("organisation.active",$data);
    }


    public function showInactiveOrganisations(Messenger $messenger)
    {


        if(Auth::user()->level == 1){

            $level = 2;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->where("active",0)->orderBy("name","asc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");

        }

        if(Auth::user()->level == 2){

            $level = 3;

            $builder = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")->where("level",$level)->where("active",0)->where("sub_unique_id",Auth::user()->unique_id)->orderBy("name","asc")->leftJoin("wallets","users.unique_id","=","wallets.unique_id");

        }


        $data['organisations'] = $builder -> paginate(20);
        $data['page'] = "Inactive Organisations";

        return view("organisation.active",$data);
    }



    public function ActivateOrganisation(Messenger $messenger,$orgid)
    {

        if(Auth::user()->level == 1){

            $user = User::where("unique_id",$orgid)->first();
        }

        if(Auth::user()->level == 2) {

            $check = User::where("unique_id",$orgid)->first();


            if($check -> sub_unique_id != Auth::user()->unique_id){

                return \redirect()->to("/dashboard")->with("message","Not Authorized")->with("type","danger");

            }

            $user = User::where("unique_id", $orgid)->where("sub_unique_id", Auth::user()->unique_id)->first();

        }


        if(!empty($user)) {

            $user->active = $user->active == 1 ? 0 : 1;
            $user->save();

            $messenger->log(Auth::user()->unique_id, "Updated Organisation Status", $user->unique_id, "Organisation status updated", 0);

            return Redirect::to(route("showOrganisationProfile",['orgid'=>$orgid]))->with("message","Status update was successful")->with("type","success");

        }else {

            return Redirect::to(route("showOrganisationProfile",['orgid'=>$orgid]))->with("message", "Organisation not found")
                ->with("type", 'danger');

        }

    }

    public function updateAccess(Request $request,Messenger $messenger)
    {

        $request->validate([
            'orgid' => "required",
           // 'access' => "required",
        ]);


        $dataArr = array(
            'orgid' => $request->orgid,
            'access' => $request->access,
        );


        $user = User::where("unique_id",$request->orgid)->first();

        if(!empty($_POST['access'])){
            $user -> access  = implode('-',$request->access);
        }else{
            $user -> access  = "";
        }

        $user -> save();


            return Redirect::to(route("showOrganisationProfile",['orgid'=>$request->orgid]))->with("message","Access Successfully Updated")->with("type","success");


    }



    public function updateAccessLevel(Request $request,Messenger $messenger)
    {

        $request->validate([
            'orgid' => "required",
            'access_level' => "required",
        ]);


        if ($request->access_level > 4) {

            return Redirect::to(route("showOrganisationProfile",['orgid'=>$request->orgid]))->with("message", "Sorry No access Level greater than 4")
                ->with("type", 'danger');



        }


        $user = User::where("unique_id",$request->orgid)->first();



            $user -> access_level  = $request->access_level;

            $user -> save();

        return Redirect::to(route("showOrganisationProfile",['orgid'=>$request->orgid]))->with("message","Access Level Successfully Updated")->with("type","success");



    }


    public function showDocumentation()
    {
        return view("organisation.documentation");
    }


    public function deleteOrganisation($id)
    {
        //$user = User::where("unique_id",$id)-> first();

        DB::table('users')
            ->where('users.unique_id', $id)
            ->delete();


        DB::table('wallets')
            ->where('wallets.unique_id', $id)
            ->delete();

        $users_org =  User::where("sub_unique_id",$id)->update(['active'=> 0]);


        return Redirect::route("showAllOrganisations")-> with("message","Account Deleted successfully") -> with("type","success");
    }


}
