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
    <link href="/frontend/css/registration.css" rel="stylesheet">

    <link href="/frontend/img/delivery-bike.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0 bg-light">
        <nav class="navbar navbar-expand-lg px-4 px-lg-5 py-3 ">
            <a href="" class="navbar-brand p-0">
                <h2 class="m-0"><img src="frontend/img/delivery-bike.png" width="60">Fast Move</h2>
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
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                </div>
                <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal"
                    data-bs-target="#searchModal"><i class="fa fa-search"></i></button>

                <a href="{{ route('register') }}" class="btn btn-dark py-2 px-4 ms-3">Register</a>
                <a href="{{ route('login') }}" class="btn btn-dark py-2 px-4 ms-3">Login</a>
            </div>
        </nav>
    </div>

    <div class="form-box  w-50">
        <div class="text-center mt-0">
            <img src="/frontend/img/delivery-bike.png" style="width: 70px" alt="logo" />
        </div>

        <h2 class="text-center mb-1">Become a Merchant</h2>
        <form action="{{ route('register') }}" method="post" class="text-center" enctype="multipart/form-data">
            @csrf
            <div class="input_content d-flex justify-content-center align-items-center">
                <div class="w-100 left text-light " id="content1">
                    <input type="text" class="form-control d-block mx-auto w-75" name="business_name"
                        value="{{ old('business_name') }}" placeholder="Business Name">
                    <span class="text-danger mb-2 d-block">
                        @error('business_name')
                            {{ $message }}
                        @enderror
                    </span>

                    <input type="text" class="form-control w-75 mx-auto" name="merchant_name"
                        value="{{ old('merchant_name') }}" placeholder="Merchant Name">
                    <span class="text-danger mb-2 d-block">
                        @error('merchant_name')
                            {{ $message }}
                        @enderror
                    </span>

                    <input type="phone" class="form-control w-75 mx-auto" name="phone" value="{{ old('phone') }}"
                        placeholder="Phone Number">
                    <span class="text-danger mb-2 d-block">
                        @error('phone')
                            {{ $message }}
                        @enderror
                    </span>

                    <input type="email" class="form-control w-75 mx-auto" name="email"
                        value="{{ old('email') }}" placeholder="Email">
                    <span class="text-danger mb-2 d-block">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>

                    <input type="password" class="form-control w-75 mx-auto" name="password" placeholder="Password">
                    <span class="text-danger mb-2 d-block">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>

                    <input type="password" class="form-control w-75 mx-auto" name="password_confirmation"
                        placeholder="Confirm Password">
                    <span class="text-danger mb-2 d-block">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="w-100 left text-light input_content" id="content2">
                    <select name="district" class="form-control w-75 mx-auto mb-2" id="product_category">
                        <option value="Dhaka">Select your District</option>
                        @foreach ($deliveryChargeData as $location)
                            <option value="{{ $location->from_location }}">{{ $location->from_location }}</option>
                        @endforeach
                    </select>
                    
                    @if($errors->has('district'))
                        <span class="text-danger mb-2 d-block">
                            {{ $errors->first('district') }}
                        </span>
                    @endif

                    <input type="text" class="form-control w-75 mx-auto mb-1" name="pickup_location"
                        placeholder="pickup_location">
                    <span class="text-danger mb-2 d-block">
                        @error('pickup_location')
                            {{ $message }}
                        @enderror
                    </span>

                    <div id="hiddenDiv" class="mb-1 ms-2">
                        <img id="selectedImage" src="/frontend/img/user.png" alt="Selected Image" width="150PX"
                            height="130px">
                    </div>
                    <div class="container text-center mb-2">
                        <i id="icon" class="" onclick="showImageInput()"></i>
                        <div class="d-flex justify-content-center">
                            <input type="file" name="profile_picture" id="fileInput" class="w-25 ms-5"
                                onchange="handleFileSelect()">
                        </div>
                    </div>
                    <span class="text-danger mb-2 d-block">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="w-100 left text-light input_content" id="content3">
                    <input class="form-control w-75 mx-auto text-center mb-1" placeholder="NID_Front_Part" readonly>
                    <div id="hiddenDivFront" class="mb-0 ms-2">
                        <img id="selectedImageFront" src="/frontend/img/front.jpg" alt="Selected Image"
                            width="150PX" height="70px">
                    </div>
                    <div class="container text-center mb-0">
                        <i id="fronticon" class="" onclick="frontshowImageInput()"></i>
                        <div class="d-flex justify-content-center">
                            <input type="file" name="frontNID" id="frontfileInput" class="w-25 ms-5"
                                onchange="fronthandleFileSelect()">
                        </div>
                    </div>
                    <span class="text-danger mb-1 d-block">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>

                    <input class="form-control w-75 mx-auto text-center mb-1" placeholder="NID_Backe_Part" readonly>
                    <div id="backhiddenDiv" class="mb-0 ms-2">
                        <img id="backselectedImage" src="/frontend/img/back.jpg" alt="Selected Image" width="150PX"
                            height="70px">
                    </div>
                    <div class="container text-center mb-1">
                        <i id="backicon" class="" onclick="backshowImageInput()"></i>
                        <div class="d-flex justify-content-center">
                            <input type="file" name="backNId" id="backfileInput" class="w-25 ms-5"
                                onchange="backhandleFileSelect()">
                        </div>
                    </div>
                    <span class="text-danger mb-1 d-block">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="submit_btn d-flex justify-content-end mt-2">
                <button class="btn btn-success" id="submit_btn" type="submit">Submit</button>
            </div>
        </form>
        <div class="button_content d-flex justify-content-end gap-5" id="button_content">
            <button type="button" class="btn btn-success" id="previous_btn"
                style="display: none;">Previous</button>
            <a href="" class="rr" id="link_home">Go To Home</a>
            <button type="button" class="btn btn-success" id="next_btn">Next</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        let next_btn = document.getElementById('next_btn');
        let previous_btn = document.getElementById('previous_btn');
        let submit_btn = document.getElementById('submit_btn');
        let link_home = document.getElementById('link_home');
        let button_content = document.getElementById('button_content');
        let contents = [
            document.getElementById('content1'),
            document.getElementById('content2'),
            document.getElementById('content3')
        ];
        let counter = 0;

        submit_btn.style.display = 'none';

        for (let i = 1; i < contents.length; i++) {
            contents[i].style.transition = 'left 0.5s ease';
            contents[i].style.left = '-800px';
            contents[i].style.display = 'none';
        }

        next_btn.addEventListener("click", function() {
            if (counter < contents.length - 1) {
                contents[counter].style.left = '-800px';
                contents[counter].style.opacity = '0';
                setTimeout(function() {
                    contents[counter].style.display = 'none';
                    counter++;
                    contents[counter].style.left = '0';
                    contents[counter].style.opacity = '1';
                    contents[counter].style.display = 'block';

                    if (counter === 1) {
                        previous_btn.style.display = 'block';
                        button_content.classList.add('justify-content-between');
                    }

                    if (counter === contents.length - 1) {
                        submit_btn.style.display = 'block';
                        next_btn.style.display = 'none';
                        previous_btn.style.marginTop = '-38px';
                        button_content.classList.add('justify-content-between');
                        link_home.classList.add('link_home');
                    }
                }, 500);
            }
        });

        previous_btn.addEventListener("click", function() {
            if (counter > 0) {
                contents[counter].style.left = '800px';
                contents[counter].style.opacity = '0';
                setTimeout(function() {
                    contents[counter].style.display = 'none';
                    counter--;
                    contents[counter].style.left = '0';
                    contents[counter].style.opacity = '1';
                    contents[counter].style.display = 'block';

                    if (counter === 0) {
                        previous_btn.style.display = 'none';
                        button_content.classList.remove('justify-content-between');
                    }
                    if (counter === contents.length - 2) {
                        submit_btn.style.display = 'none';
                        next_btn.style.display = 'block';
                        previous_btn.style.marginTop = '0';
                        link_home.style.marginTop = '0';
                        link_home.style.marginRight = '0';
                    }
                }, 500);
            }
        });
        if (submit_btn.style.display === 'block') {
            link_home.style.marginTop = '0';
            link_home.style.marginRight = '0';
        }
    </script>
    <script>
        function showImageInput() {
            var fileInput = document.getElementById('fileInput');
            fileInput.click();
        }

        function handleFileSelect() {
            var fileInput = document.getElementById('fileInput');
            var hiddenDiv = document.getElementById('hiddenDiv');
            var selectedImage = document.getElementById('selectedImage');

            if (fileInput.files && fileInput.files[0]) {
                selectedImage.src = URL.createObjectURL(fileInput.files[0]);
                hiddenDiv.style.display = 'block';
            }
        }

        function frontshowImageInput() {
            var frontfileInput = document.getElementById('frontfileInput');
            frontfileInput.click();
        }

        function fronthandleFileSelect() {
            var frontfileInput = document.getElementById('frontfileInput');
            var hiddenDivFront = document.getElementById('hiddenDivFront');
            var selectedImageFront = document.getElementById('selectedImageFront');

            if (frontfileInput.files && frontfileInput.files[0]) {
                selectedImageFront.src = URL.createObjectURL(frontfileInput.files[0]);
                hiddenDivFront.style.display = 'block';
            }
        }

        function backshowImageInput() {
            var backfileInput = document.getElementById('backfileInput');
            backfileInput.click();
        }

        function backhandleFileSelect() {
            var backfileInput = document.getElementById('backfileInput');
            var backhiddenDivFront = document.getElementById('backhiddenDiv');
            var backselectedImage = document.getElementById('backselectedImage');

            if (backfileInput.files && backfileInput.files[0]) {
                backselectedImage.src = URL.createObjectURL(backfileInput.files[0]);
                backhiddenDivFront.style.display = 'block';
            }
        }
    </script>
</body>

</html>
