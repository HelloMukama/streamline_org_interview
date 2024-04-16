@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Clinic Details') }}</div>

                @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $clinic->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Created At:</strong> {{ $clinic->created_at->format('Y-m-d H:i:s') }}
                    </div>
                    <div class="mb-3">
                        <strong>Updated At:</strong> {{ $clinic->updated_at->format('Y-m-d H:i:s') }}
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('clinics.edit', $clinic) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('clinics.destroy', $clinic) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this clinic?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
