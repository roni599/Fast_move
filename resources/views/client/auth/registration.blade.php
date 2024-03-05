<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fast Move</title>



    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/frontend/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/frontend/css/style.css" rel="stylesheet">




    <link href="/frontend/img/delivery-bike.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


<style>
    body {
        /* background: hsl(96, 68%, 88%); */
        display: flex;
        flex-direction: column;
        align-items: center;

    }

    .form-box {
        /* height: 450px; */
        background-color: white;
        padding: 10px;
        border-radius: 10px;
        position: absolute;
        margin: 150px 0;
        /* top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto; */
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

    }
</style>



<body>

    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0 bg-light">
        <nav class="navbar navbar-expand-lg px-4 px-lg-5 py-3 ">
            <a href="" class="navbar-brand p-0">
                <h2 class="m-0"><img src="frontend/img/delivery-bike.png" width="60">Fast Move</h2>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                    <a href="{{ route('service') }}" class="nav-item nav-link">Services</a>
                    <a href="{{ route('tracking') }}" class="nav-item nav-link">Tracking</a>
                    {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tracking</a>
                                <div class="dropdown-menu m-0">
                                    <a href="team.html" class="dropdown-item">Our Team</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="comparison.html" class="dropdown-item">Comparison</a>
                                </div>
                            </div> --}}
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                </div>
                <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal"
                    data-bs-target="#searchModal"><i class="fa fa-search"></i></button>

                <a href="{{ route('register') }}" class="btn btn-dark py-2 px-4 ms-3">Register</a>
                <a href="{{ route('login') }}" class="btn btn-dark py-2 px-4 ms-3">Login</a>


            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->



    <div class="form-box w-75">
        <div class="text-center mt-3">
            <img src="/frontend/img/delivery-bike.png" style="width: 70px" alt="logo" />
        </div>

        <h2 class="text-center mb-3">Become a Merchant</h2>

        <form action="{{ route('register') }}" method="post" class="text-center p-2 d-flex"
            enctype="multipart/form-data">
            @csrf

            <div class="w-50 left text-light">

                <input type="text" class="form-control w-75 mx-auto" name="business_name"
                    value="{{ old('business_name') }}" placeholder="Business Name">
                <span class="text-danger mb-3 d-block">
                    @error('business_name')
                        {{ $message }}
                    @enderror
                </span>


                <input type="text" class="form-control w-75 mx-auto" name="merchant_name"
                    value="{{ old('merchant_name') }}" placeholder="Merchant Name">
                <span class="text-danger mb-3 d-block">
                    @error('merchant_name')
                        {{ $message }}
                    @enderror
                </span>
                <select name="district" class="form-control" id="product_category">
                    <option value="Dhaka">From</option>
                    @foreach ($deliveryChargeData as $location)
                        <option value="{{ $location->from_location }}">{{ $location->from_location }}</option>
                    @endforeach
                </select>

                <input type="text" class="form-control w-75 mx-auto" name="pick_up_location"
                    value="{{ old('pick_up_location') }}" placeholder="Pick Up Location">
                <span class="text-danger mb-3 d-block">
                    @error('pick_up_location')
                        {{ $message }}
                    @enderror
                </span>

                <div class="d-flex">
                    <label for="nid_front" class="text-dark">NID Front</label>
                    <input type="file" class="form-control w-75 mx-auto" name="nid_front">
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('nid_front')
                        {{ $message }}
                    @enderror
                </span>

                <div class="d-flex">
                    <label for="nid_back" class="text-dark">NID Back</label>
                    <input type="file" class="form-control w-75 mx-auto" name="nid_back">
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('nid_back')
                        {{ $message }}
                    @enderror
                </span>

                <div class="mb-3">
                    <a href="/">Go to home</a>
                </div>
            </div>


            <div class="w-50 right text-light">

                <input type="phone" class="form-control w-75 mx-auto" name="phone" value="{{ old('phone') }}"
                    placeholder="Phone Number">
                <span class="text-danger mb-3 d-block">
                    @error('phone')
                        {{ $message }}
                    @enderror
                </span>

                <input type="email" class="form-control w-75 mx-auto" name="email" value="{{ old('email') }}"
                    placeholder="Email">
                <span class="text-danger mb-3 d-block">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>

                <input type="password" class="form-control w-75 mx-auto" name="password" placeholder="Password">
                <span class="text-danger mb-3 d-block">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>

                <input type="password" class="form-control w-75 mx-auto" name="password_confirmation"
                    placeholder="Confirm Password">
                <span class="text-danger mb-3 d-block">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </span>

                <div class="d-flex">
                    <label for="profile_img" class="text-dark">Profile Photo</label>
                    <input type="file" class="form-control w-75 mx-auto" name="profile_img">
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('profile_img')
                        {{ $message }}
                    @enderror
                </span>

                <button class="btn btn-success" type="submit">Registration</button>
            </div>




        </form>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
