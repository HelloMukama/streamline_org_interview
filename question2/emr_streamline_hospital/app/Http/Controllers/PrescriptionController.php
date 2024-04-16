<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\MedicalRecord;
use App\Models\Drug;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $medicalRecords = MedicalRecord::all();
        $drugs = Drug::all();
        $pharmacists = User::where('role', 'pharmacist')->get();
        return view('prescriptions.create', compact('medicalRecords', 'drugs', 'pharmacists'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medical_record_id' => 'required',
            'drug_id' => 'required',
            'pharmacist_id' => 'required',
            'instructions' => 'required',
        ]);

        $prescription = Prescription::create($validatedData);

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'prescriptions',
            'record_id' => $prescription->id,
        ]);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription created successfully');
    }

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $medicalRecords = MedicalRecord::all();
        $drugs = Drug::all();
        $pharmacists = User::where('role', 'pharmacist')->get();
        return view('prescriptions.edit', compact('prescription', 'medicalRecords', 'drugs', 'pharmacists'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $validatedData = $request->validate([
            'medical_record_id' => 'required',
            'drug_id' => 'required',
            'pharmacist_id' => 'required',
            'instructions' => 'required',
        ]);

        $prescription->update($validatedData);

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'prescriptions',
            'record_id' => $prescription->id,
        ]);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription updated successfully');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        
        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'prescriptions',
            'record_id' => $prescription->id,
        ]);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription deleted successfully');
    }
}
