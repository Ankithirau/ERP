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
        return $request->all();
        $request->validate([
            'student_name' => 'required|string',
            'academic_year' => 'required|string',
            'rollno' => 'required|string',
            'class' => 'required|string',
            'term' => 'required|string',
            'marks' => 'required|array',
        ]);

        foreach ($request->marks as $subject => $markDetails) {
            Marks::create([
                'student_name' => $request->student_name,
                'academic_year' => $request->academic_year,
                'rollno' => $request->rollno,
                'class' => $request->class,
                'term' => $request->term,
                'subject' => $subject,
                'marks' => json_encode($markDetails), // Storing marks as JSON
            ]);
        }

        return response()->json(['message' => 'Marks stored successfully'], 200);
    }

}
