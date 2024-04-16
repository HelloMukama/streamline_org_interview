<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icd_11_code',
        'is_primary_diagnosis',
    ];
}
