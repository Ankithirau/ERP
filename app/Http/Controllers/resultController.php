<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class resultController extends Controller
{
    public function index()
    {

        $result = Result::join('students', 'results.student_id', '=', 'students.student_id')
            ->select('results.*', 'students.name as student_name')
            ->paginate(10);

        return view("result.index", compact("result"));
    }

    public function create()
    {
        $students = Student::all();
        return view('result.create', compact('students')); // Load the create form view
    }

    public function store(Request $request)
    {
        // Validate Input
        $request->validate([
            'student_id' => 'required|numeric',
            'academic_year' => 'required|string|max:20',
            'term1_total_marks' => 'required|numeric',
            'term1_percentage' => 'required|numeric',
            'term1_grade' => 'required|string|max:5',
            'term2_total_marks' => 'required|numeric',
            'term2_percentage' => 'required|numeric',
            'term2_grade' => 'required|string|max:5',
        ]);

        // Store Data
        Result::create([
            'student_id' => $request->student_id,
            'academic_year' => $request->academic_year,
            'term1_total_marks' => $request->term1_total_marks,
            'term1_percentage' => $request->term1_percentage,
            'term1_grade' => $request->term1_grade,
            'term2_total_marks' => $request->term2_total_marks,
            'term2_percentage' => $request->term2_percentage,
            'term2_grade' => $request->term2_grade,
        ]);

        // Redirect with Success Message
        return redirect()->back()->with('success', 'Student Result Added Successfully!');
    }

    public function edit($id)
    {
        $result = Result::where('result_id', $id)->first();
        $students = Student::all();

        return view('result.edit', compact('result', 'students'));// Load the create form view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|numeric',
            'academic_year' => 'required|string|max:20',
            'term1_total_marks' => 'required|numeric',
            'term1_percentage' => 'required|numeric',
            'term1_grade' => 'required|string|max:5',
            'term2_total_marks' => 'required|numeric',
            'term2_percentage' => 'required|numeric',
            'term2_grade' => 'required|string|max:5',
        ]);

        $result = result::findOrFail($id);
        $result->update([
            'student_id' => $request->student_id,
            'academic_year' => $request->academic_year,
            'term1_total_marks' => $request->term1_total_marks,
            'term1_percentage' => $request->term1_percentage,
            'term1_grade' => $request->term1_grade,
            'term2_total_marks' => $request->term2_total_marks,
            'term2_percentage' => $request->term2_percentage,
            'term2_grade' => $request->term2_grade,
        ]);
        return redirect()->back()->with('success', 'Student Result Updated Successfully!');

    }

    public function show($id)
    {
        $result = Result::where('result_id', $id)->first();
        $students = Student::all();

        return view('result.show', compact('result', 'students'));// Load the create form view
    }


    public function destroy($id)
    {
        $user = Result::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Student Result Deleted Successfully!');
    }

}
