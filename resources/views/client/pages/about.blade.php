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
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title position-relative mb-4 pb-4">
                    <h1 class="mb-2">Welcome to Quick Express</h1>
                </div>
                <p class="mb-4">Welcome to Quick Express Delivery Service, where speed meets reliability! We
                    take pride in our lightning-fast delivery solutions that ensure your packages reach their
                    destination with unmatched efficiency. Our dedicated team is committed to providing a
                    seamless and secure delivery experience, backed by cutting-edge technology to track and
                    manage your shipments in real-time.</p>
                <div class="row g-3">
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-users-cog fa-2x text-warning mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">70</h2>
                            <p class="mb-0">Branches</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-users fa-2x text-warning mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">234</h2>
                            <p class="mb-0">Clients</p>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-check fa-2x text-warning mb-2"></i>
                            <h2 class="mb-1" data-toggle="counter-up">2647</h2>
                            <p class="mb-0">Coverage Area</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <img class="img-fluid wow zoomIn" width="70%" data-wow-delay="0.5s" src="/frontend/img/fast-delivery.png">
            </div>
        </div>
    </div>
</div>
@endsection