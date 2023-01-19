<?php

namespace App\Http\Controllers;

use App\Libraries\Messenger;
use App\Models\Accountlog;
use App\Models\Credit;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class VerificationController extends Controller
{
    //


    public function loadVerification()
    {


        $data['active'] = 'verify';


        $data['access'] = Auth::user()->access != null ? explode("-",Auth::user()->access) : [] ;

        return view("verification.verify",$data);
    }



    public function DoLoadVerification(Request $request)
    {
        $request -> validate([
            'data'     => 'required',
            'searchType' => 'required'
        ]);


        if($request->searchType == "nin"){

            $method = "searchByNIN";
            $resp_message = "searchByNINResponse";
            $field = "nin";
        }
        else if($request->searchType == "phone"){

            $method = "searchByDemoPhone";
            $resp_message = "searchByDemoPhoneResponse";
            $field = "phone";
        }
        else if($request->searchType == "document"){

            $method = "searchByDocumentNumber";
            $resp_message = "searchByDocumentNumberResponse";
            $field = "doc";

        }else{

            return Redirect::back()->with("message","Search type not recognized")->with("type","danger");

        }


        $org_id = (Auth::user()->level == 2 ? Auth::user()->unique_id : Auth::user()->sub_unique_id);

        if(Auth::user()->level == 2 ){
            $access_level = Auth::user()->access_level;
        }

        if(Auth::user()->level == 3){
            $access_level = User::where("unique_id",$org_id)->first()->access_level;
        }

        $walletBalance  = Wallet::where("unique_id",Auth::user()->unique_id)->first();

        if(!empty($walletBalance)){

            if($walletBalance->balance >= 1){


               // $data = $messenger->returnNinData($method,$resp_message,$field,$request->data);


              //  dd($field);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://adx40.isabiam.com/api/triangle/nin/verify',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('data' => $request->data,'searchType' => $field),
                    CURLOPT_HTTPHEADER => array(
                        'SECRET-KEY: librallawkey',
                        'ORG-ID: librallaw',
                        'Accept: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // echo $response;

                // dd($search_result['return']['data']['birthcountry']);

                //dd($response);
                $data =   json_decode($response);





               // dd($data);








                unset($data->data->data->nok_address2);



                if($data->status){

                    $walletBalance->balance = $walletBalance->balance - 1;
                    $walletBalance->save();


                    $log = new Accountlog();
                    $log->unique_id = Auth::user()->unique_id;
                    $log->action = "Verify";
                    $log->trigger =  Auth::user()->unique_id;
                    $log->message = "success <-> $request->searchType <-> $request->data,";
                    $log->status = 1;
                    $log ->save();

                    $datar['active'] = "verify";

                    $datar['userdata'] = $data->data->data;
                    $datar['access'] =  explode('-',Auth::user()->access);

                    return view("verification.data",$datar);


                }else{



                    $zero = 0;
                    if(isset($data->message->$zero)){
                        $message = $data->message->$zero;

                        

                    }else{
                        $message =  $data->message;
                    }



                    $log = new Accountlog();
                    $log->unique_id = Auth::user()->unique_id;
                    $log->action = "Verify";
                    $log->trigger =  Auth::user()->unique_id;
                    $log->message = $message." <-> $request->searchType <-> $request->data,";
                    $log->status = 0;
                    $log ->save();


                    return Redirect::back()->with("message", $message)->with("type",'danger');

                    

                }

            }else{


                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Verify";
                $log->trigger =  Auth::user()->unique_id;
                $log->message = "Insufficient Credit <->  $request->searchType <-> $request->data,";
                $log->status = 0;
                $log ->save();


                return Redirect::back()->with("message", 'Insufficient Credit')->with("type",'danger');



            }
        }else{

            $log = new Accountlog();
            $log->unique_id = Auth::user()->unique_id;
            $log->action = "Verify";
            $log->trigger =  Auth::user()->unique_id;
            $log->message = "No Credit found  <->  $request->searchType <-> $request->data,";
            $log->status = 0;
            $log ->save();



            return Redirect::back()->with("message", 'No credit found')->with("type",'danger');


        }





    }



    public function DoLoadVerificationDemo(Request $request)
    {
        $request -> validate([
            'first_name'     => 'required',
            'last_name'     => 'required',
            'gender'     => 'required',
            'dob'     => 'required',

        ]);




        $org_id = (Auth::user()->level == 2 ? Auth::user()->unique_id : Auth::user()->sub_unique_id);

        if(Auth::user()->level == 2 ){
            $access_level = Auth::user()->access_level;
        }

        if(Auth::user()->level == 3){
            $access_level = User::where("unique_id",$org_id)->first()->access_level;
        }

        $walletBalance  = Wallet::where("unique_id",Auth::user()->unique_id)->first();

        if(!empty($walletBalance)){

            if($walletBalance->balance >= 1){


               // $data = $messenger->returnNinData($method,$resp_message,$field,$request->data);


              //  dd($field);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://adx40.isabiam.com/api/triangle/nin/verify/data',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('firstName' => $request->first_name,'lastName' => $request->last_name,'gender' => $request->gender,'dateOfBirth' => $request->dob),
                    CURLOPT_HTTPHEADER => array(
                        'ORG-ID: librallaw',
                        'SECRET-KEY: librallawkey'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                //dd($response);
                $data =   json_decode($response);





               // dd($data);




                if(isset($data->data->data)){

                    $walletBalance->balance = $walletBalance->balance - 1;
                    $walletBalance->save();
                }



                unset($data->data->data->nok_address2);




                if($data->status){


                    $log = new Accountlog();
                    $log->unique_id = Auth::user()->unique_id;
                    $log->action = "Verify";
                    $log->trigger =  Auth::user()->unique_id;
                    $log->message = "success <->  <-> Demo <->$request->first_name <-> $request->last_name <-> $request->dob <-> $request->gender";
                    $log->status = 1;
                    $log ->save();

                    $datar['active'] = "verify";

                    $datar['userdata'] = $data->data->data;
                    $datar['access'] =  explode('-',Auth::user()->access);

                    return view("verification.data",$datar);


                }else{



                    $zero = 0;
                    if(isset($data->message->$zero)){
                        $message = $data->message->$zero;



                    }else{
                        $message =  $data->message;
                    }



                    $log = new Accountlog();
                    $log->unique_id = Auth::user()->unique_id;
                    $log->action = "Verify";
                    $log->trigger =  Auth::user()->unique_id;
                    $log->message = $message." <-> Demo <->$request->first_name <-> $request->last_name <-> $request->dob <-> $request->gender";
                    $log->status = 0;
                    $log ->save();


                    return Redirect::back()->with("message", $message)->with("type",'danger');



                }

            }else{


                $log = new Accountlog();
                $log->unique_id = Auth::user()->unique_id;
                $log->action = "Verify";
                $log->trigger =  Auth::user()->unique_id;
                $log->message = "Insufficient Credit <->  Demo <->$request->first_name <-> $request->last_name <-> $request->dob <-> $request->gender";
                $log->status = 0;
                $log ->save();


                return Redirect::back()->with("message", 'Insufficient Credit')->with("type",'danger');



            }
        }else{

            $log = new Accountlog();
            $log->unique_id = Auth::user()->unique_id;
            $log->action = "Verify";
            $log->trigger =  Auth::user()->unique_id;
            $log->message = "No Credit found   <-> Demo <->$request->first_name <-> $request->last_name <-> $request->dob <-> $request->gender <->,";
            $log->status = 0;
            $log ->save();



            return Redirect::back()->with("message", 'No credit found')->with("type",'danger');


        }





    }





    public function ssasasss(Request $request,Messenger $messenger)
    {
        $request -> validate([
            'data' => 'required',
            'searchType' => 'required',

        ]);

        $dataArr = array(
            'data' => $request->post("data"),
            'searchType' => $request->post("searchType"),


        );

        $response = $messenger->postApi($dataArr,Session::get('user')[0]["namespace"].'/nin/verify');


        if($response->status){

            $data['userdata'] = $response->data->data;
            $data['access'] =  $level = explode('-',$messenger->getApi(Session::get('user')[0]["namespace"].'/organisation/access/all')
                ->data);

            return view("verification.data",$data);

        }else {

            // dd($response);



            $zero = 0;
            if(isset($data['message']->$zero)){
                $message = $data['message']->$zero;
            }else{
                $message =  $data['message'];
            }

            return Redirect::back()->with("message", $message)->with("type",'danger');

        }

    }






    public function verifyVnin(Request $request)
    {

        $private = '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----';


        $request -> validate([
            'vnin' => 'required'
        ]);

        $headers = [
            'x-api-key'       =>  env("x_api_key"),
            'Accept-Encoding' =>  'gzip,deflate',
            'Content-Type'    =>  'application/x-www-form-urlencoded'
        ];

        $client =  new Client(['headers'=> $headers]);


      //  dd(env('DIRECT_VNIN_URL'));


        $url = env('DIRECT_VNIN_URL');
        $agent_id = env('AGENT_ID');
        $rp_shortcode = env('RP_SHORT_CODE');


        try{

            $response = $client->post($url, [
                'form_params' => [
                    'agentID'=> $agent_id,
                    'vNIN'=> $request->vnin,
                    'RPShortCode'=> $rp_shortcode
                ],
            ]);


            $result = json_decode($response->getBody(true)->getContents());


            if($result->success){

                $ciphertext = $result -> data;

                $private = openssl_get_privatekey($private);

                openssl_private_decrypt(base64_decode($ciphertext), $plaintext, $private, OPENSSL_PKCS1_OAEP_PADDING);

                $obj = json_decode($plaintext);

                $data['obj'] = $obj;
                $data['photo'] = $result ->photograph;


                return view("vnin.data",$data);

            }else{

                return redirect()->back()->with("type","danger")->with("message",$result->message);

            }






//            return json_decode($response->getBody(true)->getContents());

        }catch (ClientException $exception){

            $response = $exception->getResponse()->getBody(true)->getContents();
            $res = json_decode($response);

         //   dd($res);




            return redirect()->back("showVerifyVnin")->with("type","danger")->with("message",$data['message']);
        }






    }







    public function showLog()
    {



        $data['active'] = 'logs';


        $data['recents'] =  Accountlog::where("unique_id",Auth::user()->unique_id)->where("action","Verify")->orderBy("id","desc")->paginate(20);

        return view("verification.logs",$data);

    }


    public function TopLog()
    {

        $data['active'] = 'topup';


        $data['recents'] =  Accountlog::where("trigger",Auth::user()->unique_id)->where("action","Credit Wallet")->orderBy("id","desc")->paginate(20);

        return view("verification.toplogs",$data);

    }


    public function ShowTopLog($id)
    {

        $data['active'] = 'topup';


        $data['recents'] =  Accountlog::where("trigger",$id)->where("action","Credit Wallet")->orderBy("id","desc")->paginate(20);

        return view("verification.toplogs",$data);

    }


    public function sales()
    {


        if(isset($_GET['option'])){

            $option  = $_GET['option'];

            if($option == "yesterday"){
                $data['sales'] = Credit::whereDate('created_at', Carbon::now()->addDay(-1))->get();
                $data['total'] = Credit::whereDate('created_at', Carbon::now()->addDay(-1))->sum('amount');
            }

        }else{

            $data['sales'] = Credit::whereDate('created_at', Carbon::today())->get();
            $data['total'] = Credit::whereDate('created_at', Carbon::today())->sum('amount');
        }


        $data['active'] =  "sales";

        return view("verification.sales",$data);


    }



}
