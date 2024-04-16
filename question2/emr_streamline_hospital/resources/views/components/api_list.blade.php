@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Endpoints List -->
        <div class="col-md-4">
            <div class="mt-4">
                <h2>System APIs</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>HTTP Method</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($api_list as $api)
                        <tr>
                            <td>{{ explode(' ', $api)[0] }}</td>
                            <td>{{ explode(' ', $api)[1] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Space -->
        <div class="col-md-2"></div>

        <!-- API Testing Form -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('API Testing Form (coming soon)') }}</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="method" class="form-label">Select HTTP Method:</label>
                            <select name="method" id="method" class="form-select">
                                <option value="GET" {{ old('method') == 'GET' ? 'selected' : '' }}>GET</option>
                                <option value="POST" {{ old('method') == 'POST' ? 'selected' : '' }}>POST</option>
                                <option value="PUT" {{ old('method') == 'PUT' ? 'selected' : '' }}>PUT</option>
                                <option value="PATCH" {{ old('method') == 'PATCH' ? 'selected' : '' }}>PATCH</option>
                                <option value="DELETE" {{ old('method') == 'DELETE' ? 'selected' : '' }}>DELETE</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">API Endpoint:</label>
                            <input type="text" name="url" id="url" class="form-control">
                        </div>
                        @if(old('method') !== 'GET' && old('method') !== 'DELETE')
                        <div id="attributesSection" style="display: none;">
                            <label for="attributes" class="form-label">Attributes:</label>
                            <div id="attributesFields">
                                <!-- Key-Value pair fields will be dynamically added here -->
                            </div>
                            <button type="button" id="addAttributeField" class="btn btn-secondary mt-2">Add Attribute</button>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary mt-3" disabled>Submit</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Direct Workspace URL -->
        <div class="col-md-10">
            <div class="mt-4">
                <p><a href="https://streamlineqns.postman.co/workspace/Team-Workspace~75f2df10-b5ac-4c44-8dbb-20b12c46e915/request/34217247-d5592133-2b5d-4fd5-8512-cad3ca3f92a9" target="_blank">
                    Click to Open Associated Workspace in Postman Client</a>
                </p>
            </div>
        </div>
        
        <!-- Direct Workspace invite URL -->
        <div class="col-md-10">
            <div class="mt-4">
                <p><a href="https://app.getpostman.com/join-team?invite_code=f621009feaa3c969e2f8684f307a163f&target_code=8c0bae99fecb0b322fbeb01637974fda" target="_blank">
                    Workspace invite link. Click to Open in Postman Client</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('method').addEventListener('change', function() {
        var method = this.value;
        var attributesSection = document.getElementById('attributesSection');
        if (method === 'POST' || method === 'PUT' || method === 'PATCH') {
            attributesSection.style.display = 'block';
        } else {
            attributesSection.style.display = 'none';
        }
    });

    document.getElementById('addAttributeField').addEventListener('click', function() {
        var attributesFields = document.getElementById('attributesFields');
        var attributeField = document.createElement('div');
        attributeField.classList.add('mb-3');
        attributeField.innerHTML = '<div class="row"><div class="col"><input type="text" name="keys[]" class="form-control" placeholder="Key"></div><div class="col"><input type="text" name="values[]" class="form-control" placeholder="Value"></div></div>';
        attributesFields.appendChild(attributeField);
    });
</script>
@endsection
