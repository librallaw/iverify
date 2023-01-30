<?php

namespace App\Http\Controllers;

use App\Libraries\Messenger;
use App\Models\Accountlog;
use App\Models\Payment;
use App\Models\Wallet;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    //

    public function loadPaymentScreen(Request $request,Messenger $messenger)
    {


        $data['balance'] = Wallet::where("unique_id",Auth::user()->unique_id)->first()->balance;

        //dd( $messenger->getApi("api/user/credits"));

        return view("organisation.fundwallet",$data);
    }

    public function getLink(Request $request)
    {

        $url = "https://api.paystack.co/transaction/initialize";







        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $secret = env("FLUTTER_SECRET");
        $amount = env("PRICE_PER_CREDIT") * $request -> credit;

      //  dd($amount);

        $referc = md5(time().Auth::user()->name);


        $fields = [
            'email' =>$email,
            'amount' => $amount * 100,
        ];

        $fields_string = http_build_query($fields);


        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".env("PAYSTACK_SECRET"),
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $res = curl_exec($ch);
        $result = json_decode($res);







        if($result -> status){


            $newPay = new Payment();

            $newPay -> user_id = Auth::user()->unique_id;

            $newPay -> credits = $request ->credit;
            $newPay -> rate = env("PRICE_PER_CREDIT");
            $newPay -> price = $amount;
            $newPay -> unique_id = $result->data->reference;

            $newPay -> status = "pending" ;


            $newPay -> save();


            $url = $result ->data->authorization_url;
            Return Redirect::away($url);

        }else{

            return Redirect::back() -> with("type","danger") -> with("message","An error occurred, please try again");

        }
    }


    public function verifyTransaction(Request $request)
    {


        //dd($request);

        $reference = $_GET['reference'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".env("PAYSTACK_SECRET"),
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);


        $resp = json_decode($response);

      //  dd($resp);
        $err = curl_error($curl);

        curl_close($curl);

        if($resp->status){




            $payment = Payment::where("unique_id",$reference)->where("completed",0)-> first();

            if(!empty($payment)){

                $payment -> status = "completed";
                $payment -> completed = 1;
                $payment -> save();

                $wallet =  Wallet::where("unique_id",$payment->user_id)->first();

                $prev_balance = $wallet -> balance;

                $wallet -> balance = $wallet -> balance + $payment ->credits;

                $wallet -> save();





                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "TopUp";
                $log->field = "paystack";
                $log->trigger =  $payment->user_id;
                $log->message = "Prev_balance = $prev_balance ---> new Balance = ".$wallet -> balance;
                $log->status = 0;
                $log->save();


                return Redirect::route("loadPaymentScreen")->with("message","Transaction successful")->with("type","success");

            }else{


            }




        }else{

            return Redirect::route("loadPaymentScreen")->with("message","An error err-3456 occurred")->with("type","danger");


        }




        if ($err) {
            return Redirect::route("loadPaymentScreen")->with("message","An error err-3456 occurred")->with("type","danger");
        }

    }
}
