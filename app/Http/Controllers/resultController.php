<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use App\Models\Result;
use App\Models\Student;
use App\Models\Excellence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
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

    public function view(Request $request){
        $students = Student::all();
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
        return view('result.view',compact('students', 'classes'));
    }

    public function generateResult(Request $request)
    {    
        // For POST requests (form submission)
        $validator = Validator::make($request->all(), [
            'year' => 'required|numeric|min:2015|max:' . date('Y'),
            'term' => 'required|in:Term 1,Term 2,Term1+Term2',
            'roll_no' => 'required|string|max:20',
            'mother_name' => 'required|string|max:255'
        ], [
            'year.required' => 'Please select a year',
            'year.numeric' => 'Year must be a valid number',
            'year.min' => 'Year must be 2015 or later',
            'year.max' => 'Year cannot be in the future',
            'term.required' => 'Please select a term',
            'term.in' => 'Please select a valid term option',
            'roll_no.required' => 'Roll number is required',
            'mother_name.required' => "Mother's name is required"
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
        
        // Get marks
        $marks = Marks::where('rollno', $request->roll_no)
            ->where('academic_year', $request->year)
            ->firstOrFail();

        $student = Student::where('student_id', $marks->student_id)
        ->where('mother_name', $request->mother_name)
        ->firstOrFail();

        // Get result summary
        $resultSummary = Result::where('student_id', $student->student_id)
            ->where('academic_year', $request->year)
            ->first();

        // Get co-scholastic data
        $excellence = Excellence::where('student_id', $student->student_id)
            ->where('academic_year', $request->year)
            ->first();

        // Subject mappings (you can store this in config)
        $subjectMappings = [
            'English' => '1',
            'Hindi' => '2',
            'Marathi/Sanskrit' => '3', 
            'Mathematics' => '4',
            'Computers' => '5',
            'EVS' => '6',
            'Science' => '7',
            'Social Studies' => '8'
        ];

        // Process term data
        $termData = [];
        $terms = $request->term == 'Term1+Term2' ? ['Term I', 'Term II'] : [$request->term];
        
        foreach ($terms as $term) {
            $termKey = str_contains($term, '1') ? 'term1' : 'term2';
            
            $subjectScores = [];
            
            foreach ($subjectMappings as $subjectName => $subjectNum) {
                $prefix = "{$termKey}_subject_{$subjectNum}";
                
                if (isset($marks->{"{$prefix}_total"})) {
                    $subjectScores[] = [
                        'name' => $subjectName,
                        'pt' => $marks->{"{$prefix}_periodic_test"} ?? 0,
                        'enrich' => $marks->{"{$prefix}_subject_enrichment"} ?? 0,
                        'assess' => $marks->{"{$prefix}_multiple_assessment"} ?? 0,
                        'ct' => $marks->{"{$prefix}_ct"} ?? 0,
                        'portfolio' => $marks->{"{$prefix}_portfolio"} ?? 0,
                        'test' => "{$prefix}_portfolio",
                        'mid' => $marks->{"{$prefix}"} ?? 0,
                        'total' => $marks->{"{$prefix}_total"} ?? 0,
                        'grade' => $marks->{"{$prefix}_grade"} ?? ''
                    ];
                }
            }
            
            // Use summary data from result table if available
            if ($resultSummary) {
                $termData[] = [
                    'name' => $term,
                    'subjects' => $subjectScores,
                    'total' => $resultSummary->{"{$termKey}_total_marks"},
                    'percentage' => $resultSummary->{"{$termKey}_percentage"},
                    'grade' => $resultSummary->{"{$termKey}_grade"},
                    'class' => $student->class // Make sure class is included

                ];
            } else {
                // Fallback calculation if result table doesn't have data
                $totalMarks = array_sum(array_column($subjectScores, 'total'));
                $maxMarks = count($subjectScores) * 100;
                $percentage = $maxMarks > 0 ? round(($totalMarks / $maxMarks) * 100, 2) : 0;
                
                $termData[] = [
                    'name' => $term,
                    'subjects' => $subjectScores,
                    'total' => $totalMarks,
                    'percentage' => $percentage,
                    'grade' => $this->calculateOverallGrade($percentage),
                    'overall_grade' => $request->term == 'Term1+Term2' ? 
                    $this->calculateOverallGrade($percentage) : null,
                    'class' => $student->class // Make sure class is included
                ];
            }
        }

        // Process co-scholastic data
        $coScholastic = [];
        if ($excellence) {
            $coScholastic = [
                ['activity' => 'Work Education', 'term1' => $excellence->term1_work_education, 'term2' => $excellence->term2_work_education],
                ['activity' => 'Art Education', 'term1' => $excellence->term1_art_education, 'term2' => $excellence->term2_art_education],
                ['activity' => 'Physical Education', 'term1' => $excellence->term1_physical_education, 'term2' => $excellence->term2_physical_education],
                ['activity' => 'Discipline', 'term1' => $excellence->term1_discipline, 'term2' => $excellence->term2_discipline]
            ];
        }   

        // dd(compact('student','marks', 'termData', 'coScholastic', 'request'));
        return view('result.generate', compact('student','marks', 'termData', 'coScholastic', 'request'));

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    private function calculateOverallGrade($percentage)
    {
        if ($percentage >= 91) return 'A+';
        if ($percentage >= 81) return 'A';
        if ($percentage >= 71) return 'B+';
        if ($percentage >= 61) return 'B';
        if ($percentage >= 51) return 'C+';
        if ($percentage >= 41) return 'C';
        if ($percentage >= 33) return 'D';
        return 'E';
    }

}
