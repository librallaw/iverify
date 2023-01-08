<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //




    public function register(Request $request,Messenger $messenger )
    {

        $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $dataArr = array(
            'name' => $request->post("name"),
            'email' => $request->post("email"),
            'password' => $request->post("password"),
            'username' => $request->post("username"),
            'phone' => $request->post("phone"),

        );

        dd("pro");


        $response = $messenger->postApi($dataArr,env("API_PLANET").'/organisation/create');

        if($response->status){

            return Redirect::to("/")->with("message","Your registration was successful")->with("type","success");

            exit;

        }else {

            return Redirect::to("/")->with("errormsg", $response->errors)->with("type", 'danger');

        }
    }





    public function login(Request $request)  {
        $request -> validate([
            'username'     => 'required',
            'password'  => 'required'
        ]);


       // dd("I got here");


        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'unique_id';




        if(Auth::attempt([$fieldType => request('username'), 'password' => request('password')])){

            $user = $request->user();


            if(Auth::user()->active == 1){




                if(Auth::user()->level == 1){

                    $userdata['namespace'] = env("API_PLANET");
                }


                if(Auth::user()->level == 2 || Auth::user()->level == 3){

                    $userdata['namespace'] = env("API_SHAPE");
                }




                return Redirect::to('/dashboard');


            }else{

                return Redirect()->to('/login')->with('type', 'danger')->with('message','Account not active, please contact the Administrators');

            }




        }else{
            return Redirect()->to("login")->with('type', 'danger')->with('message','Please check credentials and try again');


        }


    }



    public function doRegister(Request $request)  {


        $request -> validate([
            'name'     => 'required',
            'email'  => 'required',
            'username'  => 'required',
            'phone'  => 'required',
            'confirm_password'  => 'required',
            'password'  => 'required|same:confirm_password'
        ]);



        $unique_id = $this->randomId('4','unique_id','users');

        $user = new User();
        $user->name    = $request->name;
        $user->email        = $request->email;
        $user->username  = $unique_id;
        $user->phone  = $request -> phone;
        $user->password     = bcrypt($request->password);
        $user->plain     = $request->password;
        $user->level     = 2;
        $user->unique_id    = $unique_id;

        $user->save();


        $wallet = new Wallet();

        $wallet-> balance = 0;
        $wallet-> unique_id = $unique_id;
        $wallet->save();

        User::reguard();
        Wallet::reguard();


        return Redirect::to("/login")->with("type","success")->with("message","Your registration was successful, contact the admin for activation");




    }

    public function random_num($size) {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $alpha_key . $key;
    }



    public function randomId($num,$column,$table){

        $id = $this->random_num($num);

        $validator = \Validator::make(["$column"=>$id],['id'=>"unique:$table,reference"]);

        if($validator->fails()){
            return $this->randomId($num);
        }

        return $id;
    }





    public function showRegister()
    {

        return view("auth.register");
    }

    public function changePassword()
    {

        $data['active'] = 'settings';
        return view("auth.change_pass",$data);
    }

    public function doChangePassword(Request $request)
    {

        $request -> validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);


        $dataArr = array(
            'old_password' => $request->post("old_password"),
            'new_password' => $request->post("new_password"),

        );



        if (!(Hash::check($request->old_password, Auth::user()->password))) {

            return Redirect::back()->with("message", "Current password does not match")->with("type", 'danger');


        }

        if(strcmp($request->old_password, $request->new_password) == 0){

            return Redirect::back()->with("message", "New Password cannot be same as your current password")->with("type", 'danger');


        }


        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->plain = $request->new_password;

        $user->save();

        //$request->user()->token()->revoke();



        return Redirect::back()->with("message","Account has been changed successfully updated, please login to continue")->with("type","success");



    }


    public function updateProfile( Request $request)
    {
        $request ->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);


        $user =  Auth::user();

        $user -> name =  $request -> name;
        $user -> email =  $request -> email;
        $user -> phone =  $request -> phone;

        $user -> save();

        return \redirect() -> back() -> with("message","Profile Updated successfully") -> with("type","success");

    }

    public function verify()
    {

        return view("auth.everify");
    }

    public function showLogin()
    {

        return view("auth.login");
    }


    public function doLogout()
    {
        Session::flush();
        return Redirect::to("/login");
    }




}

