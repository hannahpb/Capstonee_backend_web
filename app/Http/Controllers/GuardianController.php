<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuardianController extends Controller
{
    

    public function index()
    {
        $guardian = Guardian::all();
        return response()->json([
            'status'=> 200,
            'guardian'=>$guardian,
        ]);
    }

    public function store(Request $request)
    {
        $guardian = new Guardian;
        $guardian->name = $request->input('name');
        $guardian->num = $request->input('num');
        $guardian->relts = $request->input('relts');
        $guardian->student_id = $request->input('student_id');

        $guardian->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Guardian Added Successfully',
        ]);
    }

    public function edit($id)
    {
        $guardian = Guardian::find($id);
        if($guardian)
        {
            return response()->json([
                'status'=> 200,
                'guardian' => $guardian,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Guardian ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $guardian = Guardian::find($id);
        if($guardian)
        {
            $guardian->name = $request->input('name');
            $guardian->num = $request->input('num');
            $guardian->relts = $request->input('relts');
            $guardian->update();

            return response()->json([
                'status'=> 200,
                'message'=>'Guardian Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Guardian ID Found',
            ]);
        }
    }

    public function destroy($id)
    {
        $guardian = Guardian::find($id);
        if($guardian)
        {
            $guardian->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Guardian Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Guardian ID Found',
            ]);
        }
    }
    public function search($key)
    {
        return Guardian::where('student_id', 'Like', "%$key%")->get();
    }
}
