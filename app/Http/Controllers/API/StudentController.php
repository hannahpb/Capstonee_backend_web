<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'status'=> 200,
            'students'=>$students,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname'=>'required|max:191',
            'lname'=>'required|max:191',
            'bday'=>'required',
            'sex'=>'required',
            'course' => 'required',
            'yrlvl' => 'required',
            'phone'=>'required|max:11|min:11',
            'address'=>'required|max:191',
            'religion'=>'required|max:191',
            'cvs'=>'required|max:191',
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
            $student = new Student;
            $student->fname = $request->input('fname');
            $student->lname = $request->input('lname');
            $student->bday = $request->input('bday');
            $student->sex = $request->input('sex');
            $student->course = $request->input('course');
            $student->yrlvl = $request->input('yrlvl');
            $student->phone = $request->input('phone');
            $student->cbc = $request->file('cbc')->store('cbc');
            $student->uri = $request->file('uri')->store('uri');
            $student->address = $request->input('address');
            $student->religion = $request->input('religion');
            $student->cvs = $request->input('cvs');
            $student->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Student Added Successfully',
            ]);
        }

    }

    public function edit($id)
    {
        $student = Student::find($id);
        if($student)
        {
            return response()->json([
                'status'=> 200,
                'student' => $student,
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
        $validator = Validator::make($request->all(),[
            'fname'=>'required|max:191',
            'lname'=>'required|max:191',
            'bday'=>'required',
            'sex'=>'required',
            'course' => 'required',
            'yrlvl' => 'required',
            'phone'=>'required|max:10|min:10',
            'address'=>'required|max:191',
            'religion'=>'required|max:191',
            'cvs'=>'required|max:191',
            
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
            $student = Student::find($id);
            if($student)
            {

                $student->fname = $request->input('fname');
                $student->lname = $request->input('lname');
                $student->bday = $request->input('bday');
                $student->sex = $request->input('sex');
                $student->course = $request->input('course');
                $student->yrlvl = $request->input('yrlvl');
                $student->phone = $request->input('phone');
                $student->address = $request->input('address');
                $student->religion = $request->input('religion');
                $student->cvs = $request->input('cvs');
                $student->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Student Updated Successfully',
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
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Student Deleted Successfully',
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
    public function search($key)
    {
        return Student::where('id', 'Like', "%$key%")->get();
    }

    public function num()
    {
        $RC = Student::where('religion', 'Like', "RomanCatholic")->get();
        $BA = Student::where('religion', 'Like', "BornAgain")->get();
        $IG = Student::where('religion', 'Like', "Iglesia")->get();
        $PR = Student::where('religion', 'Like', "Prefer not to say")->get();

        $RCC = $RC->count();
        $BAC = $BA->count();
        $IGG = $IG->count();
        $PRR = $PR->count();

        $data = [
            $RCC,
            $BAC,
            $IGG,
            $PRR,
        ];

        return response()->json([
            'status'=> 200,
            'all'=> $data
        ]);
    }
    public function numall()
    {
        $student = Student::all();
        $test = $student->count();

        return response()->json([
            'status'=> 200,
            'all'=> $test
        ]);
    }
    public function female()
    {
        $FE = Student::where('sex', 'Like', "Female")->get();
        $test = $FE->count();

        return response()->json([
            'status'=> 200,
            'all'=> $test
        ]);
    }
    public function male()
    {
        $FE = Student::where('sex', 'Like', "Male")->get();
        $test = $FE->count();

        return response()->json([
            'status'=> 200,
            'all'=> $test
        ]);
    }
    public function RC()
    {
        $RC = Student::where('religion', 'Like', "RomanCatholic")->get();
        $RCC = $RC->count();
        return response()->json([
            'status'=> 200,
            'all'=> $RCC
        ]);
    }
    public function BA()
    {
        $BA = Student::where('religion', 'Like', "BornAgain")->get();
        $BAC = $BA->count();
        return response()->json([
            'status'=> 200,
            'all'=> $BAC
        ]);
    }
    public function IG()
    {
        $IG = Student::where('religion', 'Like', "Iglesia")->get();
        $IGG = $IG->count();
        return response()->json([
            'status'=> 200,
            'all'=> $IGG
        ]);
    }
    public function PRR()
    {
        $PR = Student::where('religion', 'Like', "Prefer not to say")->get();
        $PRR = $PR->count();
        return response()->json([
            'status'=> 200,
            'all'=> $PRR
        ]);
    }
    //Civil Status Chart
    public function cvs()
    {
        $RC = Student::where('cvs', 'Like', "Single")->get();
        $BA = Student::where('cvs', 'Like', "Married")->get();
        $IG = Student::where('cvs', 'Like', "Seperated")->get();
        $PR = Student::where('cvs', 'Like', "Prefer not to say")->get();

        $RCC = $RC->count();
        $BAC = $BA->count();
        $IGG = $IG->count();
        $PRR = $PR->count();

        $data = [
            $RCC,
            $BAC,
            $IGG,
            $PRR,
        ];

        return response()->json([
            'status'=> 200,
            'all'=> $data
        ]);
    }
    public function single()
    {
        $RC = Student::where('cvs', 'Like', "Single")->get();
        $RCC = $RC->count();
        return response()->json([
            'status'=> 200,
            'all'=> $RCC
        ]);
    }
    public function married()
    {
        $BA = Student::where('cvs', 'Like', "Married")->get();
        $BAC = $BA->count();
        return response()->json([
            'status'=> 200,
            'all'=> $BAC
        ]);
    }
    public function sep()
    {
        $IG = Student::where('cvs', 'Like', "Seperated")->get();
        $IGG = $IG->count();
        return response()->json([
            'status'=> 200,
            'all'=> $IGG
        ]);
    }
    public function pref()
    {
        $PR = Student::where('cvs', 'Like', "Prefer not to say")->get();
        $PRR = $PR->count();
        return response()->json([
            'status'=> 200,
            'all'=> $PRR
        ]);
    }
    //Year Level Chart
    public function yrlvl()
    {
        $first = Student::where('yrlvl', 'Like', "1stYear")->get();
        $second = Student::where('yrlvl', 'Like', "2ndYear")->get();
        $third = Student::where('yrlvl', 'Like', "3rdYear")->get();
        $fourth = Student::where('yrlvl', 'Like', "4thYear")->get();
        $fifth = Student::where('yrlvl', 'Like', "5thYear")->get();


        $data = [
            $first->count(),
            $second->count(),
            $third->count(),
            $fourth->count(),
            $fifth->count(),
        ];

        return response()->json([
            'status'=> 200,
            'all'=> $data
        ]);
    }
    public function first()
    {
        $first = Student::where('yrlvl', 'Like', "1stYear")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $first
        ]);
    }
    public function second()
    {
        $second = Student::where('yrlvl', 'Like', "2ndYear")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $second
        ]);
    }
    public function third()
    {
        $third = Student::where('yrlvl', 'Like', "3rdYear")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $third
        ]);
    }
    public function fourth()
    {
        $fourth = Student::where('yrlvl', 'Like', "4thYear")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $fourth
        ]);
    }
    public function fifth()
    {
        $fifth = Student::where('yrlvl', 'Like', "5thYear")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $fifth
        ]);
    }
    //Course Chart
    public function course()
    {
        $one = Student::where('course', 'Like', "Engineering")->get();
        $two = Student::where('course', 'Like', "Maritime")->get();
        $three = Student::where('course', 'Like', "Education")->get();
        $four = Student::where('course', 'Like', "Nursing")->get();
        $five = Student::where('course', 'Like', "Psychology")->get();
        $six = Student::where('course', 'Like', "Architecture")->get();
        $seven = Student::where('course', 'Like', "Accountancy")->get();
        $eight = Student::where('course', 'Like', "Arts and Science")->get();
        $nine = Student::where('course', 'Like', "Criminology")->get();
        $ten = Student::where('course', 'Like', "Computing and Multimedia Studies")->get();
        $eleven = Student::where('course', 'Like', "Hospitality and Tourism Management")->get();


        $data = [
            $one->count(),
            $two->count(),
            $three->count(),
            $four->count(),
            $five->count(),
            $six->count(),
            $seven->count(),
            $eight->count(),
            $nine->count(),
            $ten->count(),
            $eleven->count(),
        ];

        return response()->json([
            'status'=> 200,
            'all'=> $data
        ]);
    }
    public function engineering()
    {
        $one = Student::where('course', 'Like', "Engineering")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function maritime()
    {
        $one = Student::where('course', 'Like', "Maritime")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function education()
    {
        $one = Student::where('course', 'Like', "Education")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function nursing()
    {
        $one = Student::where('course', 'Like', "Nursing")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function psychology()
    {
        $one = Student::where('course', 'Like', "Psychology")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function architecture()
    {
        $one = Student::where('course', 'Like', "Architecture")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function accountancy()
    {
        $one = Student::where('course', 'Like', "Accountancy")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function aas()
    {
        $one = Student::where('course', 'Like', "Arts and Science")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function criminology()
    {
        $one = Student::where('course', 'Like', "Criminology")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function ccms()
    {
        $one = Student::where('course', 'Like', "Computing and Multimedia Studies")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    public function htm()
    {
        $one = Student::where('course', 'Like', "Hospitality and Tourism Management")->get()->count();
        return response()->json([
            'status'=> 200,
            'all'=> $one
        ]);
    }
    //Join
    public function joinsearch($key)
    {
        $users = DB::table('students')
            ->join('guardians', 'students.id', '=', 'guardians.student_id')
            ->where('student_id', 'Like', "%$key%")
            ->get();
        return $users;
    }

    public function join()
    {
        $users = DB::table('students')
            ->join('guardians', 'students.id', '=', 'guardians.student_id')
            ->get();
        return response()->json([
            'status'=> 200,
            'all'=> $users
        ]);
    }
}