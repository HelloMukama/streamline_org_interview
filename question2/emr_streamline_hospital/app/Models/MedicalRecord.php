<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'staff_id',
        'symptoms',
        'lab_test_id',
        'medical_diagnosis_id',
        'treatment',
        'outcome',
    ];

    protected $dates = ['deleted_at'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class);
    }

    public function medicalDiagnosis()
    {
        return $this->belongsTo(MedicalDiagnosis::class);
    }
}
