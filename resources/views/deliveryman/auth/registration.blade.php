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
                <h2 class="m-0"><img src="/frontend/img/delivery-bike.png" width="60">Fast Move</h2>
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
                            <a href="{{route('tracking')}}" class="nav-item nav-link">Tracking</a>
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

        <h2 class="text-center mb-3">Become a Delivery Man</h2>

        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        <form action="{{route('deliveryman.store')}}" method="post" class="text-center p-2 d-flex" enctype="multipart/form-data">
            @csrf

            <div class="w-50 left text-light">

                <input type="text" class="form-control w-75 mx-auto" name="deliveryman_name"
                    value="{{ old('deliveryman_name') }}" placeholder="Deliveryman Name">
                <span class="text-danger mb-3 d-block">
                    @error('deliveryman_name')
                        {{ $message }}
                    @enderror
                </span>


                <input type="phone" class="form-control w-75 mx-auto" name="phone" value="{{ old('phone') }}"
                    placeholder="Phone Number">
                <span class="text-danger mb-3 d-block">
                    @error('phone')
                        {{ $message }}
                    @enderror
                </span>

                <input type="phone" class="form-control w-75 mx-auto" name="alt_phone" value="{{ old('alt_phone') }}"
                    placeholder="Alternative Phone Number">
                <span class="text-danger mb-3 d-block">
                    @error('alt_phone')
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

                <input type="text" class="form-control w-75 mx-auto" name="full_address" value="{{ old('full_address') }}"
                placeholder="Address">
                <span class="text-danger mb-3 d-block">
                    @error('full_address')
                        {{ $message }}
                    @enderror
                </span>

                <div class="mb-3">
                    <a href="/">Go to home</a>
                </div>
            </div>


            <div class="w-50 right text-light">

                <div class="form-group d-flex">
                    <label for="exampleFormControlSelect2" class="text-dark">Select Division</label>
                    <select name="division" class="form-control w-75 mx-auto" id="divisions" onchange="divisionsList();">
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
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('division')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group d-flex">
                    <label for="distr" class="text-dark">Select District</label>
                    <select name="district" class="form-control w-75 mx-auto" id="distr" onchange="thanaList();"></select>
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('district')
                        {{ $message }}
                    @enderror
                </span>

                <div class="form-group d-flex">
                    <label for="polic_sta"  class="text-dark">Select Police Station</label>
                    <select name="police_station" class="form-control w-75 mx-auto" id="polic_sta"></select>
                </div>
                <span class="text-danger mb-3 d-block">
                    @error('police_station')
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

                <button class="btn btn-success" type="submit">Registration</button>
            </div>




        </form>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="../marchant/js/address.js"></script>

</body>

</html>
