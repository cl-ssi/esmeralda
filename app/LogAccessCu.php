<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Patient;

class LogAccessCu extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id','patient_id'
    ];

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $table = 'log_access_cu';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    
}
