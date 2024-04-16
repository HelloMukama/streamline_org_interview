@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Audit Log Details') }}</div>

                <div class="card-body">
                    <p><strong>Action:</strong> {{ $auditLog->action }}</p>
                    <p><strong>Table Name:</strong> {{ $auditLog->table_name }}</p>
                    <p><strong>Record ID:</strong> {{ $auditLog->record_id }}</p>
                    <p><strong>Performed By:</strong> {{ $auditLog->user->name }}</p>
                    <p><strong>Date:</strong> {{ $auditLog->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
