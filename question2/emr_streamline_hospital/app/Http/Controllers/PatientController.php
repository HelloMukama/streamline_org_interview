<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_number' => 'required|unique:patients',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'next_of_kin_relationship' => 'required',
            'next_of_kin_phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $patient = Patient::create($request->all());

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'file_number' => 'sometimes|required|unique:patients,file_number,' . $patient->id,
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'gender' => 'sometimes|required',
            'date_of_birth' => 'sometimes|required|date',
            'phone_number' => 'sometimes|required',
            'next_of_kin_relationship' => 'sometimes|required',
            'next_of_kin_phone_number' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $patient->update($request->all());

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }

    public function trashed()
    {
        $trashedPatients = Patient::onlyTrashed()->get();
        return view('patients.trashed', compact('trashedPatients'));
    }

    public function restore($id) 
    {
        // Restore 1 trashed patient
        Patient::withTrashed()->find($id)->restore();

        // Log the restoration action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'restored_one',
            'table_name' => 'patients',
            'record_id' => $id, // Log the ID of restored patient
        ]);

        return redirect()->route('patients.trashed')
            ->with('success', '1 patient restored successfully.');
    }

    public function restoreAll()
    {
        $restoredPatients = Patient::onlyTrashed()->get();

        // Restore all trashed patients
        Patient::onlyTrashed()->restore();
        
        // Log the restoration of all patients action
        foreach ($restoredPatients as $patient) {
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'restored_all',
                'table_name' => 'patients',
                'record_id' => $patient->id, // Log the ID of each restored patient
            ]);
        }

        return redirect()->route('patients.index')
            ->with('success', 'All patients restored successfully.');
    }
}
