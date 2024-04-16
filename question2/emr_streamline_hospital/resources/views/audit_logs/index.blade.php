@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Audit Logs (Latest Logs First)') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>User Role</th>
                                <th>Action</th>
                                <th>Record ID</th>
                                <th>Table Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auditLogs as $auditLog)
                            <tr>
                                <td>{{ $auditLog->id }}</td>
                                <td>{{ $auditLog->user->name }}</td>
                                <td>{{ $auditLog->user->role }}</td>
                                <td>
                                    @if($auditLog->action == 'deleted')
                                    <span class="text-danger">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'updated')
                                    <span class="text-primary">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'created')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'restored_one')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'restored_all')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'deleted (api)')
                                    <span class="text-danger">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'updated (api)')
                                    <span class="text-primary">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'created (api)')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'restored_one (api)')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'restored_all (api)')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @elseif($auditLog->action == 'created (pestphp)')
                                    <span class="text-success">{{ $auditLog->action }}</span>
                                    @else
                                    {{ $auditLog->action }}
                                    @endif
                                </td>
                                <td>{{ $auditLog->record_id }}</td>
                                <td>{{ $auditLog->table_name }}</td>
                                <td>{{ $auditLog->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
