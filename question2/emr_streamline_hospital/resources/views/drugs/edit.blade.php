@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Drug</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('drugs.update', $drug->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $drug->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $drug->brand_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="form" class="form-label">Form</label>
                                <input type="text" class="form-control" id="form" name="form" value="{{ $drug->form }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $drug->code }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Drug</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
