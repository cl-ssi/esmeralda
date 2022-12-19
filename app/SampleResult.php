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
        'sample_id', 'exam_type', 'result', 'result_at', 'pdf'
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
