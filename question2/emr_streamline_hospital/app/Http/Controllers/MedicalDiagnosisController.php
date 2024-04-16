<?php

namespace App\Http\Controllers;

use App\Models\MedicalDiagnosis;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicalDiagnosisController extends Controller
{
    public function index()
    {
        $medicalDiagnoses = MedicalDiagnosis::all();
        return view('medical_diagnoses.index', compact('medicalDiagnoses'));
    }

    public function create()
    {
        return view('medical_diagnoses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icd_11_code' => 'required|string|max:255',
            'is_primary_diagnosis' => 'nullable|boolean', // Allow null or boolean values
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $medicalDiagnosis = MedicalDiagnosis::create([
            'name' => $request->input('name'),
            'icd_11_code' => $request->input('icd_11_code'),
            'is_primary_diagnosis' => $request->has('is_primary_diagnosis'), // Convert checkbox value to boolean
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'medical_diagnoses',
            'record_id' => $medicalDiagnosis->id,
        ]);

        return redirect()->route('medical_diagnoses.index')
            ->with('success', 'Medical Diagnosis created successfully.');
    }

    public function show(MedicalDiagnosis $medicalDiagnosis)
    {
        return view('medical_diagnoses.show', compact('medicalDiagnosis'));
    }
    
    public function edit(MedicalDiagnosis $medicalDiagnosis)
    {
        return view('medical_diagnoses.edit', compact('medicalDiagnosis'));
    }

    public function update(Request $request, MedicalDiagnosis $medicalDiagnosis)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icd_11_code' => 'required|string|max:255',
            'is_primary_diagnosis' => 'nullable|boolean', // Allow null or boolean values
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $medicalDiagnosis->update([
            'name' => $request->input('name'),
            'icd_11_code' => $request->input('icd_11_code'),
            'is_primary_diagnosis' => $request->has('is_primary_diagnosis'), // Convert checkbox value to boolean
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'medical_diagnoses',
            'record_id' => $medicalDiagnosis->id,
        ]);

        return redirect()->route('medical_diagnoses.index')
            ->with('success', 'Medical Diagnosis updated successfully.');
    }

    public function destroy(MedicalDiagnosis $medicalDiagnosis)
    {
        $medicalDiagnosis->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'medical_diagnoses',
            'record_id' => $medicalDiagnosis->id,
        ]);

        return redirect()->route('medical_diagnoses.index')
            ->with('success', 'Medical Diagnosis deleted successfully');
    }
}

