<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function student()
    {
        $student = Student::paginate(10);
        return view("student.index", compact("student"));
    }

    public function create()
    {
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
    
        $sections = ['A', 'B', 'C', 'D'];
        return view("student.create",compact('classes', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'student_id' => 'required|unique:students,student_id',
            'admission_no' => 'required|unique:students,admission_no',
            'name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'section' => 'required|string|max:100',
            'class' => 'required|string|max:100',
            'admission_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        // Insert student data
        Student::create([
            // 'student_id' => $request->student_id,
            'admission_no' => $request->admission_no,
            'name' => $request->name,
            'mother_name' => $request->mother_name,
            'dob' => $request->dob,
            'section' => $request->section,
            'class' => $request->class,
            'admission_year' => $request->admission_year,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Student Result Added Successfully!');
        //return redirect()->route('student')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
    
        $sections = ['A', 'B', 'C', 'D'];

        return view('student.edit', compact('student','classes','sections'));
    }

    public function update(Request $request, $student_id)
    {
        $request->validate([
            // 'student_id' => 'required|unique:students,student_id,' . $student_id . ',student_id',
            'admission_no' => 'required|unique:students,admission_no,' . $student_id . ',student_id',
            'name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'section' => 'required|string|max:100',
            'admission_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        // Find student using student_id and update
        $student = Student::where('student_id', $student_id)->firstOrFail();
        $student->update($request->all());

        return redirect()->route('student')->with('success', 'Student details updated successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('student.show', compact('student'));
    }

    public function destroy($id)
    {
        $user = Student::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Student record Deleted Successfully!');
    }

    public function fetchStudents(Request $request)
    {
        $students = Student::where('class', $request->class)
            ->where('section', $request->section)
            ->select('student_id', 'name')
            ->orderBy('student_id', 'asc')
            ->get();

        return response()->json($students);
    }

}
