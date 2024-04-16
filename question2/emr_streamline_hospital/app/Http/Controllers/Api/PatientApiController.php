<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientApiController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
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
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $patient = Patient::create($request->all());

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created (api)',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return response()->json($patient, 201);
    }

    public function show(Patient $patient)
    {
        if (!$patient->exists) {
            return response()->json(['message' => 'Sorry, patient does not exist'], 404);
        }

        return response()->json($patient);
    }

    public function update(Patient $patient, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_number' => 'sometimes|required|unique:patients,file_number,',
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'gender' => 'sometimes|required',
            'date_of_birth' => 'sometimes|required|date',
            'phone_number' => 'sometimes|required',
            'next_of_kin_relationship' => 'sometimes|required',
            'next_of_kin_phone_number' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $patient->fill($request->all());
        $patient->save();

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated (api)',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return response()->json($patient, 200);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted (api)',
            'table_name' => 'patients',
            'record_id' => $patient->id,
        ]);

        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }

    public function trashed()
    {
        $trashedPatients = Patient::onlyTrashed()->get();
        return response()->json($trashedPatients);
    }

    public function restore($id) 
    {
        // Restore 1 trashed patient
        Patient::withTrashed()->find($id)->restore();

        // Log the restoration action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'restored_one (api)',
            'table_name' => 'patients',
            'record_id' => $id, // Log the ID of restored patient
        ]);

        return response()->json(['message' => '1 patient restored successfully.'], 200);
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
                'action' => 'restored_all (api)',
                'table_name' => 'patients',
                'record_id' => $patient->id, // Log the ID of each restored patient
            ]);
        }

        return response()->json(['message' => 'All patients restored successfully'], 200);
    }
}

