<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleResult extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sample_id', 'exam_id', 'exam_name', 'result', 'result_at', 'pdf', 'reception_at'
    ];

        /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'result_at' => 'datetime',
    ];


}
