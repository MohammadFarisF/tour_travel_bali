<?php
$currentURL = uri_string();
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sidenav-menu-heading"></div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?= ($currentURL === 'bali') ? 'active' : ''; ?>" href="<?= base_url() ?>bali">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                    </a>
                    <?php if (session()->getFlashdata('dilarang_masuk')) : ?>
                        <script>
                            alert('<?= session()->getFlashdata('dilarang_masuk') ?>');
                        </script>
                    <?php endif; ?>
                    <!-- Sidenav Heading (Custom)-->
                    <!-- Sidenav Accordion (Pages)-->
                    <?php if (session()->get('user_role') === 'owner'): ?>
                        <a class="nav-link collapsed <?= (str_contains($currentURL, 'admin') || str_contains($currentURL, 'customer')) ? 'active' : ''; ?>"
                            href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#collapseUser"
                            aria-expanded="<?= (str_contains($currentURL, 'admin') || str_contains($currentURL, 'customer')) ? 'true' : 'false'; ?>"
                            aria-controls="collapseUser">
                            <div class="nav-link-icon"><i data-feather="user"></i></div>
                            Manajemen Pengguna
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= (str_contains($currentURL, 'admin') || str_contains($currentURL, 'customer')) ? 'show' : ''; ?>"
                            id="collapseUser"
                            data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link <?= ($currentURL === 'bali/admin') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/admin">Admin</a>
                                <a class="nav-link <?= ($currentURL === 'bali/customer') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/customer">Customer</a>
                            </nav>
                        </div>
                    <?php endif; ?>
                    <a class="nav-link collapsed <?= (str_contains($currentURL, 'paket') || str_contains($currentURL, 'destinasi') || str_contains($currentURL, 'kendaraan')) ? 'active' : ''; ?>"
                        href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePaket"
                        aria-expanded="<?= (str_contains($currentURL, 'paket') || str_contains($currentURL, 'destinasi') || str_contains($currentURL, 'kendaraan')) ? 'true' : 'false'; ?>"
                        aria-controls="collapsePaket">
                        <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                        Manajemen Paket
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= (str_contains($currentURL, 'paket') || str_contains($currentURL, 'destinasi') || str_contains($currentURL, 'kendaraan')) ? 'show' : ''; ?>"
                        id="collapsePaket"
                        data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link <?= ($currentURL === 'bali/paket') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/paket">Paket</a>
                            <a class="nav-link <?= ($currentURL === 'bali/destinasi') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/destinasi">Destinasi</a>
                            <a class="nav-link <?= ($currentURL === 'bali/kendaraan') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/kendaraan">Kendaraan</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Flows)-->
                    <a class="nav-link collapsed <?= (str_contains($currentURL, 'booking') || str_contains($currentURL, 'payment') || str_contains($currentURL, 'refund')) ? 'active' : ''; ?>"
                        href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapseTransaction"
                        aria-expanded="<?= (str_contains($currentURL, 'booking') || str_contains($currentURL, 'payment') || str_contains($currentURL, 'refund')) ? 'true' : 'false'; ?>"
                        aria-controls="collapseTransaction">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Manajemen Transaksi
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= (str_contains($currentURL, 'booking') || str_contains($currentURL, 'payment') || str_contains($currentURL, 'refund')) ? 'show' : ''; ?>"
                        id="collapseTransaction"
                        data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link <?= ($currentURL === 'bali/booking') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/booking">Pemesanan</a>
                            <a class="nav-link <?= ($currentURL === 'bali/payment') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/payment">Pembayaran</a>
                            <a class="nav-link <?= ($currentURL === 'bali/refund') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/refund">Refund</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (UI Toolkit)-->
                    <?php if (session()->get('user_role') === 'owner'): ?>
                        <a class="nav-link collapsed <?= (str_contains($currentURL, 'banktravel')) ? 'active' : ''; ?>"
                            href="javascript:void(0);" data-bs-toggle="collapse"
                            data-bs-target="#collapseBank"
                            aria-expanded="<?= (str_contains($currentURL, 'banktravel')) ? 'true' : 'false'; ?>"
                            aria-controls="collapseBank">
                            <div class="nav-link-icon"><i data-feather="credit-card"></i></div>
                            Manajemen Bank
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= (str_contains($currentURL, 'banktravel')) ? 'show' : ''; ?>"
                            id="collapseBank"
                            data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link <?= ($currentURL === 'bali/banktravel') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/banktravel">Travel</a>
                            </nav>
                        </div>
                    <?php endif; ?>
                    <a class="nav-link <?= ($currentURL === 'bali/review') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/review">
                        <div class="nav-link-icon"><i data-feather="smile"></i></div>
                        Ulasan Pelanggan
                    </a>
                    <a class="nav-link <?= ($currentURL === 'bali/report') ? 'active' : ''; ?>" href="<?= base_url() ?>bali/report">
                        <div class="nav-link-icon"><i data-feather="printer"></i></div>
                        Laporan Transaksi
                    </a>

                    <!-- Sidenav Accordion (Components)-->
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?= session()->userName ?></div>
                    <div class="sidenav-footer-title"><?= $roleLabel; ?></div>
                </div>
            </div>
        </nav>
    </div>