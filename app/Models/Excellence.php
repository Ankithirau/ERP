<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excellence extends Model
{
    use HasFactory;

    protected $table = 'excellence';

    protected $fillable = [
        'student_id',
        'academic_year',
        'class',
        'rollno',
        'section',
        'term1_work_education',
        'term1_art_education',
        'term1_physical_education',
        'term1_discipline',
        'term2_work_education',
        'term2_art_education',
        'term2_physical_education',
        'term2_discipline'
    ];
}
