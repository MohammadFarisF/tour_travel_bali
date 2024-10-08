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
                <a href="<?= base_url() ?>" class="nav-item nav-link active">Home</a>
                <a href="<?= base_url() ?>about" class="nav-item nav-link">About</a>
                <a href="<?= base_url() ?>payment" class="nav-item nav-link">Payment</a>
                <a href="<?= base_url() ?>booking" class="nav-item nav-link">Booking</a>
                <a href="<?= base_url() ?>contact" class="nav-item nav-link active">Contact</a>
                
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

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Get In Touch</h5>
                    <p class="mb-4">If you have any complaints or input, please fill in the following form, thank you :)</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Office</h5>
                            <p class="mb-0">Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Mobile</h5>
                            <p class="mb-0">+62 822-3690-6042</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0">explorebali52@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/d/u/0/embed?mid=1FAiK8VckB_-cQtEWm8u7IahZvEE&hl=en&ie=UTF8&msa=0&t=h&ll=-8.450639000000017%2C115.13397199999999&spn=0.950856%2C1.167297&z=9&output=embed"
                        frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form onsubmit="sendWhatsAppMessage(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

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
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi8.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi2.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi6.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi5.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi4.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi3.jpeg" alt="">
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

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

    <!-- Custom Email Integration Script -->
    <script>
        function sendEmail(event) {
            event.preventDefault();
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var subject = document.getElementById('subject').value;
            var message = document.getElementById('message').value;

            var recipientEmail = 'explorebali52@gmail.com'; // Replace with your email address
            var mailSubject = encodeURIComponent(subject);
            var mailBody = encodeURIComponent(`Name: ${name}\nEmail: ${email}\n\nMessage:\n${message}`);

            var mailtoLink = `mailto:${recipientEmail}?subject=${mailSubject}&body=${mailBody}`;

            window.open(mailtoLink, '_self');
        }
    </script>

</body>

</html>