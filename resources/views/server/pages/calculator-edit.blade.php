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
                            </span> Update Delivery Charge
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
                    <form action="{{ route('storeDeliveryCharge') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputEmail2" name="from"
                                    value="{{$deliverycharge->from_location}}" placeholder="Write The From Location Name">
                                @error('from')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Destination</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputMobile" name="destination"
                                    value="{{$deliverycharge->destination}}" placeholder="Write The Destination Location Name">
                                @error('destination')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputPassword2" name="category"
                                    value="{{$deliverycharge->category}}" placeholder="Write The Category Name">
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
                                    value="{{$deliverycharge->regular}}" placeholder="Write Service Charge Of Regular">
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
                                    value="{{$deliverycharge->same_day}}" placeholder="Write Service Charge Of Same Day">
                                @error('service')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>







    {{-- 

<h1>Update Delivery Charge</h1>
    <form action="{{route('calculator.update', $calculator->id)}}" method="post">
        @csrf
        @method ('PUT')
        <br><label for="from">From</label>
        <input type="text" name="from" value="{{$calculator->from}}">

        <br><label for="destination">Destinationn</label>
        <input type="text" name="destination" value="{{$calculator->destination}}">

        <br><label for="category">Category</label>
        <input type="text" name="category" value="{{$calculator->category}}">

        <br><label for="service">Service</label>
        <input type="text" name="service" value="{{$calculator->service}}">
        
        <br><label for="weight">Weight</label>
        <input type="text" name="weight" value="{{$calculator->weight}}">

        <br><label for="price">Price</label>
        <input type="text" name="price" value="{{$calculator->price}}">

        <br><button type="submit">Update</button>
    </form> --}}
@endsection
