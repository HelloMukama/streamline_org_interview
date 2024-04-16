<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = Drug::all();
        return view('drugs.index', compact('drugs'));
    }

    public function create()
    {
        return view('drugs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'brand_name' => ['required', 'string', 'max:255'],
            'form' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $drug = Drug::create($request->all());

        // Log the creation action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'table_name' => 'drugs',
            'record_id' => $drug->id,
        ]);

        return redirect()->route('drugs.index')->with('success', 'Drug created successfully.');
    }

    public function show(Drug $drug)
    {
        return view('drugs.show', compact('drug'));
    }

    public function edit($id)
    {
        $drug = Drug::findOrFail($id);
        return view('drugs.edit', compact('drug'));
    }

    public function update(Request $request, Drug $drug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'form' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $drug->update($request->all());

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'drugs',
            'record_id' => $drug->id,
        ]);

        return redirect()->route('drugs.index')->with('success', 'Drug updated successfully.');
    }
    
    public function destroy(Request $request)
    {
        $drug = Drug::findOrFail($request->id);
        $drug->delete();

        // Log the deletion action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'table_name' => 'drugs',
            'record_id' => $request->id,
        ]);

        return redirect()->route('drugs.index')->with('success', 'Drug deleted successfully.');
    }
}
