<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = LabTest::all();
        return view('lab_tests.index', compact('labTests'));
    }

    public function create()
    {
        // Check if the user has 'administrator' or 'lab_technician' role
        if (Auth::user()->role === 'administrator' || Auth::user()->role === 'lab_technician') {
            $patients = Patient::all();
            return view('lab_tests.create', compact('patients'));
        } else {
            // Redirect or show unauthorized view
            return redirect()->route('lab_tests.index')->with('error', 'Unauthorized access.');
        }
    }

    public function store(Request $request)
    {
        // Check if the user has 'administrator' or 'lab_technician' role
        if (Auth::user()->role !== 'administrator' && Auth::user()->role !== 'lab_technician') {
            return redirect()->route('lab_tests.index')->with('error', 'Unauthorized access.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|integer',
            'result' => 'nullable|string',
        ]);

        // Create a new lab test
        $labTest = LabTest::create($request->all());

        // Create audit log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'table_name' => 'lab_tests',
            'record_id' => $labTest->id,
        ]);

        return redirect()->route('lab_tests.index')->with('success', 'Lab test created successfully.');
    }

    public function show(LabTest $labTest)
    {
        return view('lab_tests.show', compact('labTest'));
    }

    public function edit(LabTest $labTest)
    {
        // Check if the user has 'administrator' or 'lab_technician' role
        if (Auth::user()->role === 'administrator' || Auth::user()->role === 'lab_technician') {
            $patients = Patient::all();
            return view('lab_tests.edit', compact('labTest', 'patients'));
        } else {
            // Redirect or show unauthorized view
            return redirect()->route('lab_tests.index')->with('error', 'Unauthorized access.');
        }
    }

    public function update(Request $request, LabTest $labTest)
    {
        // Check if the user has 'administrator' or 'lab_technician' role
        if (Auth::user()->role !== 'administrator' && Auth::user()->role !== 'lab_technician') {
            return redirect()->route('lab_tests.index')->with('error', 'Unauthorized access.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|integer',
            'result' => 'nullable|string',
        ]);

        // Update the lab test attributes
        $labTest->name = $request->input('name');
        $labTest->duration = $request->input('duration');
        $labTest->result = $request->input('result');

        // Save the updated lab test
        $labTest->save();

        // Create audit log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'table_name' => 'lab_tests',
            'record_id' => $labTest->id,
        ]);

        return redirect()->route('lab_tests.index')->with('success', 'Lab test updated successfully.');
    }

    public function destroy(LabTest $labTest)
    {
        // Check if the user has 'administrator' or 'lab_technician' role
        if (Auth::user()->role !== 'administrator' && Auth::user()->role !== 'lab_technician') {
            return redirect()->route('lab_tests.index')->with('error', 'Unauthorized access.');
        }

        // Create audit log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'table_name' => 'lab_tests',
            'record_id' => $labTest->id,
        ]);

        // Delete the lab test
        $labTest->delete();

        return redirect()->route('lab_tests.index')->with('success', 'Lab test deleted successfully.');
    }

    public function authenticate(LabTest $labTest)
    {
        // Ensure only senior lab technicians can authenticate
        if (auth()->user()->role === 'senior_lab_technician') {
            $labTest->authenticated = true;
            $labTest->save();
            return redirect()->route('lab_tests.show', $labTest)->with('success', 'Lab test authenticated successfully.');
        } else {
            return redirect()->back()->with('error', 'You do not have permission to authenticate lab tests.');
        }
    }
}
