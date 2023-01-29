<?php

namespace App\Libraries;

use App\Loan;
use App\Models\Accountlog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\ClientException;
use Validator;

class Messenger
{
    //


    public function log($unique_id,$action,$trigger,$message,$status)
    {
        $log = new Accountlog();
        $log->unique_id = $unique_id;
        $log->action = $action;
        $log->trigger = $trigger;
        $log->message = $message;
        $log->status = $status;
        $log ->save();
    }

    public function postApi($dataArr,$endpoint)
    {
        //dd(Session::get('user'));

        if (Session::get('user')) {
           $token = Session::get('user')[0]["token"];
        }else{
            $token = "";
        }




        $headers = [
            'Authorization' => $token,
            'Accept-Encoding' => 'gzip,deflate',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $client =  new Client(['headers' => $headers]);

        //dd(env('API_HOST').$endpoint);

        try {
           //   echo "I dgot here";exit;
            $response = $client->post(env('API_HOST').$endpoint, [
                'form_params' => $dataArr,
            ]);


          // dd($token);

           // dd($response->getBody(true)->getContents()); exit;



            return json_decode($response->getBody(true)->getContents());


        }catch (ClientException $exception) {


            $response = $exception->getResponse()->getBody(true)->getContents();

            dd($response);
            $res = json_decode($response);



            if(isset($res->message)){
                if($res->message == "Unauthenticated."){

                   // session_destroy();
                    Session::flush();
                    return Redirect::to("/login")->with("message","You need to login to continue")->with("type","danger");

                }

            }

            dd($res);
            return $res;

            /* return Redirect::route("showAddBank")
                 ->with('message',$res->message)
                 ->with('type','danger');*/
        }
    }


    public function testApi($endpoint)
    {



        $client =  new Client(

        );

        //dd(env('API_HOST').$endpoint);
        try {
            // echo "I dgot here";exit;
            $response = $client->get($endpoint);
            var_dump($response);
            return json_decode($response->getBody(true)->getContents());



        }catch (ClientException $exception) {


            $response = $exception->getResponse()->getBody(true)->getContents();


            $res = json_decode($response);
            if(isset($res->message)){
                if($res->message == "Unauthenticated."){

                    Session::flush();
                    return Redirect::to("/login")->with("message","You need to login to continue")->with("type","danger");

                }

            }


            // dd($res);

            return $res;

        }
    }




    public function getApi($endpoint)
    {

        if (Session::get('user')[0]["token"]) {
            $token = Session::get('user')[0]["token"];
        }else{
            $token = "";
        }

        $headers = [
            'Authorization' => $token,
            'Accept-Encoding' => 'gzip,deflate',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $client =  new Client(
            ['headers' => $headers]
        );

        //dd(env('API_HOST').$endpoint);
        try {
             // echo "I dgot here";exit;
            $response = $client->get(env('API_HOST').$endpoint);
            //dd($response);
            return json_decode($response->getBody(true)->getContents());



        }catch (ClientException $exception) {


            $response = $exception->getResponse()->getBody(true)->getContents();


            $res = json_decode($response);
            if(isset($res->message)){
                if($res->message == "Unauthenticated."){

                    Session::flush();
                    return Redirect::to("/login")->with("message","You need to login to continue")->with("type","danger");

                }

            }


           // dd($res);

            return $res;

        }
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


    public function getEncryptedPassword($plaintext) {

        $hashedPassword = hash('sha256', $plaintext);
        $var = $hashedPassword;
        $stringTb = $this->stringToByte($var);

        $base = new Math_BigInteger(implode('', array_map('chr', $stringTb)), 256);
        //echo($base);

        $base =  new Math_BigInteger($base);

        //echo $base;

        $exp = new Math_BigInteger("113621440243785421499955306133900099987164309503876199371900611085975699194905621710442876441889195302451922443555354266645737454327409509639333989384262385729949578624044207610948821627355876693570108394899808569346703874513552461157771585312437842555207875241788331401870311503661882350734256428011446552231");
        $mod = new Math_BigInteger("99656440840574176563305385521896948249485597887868788305755844436736813735716889384156081404108856785411701458057572807701609821377138238971482595936817351313377639458003034637351529602924774615106031875065736828376549082962569871367654360928995574432638495308492887000005021125506027838956077501182295786099");



        $m = $base->modPow($exp, $mod);

        //echo $m;
        return base64_encode($m);
    }



    public function stringToByte($string) {
        $bytes = array();
        for($i = 0; $i < mb_strlen($string, 'ASCII'); $i++){
            $bytes[] = ord($string[$i]);
        }

        return $bytes;
    }

    public function objectToArray( $data )
    {
        $d = null;
        if ( is_object( $data ) )
            $d = get_object_vars( $data );
        return $d;

    }

    public function returnNimcToken()
    {

        $username = env("NIMC_USERNAME");
        $password = $this->getEncryptedPassword(env("NIMC_PASSWORD"));
        $orgid = env("NIMC_ORGID");

        $url = env("NIMC_URL");


        $client = new \SoapClient($url, ['exceptions' => false, 'trace' => true]);

        //$client->searchByNIN(['MachineAddress' => $mac, 'username' => $username, 'password' => $password , 'orgid' => $orgid, 'nin' => $searchItem]);
        $client->createToken(array('username' => $username, 'password' => $password , 'orgid' => $orgid));

        $response = $client->__getLastResponse();

        $xml =  simplexml_load_string($response);

        $xml->registerXPathNamespace('S', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('ns2', 'http://IdentitySearch.nimc/');

        $authentication = $xml->xpath("/S:Envelope/S:Body/ns2:createTokenResponse/return/loginObject/lMessage/authenticated");

        $token = $xml->xpath("/S:Envelope/S:Body/ns2:createTokenResponse/return/loginString");

        if($authentication[0] == "true"){

            $data = array(
                "status" => true,
                "message" => "success",
                "token" => $token[0]
            );


            return $data;

        }else{

            $data = array(
                "status" => false,
                "message" => "authentication failed",

            );

            return $data;
        }

    }



    public function returnNinData($method,$resp_message,$field,$searchItem)
    {




        $nimdata =  $this->returnNimcToken();

        if($nimdata['status']){


            $token = $nimdata['token'][0];





            $parameter = array('token' => $token, $field => $searchItem);

            $client = new \SoapClient(env("NIMC_URL"), ['exceptions' => false, 'trace' => true]);

            $client->$method($parameter);

            $response = $client->__getLastResponse();



            $xml =  simplexml_load_string($response);

            $xml->registerXPathNamespace('S', 'http://schemas.xmlsoap.org/soap/envelope/');
            $xml->registerXPathNamespace('ns2', 'http://IdentitySearch.nimc/');

            $return_message = $xml->xpath("/S:Envelope/S:Body/ns2:$resp_message/return/returnMessage");



            if($return_message[0] == "success"){

                $data = $xml->xpath("/S:Envelope/S:Body/ns2:$resp_message/return/data");

                $data = array(
                    "status" => true,
                    "message" => "success",
                    "data" => $data[0]
                );

                //echo "I got here eee";exit;

                return $data;

            }else{

                $data = array(
                    "status" => false,
                    "message" => $return_message[0],

                );

                return $data;
            }
        }else{

            $data = array(
                "status" => false,
                "message" => "Secure Auth failed",

            );

            return $data;
        }



    }


    public function validate($request,$array)
    {

        $validator = Validator::make($request, $array);


        # if all went well then...


        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'type' => "danger",
                'message' => 'Some errors occured while processing your request',
                'errors' => $validator->errors()->all(),
            ], 400);
            exit;


        }
    }

    public function return_message($status,$type,$message,$code)
    {
        return response()->json([
            'status' => $status,
            'type' => $type,
            'message' => $message,
        ], $code);
        exit;
    }


    public function disburse($loan_id)
    {

        //$bank = Banks::where("unique_id",Auth::user()->unique_id)->first();


        $loan = Loan::where("unique_id",$loan_id)->first();


        //check if the loan exist
        if(count($loan) < 1){

            return response()->json([
                'status' => false,
                'type' => "danger",
                'message' => 'An error 28291 occurred, please contact support',
            ], 400);
            exit;
        }

        //check if the loan has not already been disbursed
        if($loan -> status == 3){

            // loan has been disbursed
            return response()->json([
                'status' => false,
                'type' => "danger",
                'message' => 'This Loan has already been disbursed, check the bank account that u used while registering on the site',
            ], 400);
            exit;
        }



        dd($loan->owner);
        $useraccount = $loan->useuserr->account;



        $loan -> status = 3;
        $loan -> save();

        return response()->json([
            'status' => false,
            'type' => "danger",
            'message' => 'Loan disbursal successful',
        ], 200);
        exit;



    }







}
