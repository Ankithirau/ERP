<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marks;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{

    public function index(Request $request)
    {
        $students = Student::all();
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
    
        $query = Marks::join('students', 'marks.student_id', '=', 'students.student_id')
            ->select('marks.*', 'students.name as student_name');
    
        if ($request->filled('class')) {
            $query->where('students.class', $request->class);
        }
    
        if ($request->filled('student_name')) {
            $query->where('students.name', $request->student_name);
        }
    
        $marks = $query->orderBy('marks.mark_id', 'desc')
            ->paginate(10);
    

        $subjectMappings = [
            'English' => '1',
            'Hindi' => '2',
            'Marathi/Sanskrit' => '3',
            'Mathematics' => '4',
            'Computers' => '5'
        ];

        return view("marks.index", compact('marks', 'subjectMappings', 'students', 'classes'));
    }


    public function create()
    {
        $students = Student::all();
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
    
        $sections = ['A', 'B', 'C', 'D'];
        $academicYears = DB::table('marks')->select('academic_year')->distinct()->pluck('academic_year');

        return view("marks.create", compact("students",'classes', 'sections','academicYears'));
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
                "{$subjectRowPrefix}_ct_2" => "{$subjectColumnPrefix}_ct2", // Added ct_2
                "{$subjectRowPrefix}_pt_calc" => "{$subjectColumnPrefix}_pt_calc",
                "{$subjectRowPrefix}_periodic_test" => "{$subjectColumnPrefix}_periodic_test",
                "{$subjectRowPrefix}_subject_enrichment" => "{$subjectColumnPrefix}_subject_enrichment",
                "{$subjectRowPrefix}_multiple_assessment" => "{$subjectColumnPrefix}_multiple_assessment",
                "{$subjectRowPrefix}_portfolio" => "{$subjectColumnPrefix}_portfolio",
                "{$subjectRowPrefix}_total" => "{$subjectColumnPrefix}_total",
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

    public function edit($student_id)
    {
        $student = Student::findOrFail($student_id);
        $sections = ['A', 'B', 'C', 'D'];

        $subjectMappings = [
            'English' => '1',
            'Hindi' => '2',
            'Marathi/Sanskrit' => '3',
            'Mathematics' => '4',
            'Computers' => '5'
        ];

        $terms = ['term1' => 'Term 1', 'term2' => 'Term 2'];

        $marks = Marks::where('student_id', $student_id)->first();

        $academicYears = DB::table('marks')->select('academic_year')->distinct()->pluck('academic_year');

        return view('marks.edit', compact('student', 'subjectMappings', 'sections', 'terms', 'marks','academicYears'));
    }


    public function update(Request $request, $student_id)
    {
        $request->validate([
            'academic_year' => 'nullable|string|max:9',
            'class' => 'nullable|string|max:50',
            'rollno' => 'nullable|string|max:20',
            'marks' => 'required|array',
            'marks.*.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {

        $student = Student::findOrFail($student_id);

        $marks = Marks::where('student_id', $student->student_id)->firstOrNew([
            'academic_year' => $request->academic_year,
            'rollno' => $request->rollno,
        ]);

        foreach ($request->marks as $termKey => $subjects) {
            foreach ($subjects as $subjectKey => $markTypes) {
                $total = 0;
    
                foreach ($markTypes as $type => $value) {
                    $columnName = "{$termKey}_subject_{$subjectKey}" . ($type === 'exam' ? '' : "_{$type}");
                    $marks->$columnName = $value ?? 0;
                    $total += $value ?? 0;
                }
    
                $totalColumn = "{$termKey}_subject_{$subjectKey}_total";
                $marks->$totalColumn = $total;
            }
        }
    
        $marks->save();

        DB::commit();

        return redirect()->route('edit-marks', $student_id)->with('success', 'Marks updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('edit-marks', $student_id)->with('error', 'Failed to update marks! ' . $e->getMessage());
        }
    }

    public function storeOld(Request $request)
    {
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

    public function destroy($id)
    {
        $user = Marks::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Marks record Deleted Successfully!');
    }

}
