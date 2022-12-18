<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
      // Esta propiedad permite que estos campos se asignen de manera masiva
      protected $fillable = ['name', 'values', 'unit', 'reference_range'];

    use HasFactory;
}
