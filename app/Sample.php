<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sample_at',
        'sample_type',
        'type',
        'establishment_id',
        'user_id',
        'patient_id',
    ];
}
