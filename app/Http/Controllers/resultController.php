<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class resultController extends Controller
{
    public function index(){

       $result = Result::join('students', 'results.student_id', '=', 'students.student_id')
        ->select('results.*', 'students.name as student_name')
        ->paginate(10);

        return view("result.index" , compact("result"));
    }
}
