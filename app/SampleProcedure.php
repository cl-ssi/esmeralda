<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleProcedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'pdf_all_exam'
    ];

    protected $dates = ['deleted_at'];



    public function exams()
    {
        return $this->belongsToMany(ExamType::class, 'sample_procedure_exams', 'procedure_id', 'exam_id');
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
}
