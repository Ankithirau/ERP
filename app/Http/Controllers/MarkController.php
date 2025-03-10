<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marks;
use App\Models\Student;

class MarkController extends Controller
{

    public function index(){
         $marks = Marks::join('students', 'marks.student_id', '=', 'students.student_id')
        ->select('marks.*', 'students.name as student_name')
        ->paginate(10);



       return view("mark.index", compact('marks'));
    }

    public function coscholastic(){
       return view("mark.coscholastic");
    }

    public function create(){
        $students = Student::all();
        return view("mark.create",compact("students"));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            //'student' => 'required|string',
            'academic_year' => 'required|string',
            'rollno' => 'required|string',
            'class' => 'required|string',
            'section' => 'required|string',
            'term' => 'required|string',
            'marks' => 'required|array',
            'subject' => 'required|string',
        ]);

        //$studentid = $request->student;
        $academic_year = $request->academic_year;
        $rollno = $request->rollno;
        $class = $request->class;
        $stsectionudentid = $request->section;
        $subject = $request->subject;
        $term = $request->term;
        $Key = array_keys($request->input('marks'));








        return response()->json(['message' => 'Marks stored successfully'], 200);
    }

    public function studentajax(Request $request)
        {
          $student = Student::where(['class'=>$request->className,'section'=>$request->section,'admission_year'=>$request->academic_year])->get();
          return response()->json($student);


    }

}
