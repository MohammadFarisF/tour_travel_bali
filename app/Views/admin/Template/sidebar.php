<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sidenav-menu-heading"></div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link" href="<?= base_url() ?>bali">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                    </a>
                    <!-- Sidenav Heading (Custom)-->
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        Manajemen Pengguna
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUser" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url() ?>bali/admin">Admin</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/customer">Customer</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePaket" aria-expanded="false" aria-controls="collapsePaket">
                        <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                        Manajemen Paket
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePaket" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url() ?>bali/paket">Paket</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/destinasi">Destinasi</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/kendaraan">Kendaraan</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Flows)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTransaction" aria-expanded="false" aria-controls="collapseTransaction">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Manajemen Transaksi
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseTransaction" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url() ?>bali/booking">Pemesanan</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/payment">Pembayaran</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/refund">Refund</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (UI Toolkit)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseBank" aria-expanded="false" aria-controls="collapseBank">
                        <div class="nav-link-icon"><i data-feather="credit-card"></i></div>
                        Manajemen Bank
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseBank" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url() ?>bali/banktravel">Travel</a>
                            <a class="nav-link" href="<?= base_url() ?>bali/bankpelanggan">Pelanggan</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="<?= base_url() ?>bali/review">
                        <div class="nav-link-icon"><i data-feather="smile"></i></div>
                        Ulasan Pelanggan
                    </a>
                    <a class="nav-link" href="<?= base_url() ?>bali/report">
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