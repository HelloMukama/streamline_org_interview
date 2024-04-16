@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Drug') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('drugs.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand_name" class="form-label">{{ __('Brand Name') }}</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ old('brand_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="form" class="form-label">{{ __('Form') }}</label>
                            <input type="text" class="form-control" id="form" name="form" value="{{ old('form') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">{{ __('Code') }}</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
