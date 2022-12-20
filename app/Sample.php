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
        'procedure_id',
        'procedure_name',
        'sample_at',
        'sample_type',
        'type',
        'result_at',
        'reception_at',
        'receptor_id',
        'establishment_id',
        'user_id',
        'laboratory_id',
        'patient_id',
    ];

    protected $dates = [
        'sample_at','result_at',

    ];

    public function procedure()
    {
        return $this->belongsTo(SampleProcedure::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function sampleResults()
    {
        return $this->hasMany(SampleResult::class);
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
