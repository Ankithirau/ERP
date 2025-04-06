<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

     protected $table = 'students';

     protected $guarded = [];

     protected $primaryKey = 'student_id';


     public function marks()
    {
        return $this->hasMany(Marks::class, 'student_id', 'student_id');
    }
    public function results()
    {
        return $this->hasMany(Result::class, 'student_id');
    }

    public function excellence()
    {
        return $this->hasMany(Excellence::class, 'student_id');
    }
}
