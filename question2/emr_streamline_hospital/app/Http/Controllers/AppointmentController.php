<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $clinics = Clinic::all();
        $staffs = User::whereIn('role', ['doctor', 'pharmacist', 'surgeon', 'lab technician', 'nurse'])->get();
        
        return view('appointments.create', compact('patients', 'clinics', 'staffs'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'clinic_id' => 'required|exists:clinics,id',
            'staff_id' => 'required|exists:users,id',
            'clinical_notes' => 'nullable|string',
            'date_and_time' => 'required|date',
            'status' => 'required|string|in:postponed,brought_forward,canceled,started,completed',
        ]);

        // Create the appointment
        $appointment = Appointment::create($request->all());

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'appointments',
            'record_id' => $appointment->id,
        ]);

        // Redirect to index page
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $clinics = Clinic::all();
        $staffs = User::whereIn('role', ['doctor', 'pharmacist', 'surgeon', 'lab technician', 'nurse'])->get();
        
        return view('appointments.edit', compact('appointment', 'patients', 'clinics', 'staffs'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Validation
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'clinic_id' => 'required|exists:clinics,id',
            'staff_id' => 'required|exists:users,id',
            'clinical_notes' => 'nullable|string',
            'date_and_time' => 'required|date',
            'status' => 'required|string|in:postponed,brought_forward,canceled,started,completed',
        ]);

        // Update the appointment
        $appointment->update($request->all());

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'appointments',
            'record_id' => $appointment->id,
        ]);

        // Redirect to index page
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'appointments',
            'record_id' => $appointment->id,
        ]);

        // Redirect to index page
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
