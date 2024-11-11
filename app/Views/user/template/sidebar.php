<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?> - Admin Explore Tour and Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/asset_admin/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/asset_user/img/title.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?= base_url() ?>" class="nav-item nav-link <?= (uri_string() == '') ? 'active' : '' ?>">
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
                <i data-feather="arrow-left" class="feather-icon-large-bold"></i>
            </button>
            Dashboard
        </a>


        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">

            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the lg breakpoint-->
            <li class="nav-item dropdown no-caret me-3 d-lg-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                    <form class="form-inline me-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= session()->userPhoto ? base_url('uploads/admin/' . session()->userPhoto) : base_url('asset_admin/assets/img/illustrations/profiles/profile-2.png') ?>" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="<?= session()->userPhoto ? base_url('uploads/customer/' . session()->userPhoto) : base_url('asset_admin/assets/img/illustrations/profiles/profile-2.png') ?>" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= session()->userName ?></div>
                            <div class="dropdown-user-details-email"><?= session()->userEmail ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url() ?>profile">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="<?= base_url() ?>logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sidenav-menu-heading"></div>
 <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?= (uri_string() == 'profile/my_account') ? 'active' : '' ?>" href="<?= base_url() ?>profile/my_account">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        My Account
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/my_booking') ? 'active' : '' ?>" href="<?= base_url() ?>profile/my_booking">
                        <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                        My Booking
                    </a>

                    <!-- Sidenav Accordion (Flows)-->
                    <a class="nav-link <?= (uri_string() == 'profile/payment') ? 'active' : '' ?>" href="<?= base_url() ?>profile/payment">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Payment
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/review') ? 'active' : '' ?>" href="<?= base_url() ?>profile/review">
                        <div class="nav-link-icon"><i data-feather="smile"></i></div>
                        Review
                    </a>

                    <a class="nav-link <?= (uri_string() == 'profile/invoice') ? 'active' : '' ?>" href="<?= base_url() ?>profile/invoice">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        Invoice
                    </a>

                    <!-- Sidenav Accordion (Components)-->
                </div>
            </div>
        </nav>
    </div>