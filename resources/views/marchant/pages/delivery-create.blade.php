@extends('marchant.layouts.masterlayout')

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
                            </span> Add Parcel Delivery
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
                    
                    <form action="{{ route('delivery.store') }}" class="forms-sample" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                                    placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="order_tracking_id" value="{{ $numericValue }}">
                        <input type="hidden" name="user_id" value="{{ $id }}">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control" id="exampleInputMobile"
                                    placeholder="Mobile number" value="{{ old('phone') }}">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputPassword2"
                                    placeholder="Password" value="{{ old('address') }}">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Division</label>
                            <select name="divisions" class="form-control" id="divisions" onchange="divisionsList();">
                                <option disabled selected>Select Division</option>
                                <option value="Barishal">Barishal</option>
                                <option value="Chattogram">Chattogram</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Sylhet">Sylhet</option>
                            </select>
                            @error('divisions')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select District</label>
                            <select name="district" class="form-control" id="distr" onchange="thanaList();">

                            </select>
                            @error('district')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Police Station</label>
                            <select name="police_station" class="form-control" id="polic_sta">

                            </select>
                            @error('police_station')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Category Type</label>
                            <select name="category_type" class="form-control" id="category">
                                <option disabled selected>Select Category</option>
                                <option value="Regular">Regular</option>
                                <option value="Document">Document</option>
                                <option value="Book">Book</option>
                            </select>
                            @error('category_type')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Delevery Type</label>
                            <select name="delivery_type" class="form-control" id="delivery">
                                <option disabled selected>Delevery Type</option>
                                <option value="Drop">Drop</option>
                                <option value="Pickup & Drop">Pickup & Drop</option>
                            </select>
                            @error('delivery_type')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">COD Amount</label>
                            <div class="col-sm-9">
                                <input type="text" name="cod_amount" class="form-control"
                                    id="exampleInputConfirmPassword2" placeholder="COD Amount"
                                    value="{{ old('cod_amount') }}">
                                @error('cod_amount')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Invoice</label>
                            <div class="col-sm-9">
                                <input type="text" name="invoice" class="form-control"
                                    id="exampleInputConfirmPassword2" placeholder="Invoice"
                                    value="{{ old('invoice') }}">
                                @error('invoice')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <input type="text" name="note" class="form-control"
                                    id="exampleInputConfirmPassword2" placeholder="Note" value="{{ old('note') }}">
                                @error('note')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <input type="text" name="weight" class="form-control"
                                    id="exampleInputConfirmPassword2" placeholder="Weight" value="{{ old('weight') }}">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Exchange Parcel</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="exchange_parcel"
                                                id="membershipRadios1" value="Yes"> Yes </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="exchange_parcel"
                                                id="membershipRadios2" value="No"> No </label>
                                    </div>
                                </div>
                                @error('exchange_parcel')
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
    <script src="../marchant/js/address.js"></script>
    
@endsection
