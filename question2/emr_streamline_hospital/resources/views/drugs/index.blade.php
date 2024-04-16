@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('drugs.create') }}" class="btn btn-success">Create New Drug</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Drugs') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Brand Name</th>
                                <th>Form</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drugs as $drug)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td scope="row">id:{{ $drug->id }}</td>
                                <td>{{ $drug->name }}</td>
                                <td>{{ $drug->brand_name }}</td>
                                <td>{{ $drug->form }}</td>
                                <td>{{ $drug->code }}</td>
                                <td>
                                    <a href="{{ route('drugs.show', $drug) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('drugs.edit', $drug->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('drugs.destroy', $drug->id) }}" method="POST" style="display: inline;">
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
