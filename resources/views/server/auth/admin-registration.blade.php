@extends('server.layouts.masterlayout')
@section('content')
<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Add Admin
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <form action="{{route('admin.store')}}" class="forms-sample" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="admin_name" value="{{old('admin_name')}}" placeholder="Admin Name">
                            @error('admin_name')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Designation</label>
                        <select name="designation" class="form-control" id="designation">
                            <option disabled selected>Select Admin Role</option>
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                        @error('designation')
                            {{ $message }}
                        @enderror
                    </div>
{{-- 
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Designation</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputMobile" name="designation" value="{{old('designation')}}" placeholder="Designation">
                            @error('designation')
                                {{$message}}
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" name="phone" value="{{old('phone')}}" placeholder="Phone Number">
                            @error('phone')
                                {{$message}}
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            @error('password')
                                {{$message}}
                            @enderror
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                {{$message}}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Add</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection