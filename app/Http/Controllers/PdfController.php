<?php

namespace App\Http\Controllers;

use App\Libraries\Messenger;
use App\Models\Accountlog;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spipu\Html2Pdf\Html2Pdf;
use PDF;

class PdfController extends Controller
{
    //

    public function generatePdf()
    {

        $valued = "";
        $x = 0;
        $userdata = json_decode($_POST['data']);

        $valued .= "<div align='center'> <p style='padding:10px, border: 1px solid black'><a href='www.checknin.ng'>www.checknin.ng</a></p></div><br />";

        if(isset($userdata->photo)){
            $valued .= "<p><img class='img' src='data:image/png;base64, $userdata->photo' style='width:100px'/></p>";
        }


        foreach($userdata as $key => $value)
                if($key == "photo" || $key == "signature"){
                    continue;
            } else{

                  //  dd($value);

                    $valued .= "<div style='float:left'> <h4>".strtoupper($key)."</h4><strong>".ucfirst(strtolower($value))."</strong></div><hr />";




            }


        $valued .= "<div style='float:left'> <small>Verified on <a href='www.checknin.ng'>www.checknin.ng</a></small></div>";






        // exit;




        if(isset($userdata->firstname) && isset($userdata->surname)){

            $name = $userdata->firstname."-".$userdata->surname;
        }else{
            $name = "data";
        }




        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML("<html><body>".$valued."</body></html>");
        $html2pdf->output($name.'.pdf','D');
    }


    public function printSlip(Request $request)
    {

        $request->validate([
            'data' => 'required'
        ]);


        $balance =  Wallet::where("unique_id", Auth::user()->unique_id)->first()->balance;


        if($balance > 0){

            $balanceer = Wallet::where("unique_id", Auth::user()->unique_id)->first();

            $balanceer -> balance = $balance -1;

            $balanceer -> save();








            $datar  = json_decode($_POST['data']);


           // dd($datar);

            if(isset($datar->birthdate)){
                if(is_object($datar->birthdate)){
                    $birthdate =   " *** ";
                }
                else{
                    $birthdate = $datar->birthdate;
                }

            } else {

                $birthdate = "****";
            }

            if(isset($datar->firstname)){
                if(is_object($datar->firstname)){
                    $firstname =  " *** ";
                }
                else{
                    $firstname = $datar->firstname;
                }

            } else {

                $firstname = "****";
            }


            if(isset($datar->middlename)){
                if(is_object($datar->middlename)){
                    $middlename =    " *** ";
                }
                else{
                    $middlename = $datar->middlename;
                }

            } else {

                $middlename = "****";
            }

            if(isset($datar->surname)){
                if(is_object($datar->surname)){
                    $surname =  " *** ";
                }
                else{
                    $surname = $datar->surname;
                }

            } else {


                $surname = "****";
            }
            
            $photo = ($datar->photo ? $datar->photo: "");
            $gender = ($datar->gender ? strtoupper($datar->gender): "");
            $nin = ($datar->nin ? $datar->nin: "");



            $log = new Accountlog();
            $log->unique_id = Auth::user()->unique_id;
            $log->action = "SLIP";
            $log->trigger = Auth::user()->unique_id;
            $log->message = "$surname.<-->.$firstname, Previous: {$balance}, New: {$balanceer-> balance} ";
            $log->status = 1;
            $log ->save();


            $data['data']=  json_decode($_POST['data']);


            $pdf = PDF::loadView('verification.slip', $data);

            return $pdf->download($surname."-".$firstname.'.pdf');

        }else{

            return Redirect::route("loadVerification")->with("message","Insufficient credit")->with("type","danger");
        }








    }



    public function downloadData(Request $request)
    {

        $request->validate([

            'data' => 'required'
        ]);


        $datar  = json_decode($_POST['data']);


        if(isset($datar->birthdate)){
            if(is_object($datar->birthdate)){
                $birthdate =   " *** ";
            }
            else{
                $birthdate = $datar->birthdate;
            }

        } else {

            $birthdate = "****";
        }

        if(isset($datar->firstname)){
            if(is_object($datar->firstname)){
                $firstname =  " *** ";
            }
            else{
                $firstname = $datar->firstname;
            }

        } else {

            $firstname = "****";
        }


        if(isset($datar->middlename)){
            if(is_object($datar->middlename)){
                $middlename =    " *** ";
            }
            else{
                $middlename = $datar->middlename;
            }

        } else {

            $middlename = "****";
        }

        if(isset($datar->surname)){
            if(is_object($datar->surname)){
                $surname =  " *** ";
            }
            else{
                $surname = $datar->surname;
            }

        } else {


            $surname = "****";
        }

        $photo = ($datar->photo ? $datar->photo: "");
        $gender = ($datar->gender ? strtoupper($datar->gender): "");
        $nin = ($datar->nin ? $datar->nin: "");


        $data['data']=  json_decode($_POST['data']);


        $pdf = PDF::loadView('verification.download', $data);

        return $pdf->download($surname."-".$firstname.'.pdf');



    }




    public function printPremiumSlip(Request $request)
    {

        //dd($request);

        $request->validate([
            'data' => 'required'
        ]);


        $balance =  Wallet::where("unique_id", Auth::user()->unique_id)->first()->balance;


        if($balance > 0){

            $balanceer = Wallet::where("unique_id", Auth::user()->unique_id)->first();

            $balanceer -> balance = $balance -1;

            $balanceer -> save();



            $datar  = json_decode($_POST['data']);


            // dd($datar);

            if(isset($datar->birthdate)){
                if(is_object($datar->birthdate)){
                    $birthdate =   " *** ";
                }
                else{
                    $birthdate = $datar->birthdate;
                }

            } else {

                $birthdate = "****";
            }

            if(isset($datar->firstname)){
                if(is_object($datar->firstname)){
                    $firstname =  " *** ";
                }
                else{
                    $firstname = $datar->firstname;
                }

            } else {

                $firstname = "****";
            }


            if(isset($datar->middlename)){
                if(is_object($datar->middlename)){
                    $middlename =    " *** ";
                }
                else{
                    $middlename = $datar->middlename;
                }

            } else {

                $middlename = "****";
            }

            if(isset($datar->surname)){
                if(is_object($datar->surname)){
                    $surname =  " *** ";
                }
                else{
                    $surname = $datar->surname;
                }

            } else {


                $surname = "****";
            }

            $photo = ($datar->photo ? $datar->photo: "");
            $gender = ($datar->gender ? strtoupper($datar->gender): "");
            $nin = ($datar->nin ? $datar->nin: "");



            $log = new Accountlog();
            $log->unique_id = Auth::user()->unique_id;
            $log->action = "PREMIUM SLIP";
            $log->trigger = Auth::user()->unique_id;
            $log->message = "$surname.<-->.$firstname, Previous: {$balance}, New: {$balanceer-> balance} ";
            $log->status = 1;
            $log ->save();


            $data['data']=  json_decode($_POST['data']);


            $pdf = PDF::loadView('verification.premium', $data);

            return $pdf->download($surname."-".$firstname.'.pdf');

        }else{

            return Redirect::route("loadVerification")->with("message","Insufficient credit")->with("type","danger");
        }








    }


    public function printTest()
    {
        $pdf = PDF::loadView('verification.premium_test2');

        return $pdf->inline('test.pdf');
    }


}
