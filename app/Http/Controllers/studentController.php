<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class studentController extends Controller
{

    public function index(){
        $student = Student::paginate(10);
        return view("student.index" ,compact("student"));
    }
}
