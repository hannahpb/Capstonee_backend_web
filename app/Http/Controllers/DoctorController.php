<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json([
            'status'=> 200,
            'doctors'=>$doctors,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'docname'=>'required|max:191',
            'docposition'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $doctors = new Doctor;
            $doctors->docname = $request->input('docname');
            $doctors->docposition = $request->input('docposition');
            $doctors->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Doctor Added Successfully',
            ]);
        }

    }

    public function edit($id)
    {
        $doctor = Doctor::find($id);
        if($doctor)
        {
            return response()->json([
                'status'=> 200,
                'doctor' => $doctor,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Doctor ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'docname'=>'required|max:191',
            'docposition'=>'required',
            
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $doctor = Doctor::find($id);
            if($doctor)
            {

                $doctor->docname = $request->input('docname');
                $doctor->docposition = $request->input('docposition');
                $doctor->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Doctor Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Doctor ID Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if($doctor)
        {
            $doctor->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Doctor Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Doctor ID Found',
            ]);
        }
    }
    public function doctorcount()
    {
        $RC = Doctor::all();
        $RCC = $RC->count();
        return $RCC;
    }
}
