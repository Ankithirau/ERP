<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_no', 'student_id', 'student_name', 'class','fees_details','pdf_path', 'section', 'amount', 'payment_date', 'payment_mode'
    ];
}

