@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex">
                <h1>{{ Auth::user()->lang == 'en' ? 'Edit Employee Details' : 'Edit Detil Karyawan' }}</h1>
                <div class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('admin.companies.dashboard') }}">View Company</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <form action="{{route('admin.companies.employees.update', $employee->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        First Name
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="first_name" class="form-control" value="{{$employee->first_name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        Last Name
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="last_name" class="form-control" value="{{$employee->last_name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        Email
                    </label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control" value="{{$employee->email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        phone
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="phone" class="form-control" value="{{$employee->phone}}">
                    </div>
                </div>
                <button class="btn btn-primary float-right">{{ Auth::user()->lang == 'en' ? 'Edit Employee' : 'Edit Karyawan' }}</button>
            </form>
        </div>
    </div>
</div>

@endsection
