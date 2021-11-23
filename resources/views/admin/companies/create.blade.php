@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex">
                    <h1>Create Companies</h1>
                    <div class="ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btm-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('admin.companies.dashboard')}}">{{ Auth::user()->lang == 'en' ? 'View Dashboard' : 'Tampilkan Dashboard' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                    @if ($errors->count())
                        <div class="alert alert-danger">
                            <ul>
                                <li>@foreach ($errors->all() as $message)
                                    {{$message}}
                                @endforeach</li>
                            </ul>
                        </div>
                    @endif
                <form action="{{route('admin.companies.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Website</label>
                        <input type="text" class="form-control" name="website">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <button class="btn btn-primary float-right">{{ Auth::user()->lang == 'en' ? 'Create Companies' : 'Buat perusahaan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
