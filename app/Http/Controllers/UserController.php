<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            'status'=> 200,
            'user'=>$user,
        ]);
    }

    function register(Request $req)
    {
        $user = new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->password=Hash::make($req->input('password'));
        $user->verified=$req->input('verified');
        $user->save();
        return $user;
    }

    public function edit($id)
    {
        $user = User::find($id);
        if($user)
        {
            return response()->json([
                'status'=> 200,
                'user' => $user,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->verified = $request->input('verified');
            $user->update();

            return response()->json([
                'status'=> 200,
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

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return ["error"=>"Email or password is not matched"];
        }
        if($user && Hash::check($req->password,$user->password) && !($user->verified == "true")){
            return ["notVerified"=>"User is not yet verified"];
        }
        return $user;
    }
}
