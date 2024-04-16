<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PatientController;
use App\Models\Patient;

class ApiPlaygroundController extends Controller
{
    // Display systems api routes and an api playground
    public function system_apis()
    {
        $api_list = [
            'POST /api/patients/create',
            'GET /api/patients/all',
            'GET /api/patients/show/{id}',
            'PUT /api/patients/{id}/update',
            'DELETE /api/patients/{id}/delete',
            'GET /api/patients/trashed/temp', // View all deleted patients endpoint
            'POST /api/patients/trashed/temp/{id}/restore', // Restore 1 patient endpoint
            'POST /api/patients/trashed/temp/restore-all', // Restore all patients endpoint
        ];

        return view('components.api_list', compact('api_list'));
    }

    // Method to get method name for patient resource
    private function getPatientMethodName($segments)
    {
        $action = $segments[4]; // Action name is the 5th segment in the URL

        // Map URL action to corresponding method name
        switch ($action) {
            case 'all':
                return 'index';
            case 'create':
                return 'store';
            case 'show':
                return 'show';
            case 'update':
                return 'update';
            case 'delete':
                return 'destroy';
            case 'temp':
                return $this->getTempMethodName($segments);
            default:
                return null;
        }
    }

    // Method to get method name for temp (trashed) actions
    private function getTempMethodName($segments)
    {
        $action = $segments[6]; // Action name is the 7th segment in the URL

        // Map URL action to corresponding method name
        switch ($action) {
            case 'restore':
                return 'restore';
            case 'restore-all':
                return 'restoreAll';
            default:
                return null;
        }
    }
}
