<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $table = 'marks';

    protected $primaryKey = 'mark_id'; // Explicitly define the primary key

    public $incrementing = true; // Ensures Laravel knows it's an auto-incrementing key

    protected $fillable = [
        'student_id',
        'academic_year',
        'rollno',
        'class',
        'term1_subject_1', 'term1_subject_1_ct', 'term1_subject_1_periodic_test',
        'term1_subject_1_subject_enrichment', 'term1_subject_1_multiple_assessment',
        'term1_subject_1_portfolio', 'term1_subject_1_total', 'term1_subject_1_grade',
        'term1_subject_2', 'term1_subject_2_ct', 'term1_subject_2_periodic_test',
        'term1_subject_2_subject_enrichment', 'term1_subject_2_multiple_assessment',
        'term1_subject_2_portfolio', 'term1_subject_2_total', 'term1_subject_2_grade',
        'term1_subject_3', 'term1_subject_3_ct', 'term1_subject_3_periodic_test',
        'term1_subject_3_subject_enrichment', 'term1_subject_3_multiple_assessment',
        'term1_subject_3_portfolio', 'term1_subject_3_total', 'term1_subject_3_grade',
        'term1_subject_4', 'term1_subject_4_ct', 'term1_subject_4_periodic_test',
        'term1_subject_4_subject_enrichment', 'term1_subject_4_multiple_assessment',
        'term1_subject_4_portfolio', 'term1_subject_4_total', 'term1_subject_4_grade',
        'term1_subject_5', 'term1_subject_5_ct', 'term1_subject_5_periodic_test',
        'term1_subject_5_subject_enrichment', 'term1_subject_5_multiple_assessment',
        'term1_subject_5_portfolio', 'term1_subject_5_total', 'term1_subject_5_grade',
        'term1_subject_6', 'term1_subject_6_ct', 'term1_subject_6_periodic_test',
        'term1_subject_6_subject_enrichment', 'term1_subject_6_multiple_assessment',
        'term1_subject_6_portfolio', 'term1_subject_6_total', 'term1_subject_6_grade',
        'term1_subject_7', 'term1_subject_7_ct', 'term1_subject_7_periodic_test',
        'term1_subject_7_subject_enrichment', 'term1_subject_7_multiple_assessment',
        'term1_subject_7_portfolio', 'term1_subject_7_total', 'term1_subject_7_grade',
        'term1_subject_8', 'term1_subject_8_ct', 'term1_subject_8_periodic_test',
        'term1_subject_8_subject_enrichment', 'term1_subject_8_multiple_assessment',
        'term1_subject_8_portfolio', 'term1_subject_8_total', 'term1_subject_8_grade',
        'term1_subject_9', 'term1_subject_9_ct', 'term1_subject_9_periodic_test',
        'term1_subject_9_subject_enrichment', 'term1_subject_9_multiple_assessment',
        'term1_subject_9_portfolio', 'term1_subject_9_total', 'term1_subject_9_grade',
        'term2_subject_1', 'term2_subject_1_ct', 'term2_subject_1_periodic_test',
        'term2_subject_1_subject_enrichment', 'term2_subject_1_multiple_assessment',
        'term2_subject_1_portfolio', 'term2_subject_1_total', 'term2_subject_1_grade',
        'term2_subject_2', 'term2_subject_2_ct', 'term2_subject_2_periodic_test',
        'term2_subject_2_subject_enrichment', 'term2_subject_2_multiple_assessment',
        'term2_subject_2_portfolio', 'term2_subject_2_total', 'term2_subject_2_grade',
        'term2_subject_3', 'term2_subject_3_ct', 'term2_subject_3_periodic_test',
        'term2_subject_3_subject_enrichment', 'term2_subject_3_multiple_assessment',
        'term2_subject_3_portfolio', 'term2_subject_3_total', 'term2_subject_3_grade',
        'term2_subject_4', 'term2_subject_4_ct', 'term2_subject_4_periodic_test',
        'term2_subject_4_subject_enrichment', 'term2_subject_4_multiple_assessment',
        'term2_subject_4_portfolio', 'term2_subject_4_total', 'term2_subject_4_grade',
        'term2_subject_5', 'term2_subject_5_ct', 'term2_subject_5_periodic_test',
        'term2_subject_5_subject_enrichment', 'term2_subject_5_multiple_assessment',
        'term2_subject_5_portfolio', 'term2_subject_5_total', 'term2_subject_5_grade',
        'term2_subject_6', 'term2_subject_6_ct', 'term2_subject_6_periodic_test',
        'term2_subject_6_subject_enrichment', 'term2_subject_6_multiple_assessment',
        'term2_subject_6_portfolio', 'term2_subject_6_total', 'term2_subject_6_grade',
        'term2_subject_7', 'term2_subject_7_ct', 'term2_subject_7_periodic_test',
        'term2_subject_7_subject_enrichment', 'term2_subject_7_multiple_assessment',
        'term2_subject_7_portfolio', 'term2_subject_7_total', 'term2_subject_7_grade',
        'term2_subject_8', 'term2_subject_8_ct', 'term2_subject_8_periodic_test',
        'term2_subject_8_subject_enrichment', 'term2_subject_8_multiple_assessment',
        'term2_subject_8_portfolio', 'term2_subject_8_total', 'term2_subject_8_grade',
        'term2_subject_9', 'term2_subject_9_ct', 'term2_subject_9_periodic_test',
        'term2_subject_9_subject_enrichment', 'term2_subject_9_multiple_assessment',
        'term2_subject_9_portfolio', 'term2_subject_9_total', 'term2_subject_9_grade',
        'term1_total', 'term2_total'
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
