<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'string', 'in:administrator,doctor,pharmacist,nurse,surgeon,lab technician'],
        ]);

        // Update user record
        $user->update($validatedData);

        // Log the update action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'table_name' => 'users',
            'record_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

     // Show a specific user
     public function show($id)
     {
         $user = User::findOrFail($id);
         return view('users.show', compact('user'));
     }
 
     // Delete a user
     public function destroy($id)
     {
         $user = User::findOrFail($id);
         $user->delete();

         // Log the deletion action
         AuditLog::create([
             'user_id' => Auth::id(),
             'action' => 'deleted',
             'table_name' => 'users',
             'record_id' => $user->id,
         ]);

         return redirect()->route('users.index')->with('success', 'User deleted successfully');
     }
}
