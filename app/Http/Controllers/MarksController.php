<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marks;
use App\Models\Student;

class MarksController extends Controller
{

    public function index()
    {
        $marks = Marks::join('students', 'marks.student_id', '=', 'students.student_id')
            ->select('marks.*', 'students.name as student_name')
            ->paginate(10);

        return view("marks.index", compact('marks'));
    }

    public function coscholastic()
    {
        return view("marks.coscholastic");
    }

    public function create()
    {
        $students = Student::all();
        return view("marks.create", compact("students"));
    }

    public function Sstore(Request $request)
    {

        dd($request->all());
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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'academic_year' => 'required|string|max:9',
            'class' => 'required|string|max:50',
            'term' => 'required|in:term1,term2',
            'subject' => 'required|string|max:50',
            'marks' => 'required|array',
            'marks.*.rollno' => 'required|integer|min:1|max:99999', // Ensure roll number exists
            'marks.*.*' => 'nullable|numeric|min:1|max:99999',
        ]);

        try {

            $term = $validatedData['term'];
            $subject = $validatedData['subject'];

            $subjectMappings = [
                'English' => '1',
                'Hindi' => '2',
                'Marathi/Sanskrit' => '3',
                'Mathematics' => '4',
                'Computers' => '5'
            ];

            if (!isset($subjectMappings[$subject])) {
                return redirect()->back()->with('error', 'Invalid subject selected.');
            }
    
            $subjectNumber = $subjectMappings[$subject];
            $subjectColumnPrefix = "{$term}_subject_{$subjectNumber}";
            $subjectRowPrefix = "{$term}_{$subject}";
    
            $fields = [
                $subjectRowPrefix => "{$subjectColumnPrefix}",
                "{$subjectRowPrefix}_ct" => "{$subjectColumnPrefix}_ct",
                "{$subjectRowPrefix}_pt_calc" => "{$subjectColumnPrefix}_pt_calc",
                "{$subjectRowPrefix}_periodic_test" => "{$subjectColumnPrefix}_periodic_test",
                "{$subjectRowPrefix}_subject_enrichment" => "{$subjectColumnPrefix}_subject_enrichment",
                "{$subjectRowPrefix}_multiple_assessment" => "{$subjectColumnPrefix}_multiple_assessment",
                "{$subjectRowPrefix}_portfolio" => "{$subjectColumnPrefix}_portfolio",
                // "{$subjectRowPrefix}_total" => "{$subjectColumnPrefix}_total",
            ];

            foreach ($request->marks as $student_id => $markValues) {

                $mark = Marks::firstOrNew(['student_id' => $student_id]);

                $mark->student_id = $student_id;
                $mark->academic_year = $validatedData['academic_year'];
                $mark->rollno = $markValues['rollno'] ?? '';
                $mark->class = $validatedData['class'];

                foreach ($fields as $key => $column) {
                    $mark->$column = $markValues[$key] ?? 5.00;
                }

                $mark->save();
            }

            return redirect()->back()->with('success', 'Marks stored successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

}
