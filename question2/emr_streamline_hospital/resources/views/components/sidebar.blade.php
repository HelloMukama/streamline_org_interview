<style>
    /* Example CSS to style the sidebar */
    .sidebar {
        width: 200px;
        background-color: #f3f4f6;
        padding: 20px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        margin-bottom: 10px;
    }

    .sidebar ul li a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
    }

    .sidebar ul li a:hover {
        background-color: #e2e8f0;
        color: #000;
    }

    .sidebar ul li a.active,
    .sidebar ul li a.active:hover {
        background-color: #e2e8f0; /* Gray background for selected item */
        color: #000000;
    }
</style>

<nav class="sidebar">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('patients.index') }}" class="{{ Request::is('patients*') ? 'active' : '' }}">Patients</a></li>
        <li><a href="{{ route('medical_records.index') }}" class="{{ Request::is('medical_records*') ? 'active' : '' }}">Medical Records</a></li>
        <li><a href="{{ route('lab_tests.index') }}" class="{{ Request::is('lab_tests*') ? 'active' : '' }}">Lab Tests</a></li>
        <li><a href="{{ route('medical_diagnoses.index') }}" class="{{ Request::is('medical_diagnoses*') ? 'active' : '' }}">Medical Diagnoses</a></li>
        <li><a href="{{ route('drugs.index') }}" class="{{ Request::is('drugs*') ? 'active' : '' }}">Drugs</a></li>
        <li><a href="{{ route('prescriptions.index') }}" class="{{ Request::is('prescriptions*') ? 'active' : '' }}">Prescriptions</a></li>
        <li><a href="{{ route('appointments.index') }}" class="{{ Request::is('appointments*') ? 'active' : '' }}">Appointments</a></li>
        <li><a href="{{ route('clinics.index') }}" class="{{ Request::is('clinics*') ? 'active' : '' }}">Clinics</a></li>
        <li><a href="{{ route('users.index') }}" class="{{ Request::is('users*') ? 'active' : '' }}">Users</a></li>
        <li><a href="{{ route('audit_logs.index') }}" class="{{ Request::is('audit_logs*') ? 'active' : '' }}">Audit Logs</a></li>

        <li><a href="{{ route('api_list') }}" class="{{ Request::is('api*') ? 'active' : '' }}">API Routes <span class="bd text text-danger">(DEV)</span></a></li>
    </ul>
</nav>
