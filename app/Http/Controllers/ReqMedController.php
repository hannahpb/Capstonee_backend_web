<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReqMed;

class ReqMedController extends Controller
{
    public function index()
    {
        $reqmed = ReqMed::all();
        return response()->json([
            'status'=> 200,
            'reqmed'=>$reqmed,
        ]);
    }

    public function store(Request $request)
    {
        $reqmed = new ReqMed();
        $reqmed->fname = $request->fname;
        $reqmed->lname = $request->lname;
        $reqmed->verdict = $request->verdict;
        $reqmed->doctor = $request->doctor;
        $reqmed->uid = $request->uid;

        $reqmed->save();

        $data = [
            'status' => true,
            'reqmed' => $reqmed
        ];

        return $reqmed->toJson();
        //return response()->json($data, 201);
    }
    public function edit($id)
    {
        $reqmed = ReqMed::find($id);
        if($reqmed)
        {
            return response()->json([
                'status'=> 200,
                'reqmed' => $reqmed,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Medical Request Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $reqmed = ReqMed::find($id);
        if($reqmed)
        {
            $reqmed->fname = $request->fname;
            $reqmed->lname = $request->lname;
            $reqmed->verdict = $request->verdict;
            $reqmed->doctor = $request->doctor;
            $reqmed->uid = $request->uid;

            $reqmed->update();

            return response()->json([
                'status'=> 200,
                'message'=>'Verdict Upheld Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Request ID Found',
            ]);
        }
    }

    public function find($key)
    {
        $reqmed = Reqmed::where('fname', 'Like', "%$key%")->get();

        return response()->json([
            'status'=> 200,
            'reqmed'=>$reqmed,
        ]);
    }

    public function destroy($id)
    {
        $reqmed = ReqMed::find($id);
        if($reqmed)
        {
            $reqmed->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'MedCert Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No MedCert ID Found',
            ]);
        }
    }
}
