<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    /**
     * Display a listing of the clinics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::all();
        return view('clinics.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new clinic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics.create');
    }

    /**
     * Store a newly created clinic in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:clinics',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $clinic = Clinic::create($request->all());

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'clinics',
            'record_id' => $clinic->id,
        ]);

        return redirect()->route('clinics.index')->with('success', 'Clinic created successfully.');
    }

    public function show(Clinic $clinic)
    {
        return view('clinics.show', compact('clinic'));
    }

    /**
     * Show the form for editing the specified clinic.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    /**
     * Update the specified clinic in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:clinics,name,' . $clinic->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $clinic->update($request->all());

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'clinics',
            'record_id' => $clinic->id,
        ]);

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully.');
    }

    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'clinics',
            'record_id' => $clinic->id,
        ]);

        return redirect()->route('clinics.index')->with('success', 'Clinic deleted successfully');
    }
}
