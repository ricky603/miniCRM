@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex">
                <h1>{{ Auth::user()->lang == 'en' ? 'Create Employee Details' : 'Buat Detil Karyawan' }} <small class="text-muted">{{$company->name}}</small></h1>
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
            <form action="{{route('admin.companies.employees.store', $company->id)}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-md-3">
                    {{ Auth::user()->lang == 'en' ? 'First Name' : 'Nama Depan' }}
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="first_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                    {{ Auth::user()->lang == 'en' ? 'Last Name' : 'Nama Belakang' }}
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="last_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        Email
                    </label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                        Password
                    </label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">
                    {{ Auth::user()->lang == 'en' ? 'Phone' : 'Nomor Telepon' }}
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary float-right">{{ Auth::user()->lang == 'en' ? 'Create Employee' : 'Buat Karyawan' }}</button>
            </form>
        </div>
    </div>
</div>

@endsection
