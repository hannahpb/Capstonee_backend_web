<?php

namespace App\Http\Controllers;

use App\Models\MedRecs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medrec = MedRecs::all();
        return response()->json([
            'status'=> 200,
            'medrec'=>$medrec,
        ]);
    }

    public function store(Request $request)
    {
        $medrec = new MedRecs;
        $medrec->cbc = $request->input('cbc');
        $medrec->uri = $request->input('uri');
        $medrec->student_id = $request->input('student_id');

        $medrec->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Medical Record Added Successfully',
        ]);
    }

    public function find($key)
    {
        $medrec = MedRecs::where('student_id', 'Like', "%$key%")->get();

        return response()->json([
            'status'=> 200,
            'medrec'=>$medrec,
        ]);
    }
}
