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
                <a href="<?= base_url() ?>payment" class="nav-item nav-link">Payment</a>
                <a href="<?= base_url() ?>booking" class="nav-item nav-link">Booking</a>
                <a href="<?= base_url() ?>contact" class="nav-item nav-link">Contact</a>
                
                <!-- New Customer Profile Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown active">
                        <i class="fas fa-cog"></i> <!-- Ikon Profil -->
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="<?= base_url() ?>profile/change" class="dropdown-item active">Change Password</a>
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

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">CHANGE PASSWORD</h6>
        </div>
        <div class="row g-5">
            <div class="col-lg-7 mx-auto">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <form id="changePasswordForm" onsubmit="handleFormSubmit(event)">
                        <div class="row g-3">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="new-password" class="font-bold text-gray-700">New Password:</label>
                                    <input type="password" id="new-password" placeholder="Enter new password" class="form-input" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="confirm-password" class="font-bold text-gray-700">Confirm Password:</label>
                                    <input type="password" id="confirm-password" placeholder="Confirm new password" class="form-input" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button class="button button-book bg-blue-500 text-white px-6 py-2 rounded-md transition duration-200 hover:bg-blue-600" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-input {
        width: 100%; /* Pastikan input mengambil seluruh lebar */
        border: 1px solid #d1d5db; /* Border gray */
        border-radius: 0.375rem; /* Radius border */
        padding: 0.5rem 0.75rem; /* Padding vertikal dan horizontal */
        transition: border-color 0.2s; /* Transisi border */
    }

    .form-input:focus {
        border-color: #3b82f6; /* Border color saat fokus */
        outline: none; /* Hilangkan outline default */
    }
</style>

<script>
    function handleFormSubmit(event) {
        event.preventDefault();
        // Logika untuk mengganti password bisa ditambahkan di sini
        alert('Password has been changed successfully!'); // Contoh alert
    }
</script>

<!-- End Change Password -->



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


</body>

</html>