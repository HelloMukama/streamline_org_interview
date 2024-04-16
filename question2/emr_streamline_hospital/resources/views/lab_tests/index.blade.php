@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                @if(Auth::user()->role === 'administrator' || Auth::user()->role === 'lab_technician')
                    <a href="{{ route('lab_tests.create') }}" class="btn btn-success">Create New Lab Test</a>
                @endif
            </div>
            
            <div class="card">
                <div class="card-header">{{ __('Lab Tests') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Result</th>
                                <th>Authenticated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($labTests as $labTest)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>id:{{ $labTest->id }}</td>
                                    <td>{{ $labTest->name }}</td>
                                    <td>{{ $labTest->duration }}</td>
                                    <td>{{ $labTest->result }}</td>
                                    <td>
                                        @if($labTest->authenticated)
                                            <span class="badge bg-success">YES</span>
                                        @else
                                            <span class="badge bg-secondary">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('lab_tests.show', $labTest) }}" class="btn btn-info btn-sm">View</a>
                                        @if(Auth::user()->role === 'administrator' || Auth::user()->role === 'lab_technician')
                                            <a href="{{ route('lab_tests.edit', $labTest) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('lab_tests.destroy', $labTest) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No lab tests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
