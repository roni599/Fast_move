@extends('server.layouts.masterlayout')

@section('content')
    <div class="row">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Add Delivery Charge
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                            role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="fw-bold" data-bs-dismiss="alert" aria-label="Close">X</button>
                        </div>
                    @endif
                    {{-- <form action="{{ route('storeDeliveryCharge') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputEmail2" name="from"
                                    value="{{ old('from') }}">
                                @error('from')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="destination"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputPassword2" name="category"
                                    value="{{ old('category') }}">
                                @error('category')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Service_Regular</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_regular"
                                    value="{{ old('service') }}">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Service_Same_day</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_same_day"
                                    value="{{ old('service') }}">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Pickup</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="Pickup"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Pickup & Drop</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="Pickup_Drop"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control ms-2" name="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                    </form> --}}
                    <form action="{{ route('storeDeliveryCharge') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputEmail2" name="from"
                                    value="{{ old('from') }}" placeholder="Write The From Location Name">
                                @error('from')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="destination"
                                    value="{{ old('destination') }}" placeholder="Write The Destination Location Name">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputPassword2" name="category"
                                    value="{{ old('category') }}" placeholder="Write The Category Name">
                                @error('category')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Service Charge Of
                                Regular</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_regular"
                                    value="{{ old('service') }}" placeholder="Write Service Charge Of Regular">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Service Charge Of Same
                                Day</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control text-black" name="service_same_day"
                                    value="{{ old('service') }}" placeholder="Write Service Charge Of Same Day">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        {{-- pickup input --}}
                        {{-- <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Pickup</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="Pickup"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}

                        {{-- pickup & drop --}}
                        {{-- <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Pickup & Drop</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="Pickup_Drop"
                                    value="{{ old('destination') }}">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}

                        {{-- weight & price --}}
                        {{-- <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control ms-2" name="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div> --}}

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
