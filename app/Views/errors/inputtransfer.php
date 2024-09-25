<?= $this->extend('Template/template'); ?>
<?php $this->section('content') ?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="target"></i></div>
                        Error
                    </h1>
                    <div class="page-header-subtitle">Hai <?= session('username') ?> Selamat Datang Di Error Input Transfer Chelsea FC #KTBFFH :)</div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xxl px-4 mt-n10">
    <div class="col-xxl-12 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body h-100 p-5">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                            <div class="container-fluid px-4">
                                <div class="row g-3 my-4 text-center">
                                    <div class="col-12">
                                        <img class="img-fluid p-2 mx-auto" src="<?= base_url() ?>/assets/img/error.jpeg" alt="Chelsea Error" style="width: 600px;" />
                                    </div>
                                    <div class="col-12">
                                        <p class="lead">Terjadi Kesalahan, Nomor Punggung atau Nama yang Anda masukkan sudah dipakai.</p>
                                    </div>
                                    <div class="col-12">
                                        <a class="text-arrow-icon" style="align-items: center;" href="<?= base_url() ?>/transfer/input">
                                            <i class="ms-0 me-1" data-feather="arrow-left"></i>
                                            Kembali Ke Input Transfer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir row 1 -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>