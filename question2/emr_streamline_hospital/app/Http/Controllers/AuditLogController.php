<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the audit logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditLogs = AuditLog::all();
        // $auditLogs = AuditLog::paginate(10); // Fetch 10 audit logs per page
        // $auditLogs = AuditLog::orderBy('created_at', 'desc')->paginate(10); // Fetch 10 audit logs per page
        return view('audit_logs.index', compact('auditLogs'));
    }

    /**
     * Display the specified audit log.
     *
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Http\Response
     */
    public function show(AuditLog $auditLog)
    {
        return view('audit_logs.show', compact('auditLog'));
    }
}
