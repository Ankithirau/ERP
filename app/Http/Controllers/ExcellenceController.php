<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Excellence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcellenceController extends Controller
{
    public function index()
    {
        $excellenceRecords = Excellence::orderBy('academic_year', 'desc')->paginate(10);
        return view('excellence.index', compact('excellenceRecords'));
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

        return view('excellence.create',compact("students",'classes', 'sections','academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string',
            'class' => 'required|string',
            'section' => 'required|string',
            'marks' => 'required|array',
            'marks.*.rollno' => 'nullable|string',
            'marks.*.term1_work_education' => 'nullable|integer',
            'marks.*.term1_art_education' => 'nullable|integer',
            'marks.*.term1_physical_education' => 'nullable|integer',
            'marks.*.term1_discipline' => 'nullable|integer',
            'marks.*.term2_work_education' => 'nullable|integer',
            'marks.*.term2_art_education' => 'nullable|integer',
            'marks.*.term2_physical_education' => 'nullable|integer',
            'marks.*.term2_discipline' => 'nullable|integer',
        ]);

        DB::beginTransaction();

        try {
            foreach ($validated['marks'] as $student_id => $markData) {
                Excellence::updateOrCreate(
                    [
                        'student_id' => $student_id, 
                        'academic_year' => $validated['academic_year'],
                        'class' => $validated['class'],
                        'section' => $validated['section']],
                    [
                        'rollno' => $markData['rollno'] ?? null,
                        'term1_work_education' => $markData['term1_work_education'] ?? null,
                        'term1_art_education' => $markData['term1_art_education'] ?? null,
                        'term1_physical_education' => $markData['term1_physical_education'] ?? null,
                        'term1_discipline' => $markData['term1_discipline'] ?? null,
                        'term2_work_education' => $markData['term2_work_education'] ?? null,
                        'term2_art_education' => $markData['term2_art_education'] ?? null,
                        'term2_physical_education' => $markData['term2_physical_education'] ?? null,
                        'term2_discipline' => $markData['term2_discipline'] ?? null,
                    ]
                );
            }

            DB::commit();

            return redirect()->back()->with('success', 'Marks stored successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while storing marks. Please try again.'.$e->getMessage().$e->getFile().':'.$e->getLine());
        }
    }

    public function edit($id){
        $excellence = Excellence::findOrFail($id);
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[$i] = "Class $i";
        }
    
        $sections = ['A', 'B', 'C', 'D'];
        $student = Student::findOrFail($excellence->student_id);
        $academicYears = DB::table('marks')->select('academic_year')->distinct()->pluck('academic_year');

    
        return view('excellence.edit', compact('excellence', 'classes', 'sections', 'student','academicYears'));
    
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'academic_year' => 'required|string',
            'class' => 'required|string',
            'section' => 'required|string',
            'rollno' => 'required|string',
            'term1_work_education' => 'nullable|numeric',
            'term1_art_education' => 'nullable|numeric',
            'term1_physical_education' => 'nullable|numeric',
            'term1_discipline' => 'nullable|numeric',
            'term2_work_education' => 'nullable|numeric',
            'term2_art_education' => 'nullable|numeric',
            'term2_physical_education' => 'nullable|numeric',
            'term2_discipline' => 'nullable|numeric',
        ]);

        try {
            DB::beginTransaction(); // Start Transaction

            $excellence = Excellence::findOrFail($id);

            $excellence->update([
                'academic_year' => $request->academic_year,
                'class' => $request->class,
                'section' => $request->section,
                'rollno' => $request->rollno,
                'term1_work_education' => $request->term1_work_education,
                'term1_art_education' => $request->term1_art_education,
                'term1_physical_education' => $request->term1_physical_education,
                'term1_discipline' => $request->term1_discipline,
                'term2_work_education' => $request->term2_work_education,
                'term2_art_education' => $request->term2_art_education,
                'term2_physical_education' => $request->term2_physical_education,
                'term2_discipline' => $request->term2_discipline,
            ]);

            DB::commit(); // Commit the transaction if successful

            return redirect()->route('edit.excellence', $id)->with('success', 'Marks updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of error
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = Excellence::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Marks record Deleted Successfully!');
    }

}
