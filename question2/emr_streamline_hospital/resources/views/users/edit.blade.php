@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}</label>
                            <select class="form-select" id="role" name="role" required>
                                @foreach(['administrator', 'doctor', 'pharmacist', 'nurse', 'surgeon', 'lab_technician', 'senior_lab_technician'] as $role)
                                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
