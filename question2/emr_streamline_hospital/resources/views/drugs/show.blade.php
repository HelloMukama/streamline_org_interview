@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Drug Details') }}</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $drug->name }}</p>
                    <p><strong>Brand Name:</strong> {{ $drug->brand_name }}</p>
                    <p><strong>Description:</strong> {{ $drug->form }}</p>
                    <p><strong>Code:</strong> {{ $drug->code }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
