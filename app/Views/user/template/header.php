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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


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
                    <a href="<?= base_url() ?>" class="nav-item nav-link <?= (uri_string() == '') ? 'active' : '' ?>">Home</a>
                    <a href="<?= base_url() ?>about" class="nav-item nav-link <?= (uri_string() == 'about') ? 'active' : '' ?>">About</a>
                    <a href="<?= base_url() ?>booking" class="nav-item nav-link <?= (uri_string() == 'booking') ? 'active' : '' ?>">Booking</a>
                    <a href="<?= base_url() ?>contact" class="nav-item nav-link <?= (uri_string() == 'contact') ? 'active' : '' ?>">Contact</a>



                    <!-- New Customer Profile Dropdown -->
                    <?php if (session()->get('userid')): // Cek apakah pengguna sudah login 
                    ?>
                        <?php if (session()->get('user_role') === 'customer'): // Jika peran adalah customer 
                        ?>
                            <!-- Dropdown untuk Customer -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle <?= (in_array(uri_string(), ['profile/change', 'profile/order_data', 'profile/review'])) ? 'active' : '' ?>" data-bs-toggle="dropdown">
                                     <i class="fas fa-user-circle" style="font-size: 30px;"></i> <!-- Ikon Profil -->
                                </a>
                                <div class="dropdown-menu m-0">
                                    <a href="<?= base_url() ?>profile/payment" class="dropdown-item <?= (uri_string() == 'profile/payment') ? 'active' : '' ?>">Payment</a>
                                    <a href="<?= base_url() ?>profile/order_data" class="dropdown-item <?= (uri_string() == 'profile/order_data') ? 'active' : '' ?>">Order Data</a>
                                    <a href="<?= base_url() ?>profile/review" class="dropdown-item <?= (uri_string() == 'profile/review') ? 'active' : '' ?>">Review</a>

                                    <!-- Logout Button -->
                                    <form action="<?= base_url() ?>logout/proses" method="post" class="dropdown-item p-0">
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