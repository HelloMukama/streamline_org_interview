@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ route('clinics.create') }}" class="btn btn-success">Add New Clinic</a>
            </div>
                    
            <div class="card">
                <div class="card-header">{{ __('Clinics') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinics as $clinic)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>id:{{ $clinic->id }}</td>
                                <td>{{ $clinic->name }}</td>
                                <td>{{ $clinic->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $clinic->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('clinics.show', $clinic) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('clinics.edit', $clinic) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('clinics.destroy', $clinic) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
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
