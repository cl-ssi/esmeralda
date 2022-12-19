<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleProcedureExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'procedure_id', 'exam_id'
    ];
}
