@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('User Details') }}</div>

                    <div class="card-body">
                        <div>
                            <strong>Name:</strong> {{ $user->name }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div>
                            <strong>Role:</strong> {{ $user->role }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
