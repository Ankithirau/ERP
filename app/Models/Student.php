<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

     protected $table = 'students';

     protected $guarded = [];

     public function marks()
    {
        return $this->hasMany(Marks::class, 'student_id', 'student_id');
    }
}
