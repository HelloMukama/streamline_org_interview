@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Lab Test') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('lab_tests.update', $labTest->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $labTest->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">{{ __('Duration') }}</label>
                            <input id="duration" type="number" class="form-control" name="duration" value="{{ $labTest->duration }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="result" class="form-label">{{ __('Result') }}</label>
                            <textarea class="form-control" id="result" name="result" rows="3">{{ $labTest->result }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update Lab Test') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
