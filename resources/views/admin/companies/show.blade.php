@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex">
                    <h1>Edit Company <small class="text-muted">{{ $company->name }}</small></h1>
                    <div class="ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('admin.companies.dashboard') }}">View
                                    Dashboard</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin.companies.edit', ['company'=> $company-> id]) }}">Edit
                                    Company</a>
                                    <a href="#" class="dropdown-item text-danger" onclick="deleteCompany()">Delete Employee</a>
                                    <form action="{{route('admin.companies.delete', ['company'=> $company-> id])}}" id="delete-company-form" style="display:none;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-body">
                        @if ($company->photo)
                            <img src="{{Storage::url($company->photo)}}" alt="" width="100">
                        @else
                            <img src="/images/user.png" width="100" alt="">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Edit Company Details</h5>
                        <hr>
                            <div class="form-group">
                                <label for="">Name</label>
                                <p>{{$company->name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <p>{{$company->email}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Website</label>
                                <p>{{$company->website}}</p>
                            </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1>Employees</h1>
                            <div class="ml-auto">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('admin.companies.employees.create', $company->id) }}">Add New Employee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        @if ($company->employee->count())
                            <table id="employee-table" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company->employee as $employee)
                                        <tr>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <div class="ml-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('admin.companies.employees.edit', ['employee'=> $employee-> id]) }}">Edit</a>
                                                            <a href="#" class="dropdown-item text-danger" onclick="deleteEmployee()">Delete Employee</a>
                                                            <form action="{{route('admin.companies.employees.delete', ['employee'=> $employee-> id])}}" id="delete-employee-form" style="display:none;" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        function deleteEmployee() {
            var r = confirm("Are you sure you want to delete this employee?")
            if (r) {
                document.querySelector('form#delete-employee-form').submit()
            }
        }
        function deleteCompany() {
            var r = confirm("Are you sure you want to delete this company?")
            if (r) {
                document.querySelector('form#delete-company-form').submit()
            }
        }
    </script>
         	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
             <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
             <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" defer></script>
            
                <script>
                    $(document).ready(function() {
                        $('#employee-table').DataTable()
                    });
            
                </script>
@endpush