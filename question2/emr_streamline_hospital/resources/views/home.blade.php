@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-header">Your Role: {{ Auth::user()->role }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>User Roles and Permissions</h2>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administrator</td>
                                <td>Can create, read, update, and delete all records</td>
                            </tr>
                            <tr>
                                <td>Lab Technician</td>
                                <td>Can create, read, update, and delete lab test records</td>
                            </tr>
                            <tr>
                                <td>Senior Lab Technician</td>
                                <td>Can authenticate lab tests and delete lab test records</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>More Roles as Described...</td>
                                <td>...</td>
                            </tr>
                            
                        </tbody>
                    </table>

                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
