<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/frontend/img/rocket.png" rel="icon">
    <title>Fast Move BD</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="/frontend/css/home.css" />
    <link rel="stylesheet" href="/frontend/css/google_translate_api.css" />

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="top-header">
            <span class="d-block"><i class="l-icon fa-solid fa-phone-volume"></i>+880-1723-456789</span>
            {{-- <span class="d-block text-white fw-bold"><i class="l-icon fa-solid fa-phone-volume"></i>{{ __('text.content00') }}</span> --}}
            <span class="d-block"><i class="l-icon fa-solid fa-envelope"></i>fastmovebd@gmail.com</span>
            {{-- <span class="d-block"><i class="l-icon fa-solid fa-envelope"></i>{{ __('text.content01') }}</span> --}}
        </div>
        <div class="header">
            <div class="logo">
                <div class="img">
                    <img src="/frontend/img/startup.png" alt="logo" />
                </div>
                <div class="text">
                    <span class="d-block head translate" data-en="Fast Move" data-bn="ফাস্ট মুভ"
                        data-ar="التحرك السريع">Fast Move</span>
                    {{-- <span class="d-block head">{{ __('text.content') }}</span> --}}
                    <span class="d-block moto">Perfect Way To Your Destination.</span>
                    {{-- <span class="d-block moto">{{ __('text.content1') }}</span> --}}
                </div>
            </div>

            <div class="nav-bar">
                <ul>
                    <li><a href="#">Home</a></li>
                    {{-- <li><a href="#">{{ __('text.content2') }}</a></li> --}}
                    <li><a href="#">About</a></li>
                    {{-- <li><a href="#">{{ __('text.content3') }}</a></li> --}}
                    <li><a href="#">Services</a></li>
                    {{-- <li><a href="#">{{ __('text.content4') }}</a></li> --}}
                    <li><a href="#">Tracking</a></li>
                    {{-- <li><a href="#">{{ __('text.content5') }}</a></li> --}}
                    <li><a href="#">Contact</a></li>
                    {{-- <li><a href="#">{{ __('text.content6') }}</a></li> --}}
                    {{-- <li>
                        <select class="form-control lang-change">
                            <option value="Select Language">Select Language</option>
                            <option value="en" {{ session()->get('lang_code') == 'en' ? 'selected' : '' }}>English
                            </option>
                            <option value="ar" {{ session()->get('lang_code') == 'ar' ? 'selected' : '' }}>عربي
                            </option>
                            <option value="bn" {{ session()->get('lang_code') == 'bn' ? 'selected' : '' }}>বাংলা
                            </option>
                        </select>
                    </li> --}}
                    <li>
                        <div id="google_translate_element"></div>
                    </li>
                </ul>
            </div>

            <div class="toggle-buttons">
                <button class="btn btn-light" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="mobile-nav">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Tracking</a></li>
                            <li><a href="#">Contact</a></li>
                            <li>
                                <button class="btn-grp orange-color">
                                    <i class="me-2 fa-solid fa-user-lock"></i>Login<i
                                        class="ms-2 fa-solid fa-caret-down"></i>
                                    {{-- <i class="me-2 fa-solid fa-user-lock"></i>{{ __('text.content7') }}<i
                                        class="ms-2 fa-solid fa-caret-down"></i> --}}

                                    <div class="sub-button">
                                        {{-- <a href="{{ route('admin.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Admin
                                            Login</a> --}}
                                        <a href="{{ route('login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Merchant Login</a>
                                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content10') }}</a> --}}
                                        <a href="{{ route('pickupman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Pickupman Login</a>
                                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content11') }}</a> --}}
                                        <a href="{{ route('deliveryman.login') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Deliveryman Login</a>
                                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content12') }}</a> --}}
                                    </div>
                                </button>
                            </li>
                            <li class="mt-3">
                                <button class="btn-grp black-color">
                                    <i class="me-2 fa-solid fa-user-pen"></i>Register<i
                                        class="ms-2 fa-solid fa-caret-down"></i>

                                    <div class="sub-button">
                                        <a href="{{ route('register') }}"><i
                                                class="fa-solid fa-chevron-right me-2"></i>Become a Merchant</a>
                                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content13') }}</a> --}}
                                        <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>Become a
                                            Pickupman</a>
                                        {{-- <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content14') }}</a> --}}
                                        <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>Become a
                                            Deliveryman</a>
                                        {{-- <a href="#"><i class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content15') }}</a> --}}
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="button-part">
                <button class="btn-grp orange-color">
                    {{-- <i class="me-2 fa-solid fa-user-lock"></i>{{ __('text.content7') }}<i class="ms-2 fa-solid fa-caret-down"></i> --}}
                    <i class="me-2 fa-solid fa-user-lock"></i>Login<i class="ms-2 fa-solid fa-caret-down"></i>

                    <div class="sub-button">
                        {{-- <a href="{{ route('admin.login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Admin Login</a> --}}
                        <a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right me-2"></i>Merchant
                            Login</a>
                        {{-- <a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content10') }}</a> --}}
                        <a href="{{ route('pickupman.login') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>Pickupman Login</a>
                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content11') }}</a> --}}
                        <a href="{{ route('deliveryman.login') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>Deliveryman Login</a>
                        {{-- class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content12') }}</a> --}}
                    </div>
                </button>

                <button class="btn-grp black-color">
                    <i class="me-2 fa-solid fa-user-pen"></i>Register<i class="ms-2 fa-solid fa-caret-down"></i>

                    <div class="sub-button">
                        <a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right me-2"></i>Become a
                            Merchant</a>
                        {{-- <a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right me-2"></i>{{ __('text.content13') }}</a> --}}
                        <a href="{{ route('pickupman.register') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>Become a Deliveryman</a>
                        <a href="{{ route('deliveryman.register') }}"><i
                                class="fa-solid fa-chevron-right me-2"></i>Become a Pickupman</a>
                    </div>
                </button>
            </div>
        </div>

        <!-- Navbar & Hero End -->

        <!-- Full Screen Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 40, 51, 0.8);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-light p-3"
                                placeholder="Type search keyword">
                            <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->


        @hasSection('content')
            @yield('content')
        @else
            <h1 style="text-align: center;">Here is no content...</h1>
        @endif


        <!-- Footer Start -->
        <div class="container-fluid bg-warning text-white footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row gy-5 gx-4 pt-5">
                    <div class="col-12">
                        <h5 class="fw-bold text-white mb-4">Subscribe Our Newsletter</h5>
                        <div class="position-relative" style="max-width: 400px;">
                            <input class="form-control bg-white border-0 w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Enter your email">
                            <button type="button"
                                class="btn btn-dark py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-white mb-4">About Us</h5>
                                <a class="btn btn-link" href="">About Us</a>
                                <a class="btn btn-link" href="">Contact Us</a>
                                <a class="btn btn-link" href="">Privacy Policy</a>
                                <a class="btn btn-link" href="">Terms & Condition</a>
                                <a class="btn btn-link" href="">Support</a>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold text-white mb-4">Our Services</h5>
                                <a class="btn btn-link" href="">Domain Register</a>
                                <a class="btn btn-link" href="">Shared Hosting</a>
                                <a class="btn btn-link" href="">VPS Hosting</a>
                                <a class="btn btn-link" href="">Dedicated Hosting</a>
                                <a class="btn btn-link" href="">Reseller Hosting</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="fw-bold text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Dhaka</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>quickexpress@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-lg-n5">
                        <div class="bg-light rounded" style="padding: 30px;">
                            <input type="text" class="form-control border-0 py-2 mb-2" placeholder="Name">
                            <input type="email" class="form-control border-0 py-2 mb-2" placeholder="Email">
                            <textarea class="form-control border-0 mb-2" rows="2" placeholder="Message"></textarea>
                            <button class="btn btn-dark w-100 py-2">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy;2024. First Move Logistics Ltd. All Right Reserved.

                            Designed By <a class="border-bottom text-decoration-none"
                                href="https:/mystrix.site">Mystrix</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i
                    class="bi bi-arrow-up"></i></a> --}}
    </div>

    <script>
        var botmanWidget = {
            // frameEndpoint: '/iFrameUrl'
            title: 'Fast Move Logistics',
            aboutText: 'Webappfix',
            introMessage: 'Hi, welcome to fastest logistics service Fast Move Logistics.'
        };
    </script>
    <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/lib/wow/wow.min.js"></script>
    <script src="frontend/lib/easing/easing.min.js"></script>
    <script src="frontend/lib/waypoints/waypoints.min.js"></script>
    <script src="frontend/lib/counterup/counterup.min.js"></script>
    <script src="frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="frontend/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                autoDisplay: 'true',
                includedLanguages: 'hi,en,bn,id,fr,ar',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');
        }
    </script>

</body>

</html>
