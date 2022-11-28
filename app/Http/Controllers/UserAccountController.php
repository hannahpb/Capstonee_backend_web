<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    public function index()
    {
        $useracc = UserAccount::all();
        return response()->json([
            'status'=> 200,
            'useracc'=>$useracc,
        ]);
    }

    function register(Request $req)
    {
        $useracc = new UserAccount;
        $useracc->username=$req->input('username');
        $useracc->fname=$req->input('fname');
        $useracc->lname=$req->input('lname');
        $useracc->email=$req->input('email');
        $useracc->password=Hash::make($req->input('password'));
        $useracc->save();

        $data = [
            'status' => 201,
            'useracc' => $useracc
        ];

        return $useracc->toJson();
    }

    function login(Request $req)
    {
        $useracc = UserAccount::where('email', $req->email)->first();
        if(!$useracc || !Hash::check($req->password, $useracc->password))
        {
            return ["error"=>"Email or password is not matched"];
        } 
        return $useracc;
    }
    public function edit($id)
    {
        $useracc = UserAccount::find($id);
        if($useracc)
        {
            return response()->json([
                'status'=> 200,
                'useracc' => $useracc,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No User ID Found',
            ]);
        }

    }
    public function update(Request $request, $id)
    {
        $useracc = UserAccount::find($id);
        if($useracc)
        {
            $useracc->username = $request->input('username');
            $useracc->email = $request->input('email');
            $useracc->update();

            return response()->json([
                'status'=> 201,
                'message'=>'User Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No User ID Found',
            ]);
        }
    }
    public function updatepw(Request $request, $id) 
    {
        $useracc = UserAccount::find($id);
        if($useracc)
        {
            $useracc->password=Hash::make($request->input('password'));
            $useracc->update();

            return response()->json([
                'status'=> 201,
                'message'=>'Password Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Password ID Found',
            ]);
        }
        
    }
}
