<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Explore Tour & Travel Bali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="<?= base_url() ?>asset_user/img/title.png" type="image/png">

    <!-- Favicon -->
    <link href="<?= base_url() ?>asset_user/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>asset_user/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-40 px-lg-5 py-3 py-lg-0">
        <a href="#" class="navbar-brand d-flex align-items-center">
            <img class="fa img-fluid" src="<?= base_url() ?>asset_user/img/logobali.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="<?= base_url() ?>" class="nav-item nav-link">Home</a>
                <a href="<?= base_url() ?>about" class="nav-item nav-link">About</a>
                <a href="<?= base_url() ?>payment" class="nav-item nav-link active">Payment</a>
                <a href="<?= base_url() ?>booking" class="nav-item nav-link">Booking</a>
                <a href="<?= base_url() ?>contact" class="nav-item nav-link">Contact</a>
                
                <!-- New Customer Profile Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-cog"></i> <!-- Ikon Profil -->
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="<?= base_url() ?>profile/change" class="dropdown-item">Change Password</a>
                        <a href="<?= base_url() ?>profile/order_data" class="dropdown-item">Order Data</a>
                        <a href="<?= base_url() ?>profile/review" class="dropdown-item">Review</a>
                        <!-- Logout Button -->
                    <form action="<?= base_url() ?>logout" method="post" class="dropdown-item p-0">
                        <button type="submit" class="btn btn-danger w-100 text-start">Logout</button>
                    </form>

                    </div>
                </div>

                <span>
                    <div class="translate" id="google_translate_element"></div>
                    <script type="text/javaScript">
                        function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element'); }
                    </script>
                    <script type="text/javaScript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </span>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->


    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Vacation With Us</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Experience the magic of a holiday in Bali like you've never felt before!</p>
                    <div class="position-relative w-75 mx-auto animated slideInDown">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-road text-primary mb-4"></i>
                            <h5>Road To View</h5>
                            <p>Enjoy a stunning journey with beautiful views along the way. We present the best routes that show the stunning natural panorama of Bali. From enchanting beaches to towering mountains, every trip will be an unforgettable visual experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-map-marker-alt text-primary mb-4"></i>
                            <h5>Destination</h5>
                            <p>Discover the best destinations in Bali with us. We offer a wide selection of interesting tourist attractions, ranging from cultural, natural and culinary attractions. Each destination is carefully selected to provide the best experience and sweet memories while in Bali.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Profile Travel</h5>
                            <p>Get to know our travel services specifically designed to meet your various travel needs. With experience and dedication in the tourism industry, we are committed to providing the best service and ensuring every trip you take with us is a satisfying experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>Custom Itineraries</h5>
                            <p>We offer a travel plan creation service tailored to your wishes and needs. With our experience and in-depth local knowledge, we will help you design the perfect trip, including the best destinations, activities and accommodation options in Bali.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Alexander Johann Schmidt</h5>
                    <p>Germany</p>
                    <p class="mb-0">Our trip to Bali with ExploreTour & Travel Bali was one of the best holidays we have ever had. Every detail of the trip was arranged perfectly. We really enjoyed the tour to the Tegallalang Rice Terrace and snorkeling in Amed. Our tour guide was very knowledgeable and always helpful . The hotel chosen for us was very clean and comfortable, with very friendly staff. We will definitely return and recommend ExploreTour & Travel Bali to all our friends!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Isabella Sofia Rodríguez García</h5>
                    <p>Spain</p>
                    <p class="mt-2 mb-0">Many thanks to ExploreTour & Travel Bali for making our holiday in Bali so special! Everything is professionally arranged, from transportation to tours to beautiful destinations such as Besakih Temple and Jimbaran Beach. Our tour guide was very friendly and provided lots of interesting information about Balinese culture. The accommodation is very comfortable and has stunning views. We highly recommend ExploreTour & Travel Bali!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Jonathan Michael Williams</h5>
                    <p>USA</p>
                    <p class="mt-2 mb-0">Traveling to Bali with Explore Tour & Travel Bali is an amazing experience! Everything was very well organized, from airport pick up to daily tours to amazing places like Tanah Lot and Ubud. Our tour guide, was very friendly and informative. We also really enjoyed the snorkeling tour in Nusa Penida. Thank you for an unforgettable holiday!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Olivia Marie Johnson</h5>
                    <p>Italy</p>
                    <p class="mt-2 mb-0">Explore Tour & Travel Bali made our holiday in Bali truly magical! Everything was perfectly organized, from the warm welcome at the airport to the comprehensive tour. Highlights include sunset at Tanah Lot and cultural dance performances in Ubud. Our guides were great, shared a lot of knowledge and were always willing to help. Highly recommend Explore Tour & Travel Bali for the perfect holiday in Bali!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 822-3690-6042</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>explorebali52@gmail.com</p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi8.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi2.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi6.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi5.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi4.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url() ?>asset_user/img/dokumentasi3.jpeg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/wow/wow.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url() ?>asset_user/js/main.js"></script>
</body>

</html>