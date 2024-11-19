<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?>Explore Tour & Travel Bali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="<?= base_url() ?>asset_user/img/title.png" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Favicon -->
    <link href="<?= base_url() ?>asset_user/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>asset_user/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/asset_admin/css/styles.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/style.css" rel="stylesheet">

    <link href="<?= base_url() ?>asset_user/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<?php
// Ambil userName dari session
$userName = session()->get('userName') ?? 'my-account'; // Ganti 'my-account' dengan nilai default jika session tidak ada

// Buat ID yang disanitasi dari userName
$customerId = strtolower(str_replace(' ', '-', $userName));
?>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-40 px-lg-5 py-3 py-lg-1">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img class="fa img-fluid-navbar" src="<?= base_url() ?>asset_user/img/logobali.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="<?= base_url() ?>" class="nav-item nav-link <?= (uri_string() == '') ? 'active' : '' ?>">Home</a>
                    <a href="<?= base_url() ?>#paket" class="nav-item nav-link <?= (uri_string() == '#paket') ? 'active' : '' ?>">Paket</a>
                    <a href="<?= base_url() ?>about" class="nav-item nav-link <?= (uri_string() == 'about') ? 'active' : '' ?>">About</a>
                    <a href="<?= base_url() ?>contact" class="nav-item nav-link <?= (uri_string() == 'contact') ? 'active' : '' ?>">Contact</a>

                    <!-- New Customer Profile Dropdown -->
                    <?php if (session()->get('userid')): // Cek apakah pengguna sudah login 
                    ?>
                        <?php if (session()->get('user_role') === 'customer'): // Jika peran adalah customer 
                        ?>
                            <!-- Dropdown untuk Customer -->
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?= (in_array(uri_string(), ['profile/my_account', 'profile/my_booking', 'profile/review', 'profile/invoice'])) ? 'active' : '' ?>" aria-expanded="false" data-bs-toggle="dropdown" id="dropdownMenuLink">
                                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="<?= base_url() ?>profile/my_account#<?= $customerId ?>" class="dropdown-item <?= (uri_string() == 'profile/my_account') ? 'active' : '' ?>">My Account</a>
                                    <a href="<?= base_url() ?>profile/my_booking" class="dropdown-item <?= (uri_string() == 'profile/my_booking') ? 'active' : '' ?>">My Booking</a>
                                    <a href="<?= base_url() ?>profile/review" class="dropdown-item <?= (uri_string() == 'profile/review') ? 'active' : '' ?>">Review</a>
                                    <a href="<?= base_url() ?>profile/invoice" class="dropdown-item <?= (uri_string() == 'profile/invoice') ? 'active' : '' ?>">Invoice</a>
                                    <form action="<?= base_url() ?>logout" method="post" class="dropdown-item p-0">
                                        <button type="submit" class="btn btn-danger w-100 text-start">Logout</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: // Jika belum login 
                    ?>
                        <a href="<?= base_url('login') ?>" class="nav-item nav-link">Login</a>
                    <?php endif; ?>

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