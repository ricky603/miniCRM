@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex">
                    <h1>{{ session()->get('locale') == 'en' ? 'Edit Company' : 'Edit Perusahaan' }} <small class="text-muted">{{ $company->name }}</small></h1>
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
                                    href="{{ route('admin.companies.show', ['company' => $company->id]) }}">{{ session()->get('locale') == 'en' ? 'Show Company' : 'Tampilkan Perusahaan' }}</a>
                                    <a href="#" class="dropdown-item text-danger" onclick="deleteCompany()">{{ session()->get('locale') == 'en' ? 'Delete Company' : 'Hapus Perusahaan' }}</a>
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
                        <hr>
                        <button class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#updateCompanyLogo">
                            {{ session()->get('locale') == 'en' ? 'New Company Logo' : 'Logo Baru' }}
                        </button>
                        <button class="btn btn-outline-primary btn-sm btn-block" onclick="deleteCompanyLogo()">
                            <i class="fas fa-trash"></i> {{ session()->get('locale') == 'en' ? 'Delete Company Logo' : 'Hapus Logo' }}
                            <form action="{{route('admin.companies.delete.company-logo', $company->id)}}" method="POST" id="delete-company-logo-form">
                                @csrf
                                @method('DELETE')
                            </form>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>{{ session()->get('locale') == 'en' ? 'Company Details' : 'Detil Perusahaan' }}</h5>
                        <hr>
                        @if ($errors->count())
                            <div class="alert alert-danger">
                                <ul>
                                    <li>
                                        @foreach ($errors->all() as $message)
                                            {{ $message }}
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.companies.update', ['company' => $company->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{ session()->get('locale') == 'en' ? 'Name' : 'Nama' }}</label>
                                <input type="text" class="form-control" name="name" value="{{$company->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$company->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Website</label>
                                <input type="text" class="form-control" name="website" value="{{$company->website}}">
                            </div>
                            <button class="btn btn-primary float-right">{{ session()->get('locale') == 'en' ? 'Update Company' : 'Update Perusahaan' }}</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1>{{ session()->get('locale') == 'en' ? 'Employee' : 'Karyawan' }}</h1>
                            <div class="ml-auto">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('admin.companies.employees.create', $company->id) }}">{{ session()->get('locale') == 'en' ? 'Add New Employee' : 'Tambah Karyawan Baru' }}</a>
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
                                                            <a href="#" class="dropdown-item text-danger" onclick="deleteEmployee()">{{ session()->get('locale') == 'en' ? 'Delete Employee' : 'Hapus Karyawan' }}</a>
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
    <div class="modal fade" id="updateCompanyLogo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ session()->get('locale') == 'en' ? 'Update Company Logo' : 'Update Logo Perusahaan' }}</h5>
                    <button type="button" clas="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.companies.update.company-logo', $company->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Choose an Image</label>
                        <input type="file" class="form-control-file" name="photo">
                    </div>
                    <button class="btn btn-primary float-right">{{ session()->get('locale') == 'en' ? 'Update Company Logo' : 'Update Logo Perusahaan' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        function deleteCompanyLogo() {
            var r = confirm("Are you sure you want to delete the company logo?")
            if (r) {
                document.querySelector('form#delete-company-logo-form').submit()
            }
        }

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
