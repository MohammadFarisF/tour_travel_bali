<?php
// Ambil informasi URL path untuk menentukan konten header
$currentRoute = service('uri')->getPath();

// Default values
$headerTitle = "My Account";
$subHeader = session()->get('userName') ?? 'my-account';

// Tentukan konten berdasarkan route
if ($currentRoute === 'profile/my_account') {
    $headerTitle = "My Account";
    $subHeader = session()->get('userName') ?? 'my-account';
} elseif ($currentRoute === 'profile/my_booking') {
    $headerTitle = "My Booking";
    $subHeader = "";
} elseif ($currentRoute === 'profile/review') {
    $headerTitle = "Review";
    $subHeader = ""; // Kosongkan username
} elseif ($currentRoute === 'profile/invoice') {
    $headerTitle = "Invoice";
    $subHeader = ""; // Kosongkan username
} elseif (strpos($currentRoute, 'profile/invoice-details/') === 0) {
    $headerTitle = "Invoice Details";
    $subHeader = strtoupper(str_replace('profile/invoice-details/', '#', $currentRoute)); // Ganti username dengan kode booking
}
?>

<div class="container-fluid bg-primary hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><?= $headerTitle ?></h1>
                <?php if ($subHeader): // Tampilkan subHeader jika tidak kosong 
                ?>
                    <p class="fs-4 text-white mb-4 animated slideInDown"><?= $subHeader ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sidenav-menu-heading"></div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?= (uri_string() == 'profile/my_account') ? 'active' : '' ?>" href="<?= base_url() ?>profile/my_account">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        <span class="nav-link-text">My Account</span>
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/my_booking') ? 'active' : '' ?>" href="<?= base_url() ?>profile/my_booking">
                        <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                        <span class="nav-link-text">My Booking</span>
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/review') ? 'active' : '' ?>" href="<?= base_url() ?>profile/review">
                        <div class="nav-link-icon"><i data-feather="thumbs-up"></i></div>
                        <span class="nav-link-text">Review</span>
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/invoice') ? 'active' : '' ?>" href="<?= base_url() ?>profile/invoice">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        <span class="nav-link-text">Invoice</span>
                    </a>

                    <!-- Sidenav Accordion (Components)-->
                </div>
            </div>
        </nav>
    </div>
    <script>
        feather.replace();
    </script>