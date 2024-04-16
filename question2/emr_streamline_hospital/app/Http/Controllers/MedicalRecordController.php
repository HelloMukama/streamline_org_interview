<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\MedicalDiagnosis;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return view('medical_records.index', compact('medicalRecords'));
    }

    public function create()
    {
        $patients = Patient::all(); // Fetch all patients from the database
        $medicalDiagnoses = MedicalDiagnosis::all(); // Fetch all medical diagnoses from the database
        return view('medical_records.create', compact('patients', 'medicalDiagnoses'));
    }
    
    public function store(Request $request)
    {
        // Get the authenticated user's id
        $staffId = Auth::id();

        // Validation
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'symptoms' => 'required|string',
            'medical_diagnosis_id' => 'nullable|exists:medical_diagnoses,id',
            'treatment' => 'required|string',
            'outcome' => 'required|string|in:admitted,died,referred,discharged',
        ]);

        // Add staff_id to validated data
        $validatedData['staff_id'] = $staffId;

        // Create a new medical record
        $medicalRecord = MedicalRecord::create($validatedData);

        // Log the creation action
        AuditLog::create([
            'user_id' => $staffId, // Use the authenticated user's id
            'action' => 'created',
            'table_name' => 'medical_records',
            'record_id' => $medicalRecord->id,
        ]);

        // Redirect to index with success message
        return redirect()->route('medical_records.index')->with('success', 'Medical record created successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $medicalDiagnoses = MedicalDiagnosis::all(); // Fetch all medical diagnoses from the database
        return view('medical_records.edit', compact('medicalRecord', 'medicalDiagnoses'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        // Validation
        $validatedData = $request->validate([
            'symptoms' => 'required|string',
            'treatment' => 'required|string',
            'outcome' => 'required|string|in:admitted,died,referred,discharged',
        ]);

        // Ensure patient_id, medical_diagnosis_id, lab_test_id & staff_id remain unchanged
        $validatedData['patient_id'] = $medicalRecord->patient_id;
        $validatedData['staff_id'] = $medicalRecord->staff_id;
        $validatedData['lab_test_id'] = $medicalRecord->lab_test_id;
        $validatedData['medical_diagnosis_id'] = $medicalRecord->medical_diagnosis_id;

        // Update the medical record
        $medicalRecord->update($validatedData);

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'medical_records',
            'record_id' => $medicalRecord->id,
        ]);

        // Redirect to index with success message
        return redirect()->route('medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        // Delete the medical record
        $medicalRecord->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'medical_records',
            'record_id' => $medicalRecord->id,
        ]);

        // Redirect to index with success message
        return redirect()->route('medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}
