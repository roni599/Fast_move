@extends('client.layouts.masterlayout')
@section('content')
<div class="container-xxl py-5 bg-warning hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 pt-5">
            <div class="col-12 text-center text-lg-start">
                {{-- <h1 class="display-4 text-white animated slideInLeft">TRACK YOUR CONSIGNMENT</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center justify-content-lg-start animated slideInLeft">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Domain</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-4 wow fadeInUp"
            data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Services</h1>
            <p class="mb-1">With a focus on speed and reliability, we guarantee swift transportation of your packages to their destination.</p>
        </div>
        <div class="row g-5 comparison position-relative">
            <div class="col-lg-6 pe-lg-5">
                <div class="section-title position-relative mx-auto mb-4 pb-4">
                    <h3 class="fw-bold mb-0">Regular Delivery</h3>
                </div>
                <div class="row gy-3 gx-5">
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-map-marker-alt fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">Tracking Facilities</h5>
                        <p>Track Status of your Products.</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-shield-alt fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">100% Secured</h5>
                        <p>Your security is our responsibility</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-cog fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">Control Panel</h5>
                        <p>Individual Dashborad Facilities</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-headset fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">24/7 Support</h5>
                        <p>Live support at any time.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <div class="dark-title position-relative mx-auto mb-4 pb-4">
                    <h3 class="fw-bold mb-0">Express Delivery</h3>
                </div>
                <div class="row gy-3 gx-5">
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-map-marker-alt fa-3x text-dark mb-3"></i>
                        <h5 class="fw-bold">Tracking Facilities</h5>
                        <p>Track Status of your Products.</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-shield-alt fa-3x text-dark mb-3"></i>
                        <h5 class="fw-bold">100% Secured</h5>
                        <p>Your security is our responsibility</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-cog fa-3x text-dark mb-3"></i>
                        <h5 class="fw-bold">Control Panel</h5>
                        <p>Individual Dashborad Facilities</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-headset fa-3x text-dark mb-3"></i>
                        <h5 class="fw-bold">24/7 Support</h5>
                        <p>Live support at any time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection