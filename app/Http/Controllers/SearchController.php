<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class SearchController extends Controller
{
    //

    public function search(Request $request){
        // Get the search value from the request



        $validator = Validator::make($request->all(), [

            'search'     => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status'=>false,
                'message' => 'Sorry the search field is important',
                'errors' =>$validator->errors()->all() ,
            ], 401);

        }


        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $users = User::select("users.id","name","phone","email","sub_unique_id","access","level","username","active","access_level","email_verified_at","users.unique_id","balance","plain","users.created_at","users.updated_at")
            ->where("level",2)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('username', 'LIKE', "%{$search}%")
            ->orderBy("id","desc")
            ->leftJoin("wallets","users.unique_id","=","wallets.unique_id")
            ->get();

        // Return the search view with the resluts compacted
        return response()->json([
            'status'        => true,
            'message'       => 'success',
            'data'          => $users,

        ], 201);
    }

}
