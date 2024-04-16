@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lab Test Details') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ $labTest->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Duration</th>
                                <td>{{ $labTest->duration }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Result</th>
                                <td>{{ $labTest->result ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Authenticated</th>
                                <td>
                                    @if($labTest->authenticated)
                                        <span class="badge bg-success">Authenticated</span>
                                    @else
                                        <span class="badge bg-danger">Not Authenticated</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if(auth()->user()->role === 'senior_lab_technician')
                        @if(!$labTest->authenticated)
                            <form action="{{ route('lab_tests.authenticate', $labTest) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Authenticate</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
