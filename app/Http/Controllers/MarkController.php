<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marks;

class MarkController extends Controller
{

    public function index(){
         $marks = Marks::join('students', 'marks.student_id', '=', 'students.student_id')
        ->select('marks.*', 'students.name as student_name')
        ->paginate(10);



       return view("mark.index", compact('marks'));
    }
}
