<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="activity"></i></div>
                                Dashboard
                            </h1>
                            <div class="page-header-subtitle">Hai <?= $roleLabel; ?>, Selamat Datang :)</div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">
                            <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                <div class="form-control ps-0" id="datepicker" style="pointer-events: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-2 col-xl-3 mb-4">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-100 small fw-bold">Perlu Konfirmasi Pembayaran</div>
                                    <div class="text-lg fw-bold"><?= esc($pendingPayments); ?></div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="calendar"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="<?= base_url() ?>bali/payment">Lihat Pembayaran</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-100 small fw-bold">Ketersediaan Kendaraan</div>
                                    <div class="text-lg fw-bold"><?= esc($availableVehicles); ?></div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="truck"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="<?= base_url() ?>bali/kendaraan">Lihat Kendaraan</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-100 small fw-bold">Refund Pending</div>
                                    <div class="text-lg fw-bold"><?= esc($pendingRefunds); ?></div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="<?= base_url() ?>bali/refund">Lihat Refund</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3 mb-4">
                    <div class="card bg-secondary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-100 small fw-bold">Penyelesaian Pemesanan</div>
                                    <div class="text-lg fw-bold"><?= esc($pendingTasks); ?></div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="check-circle"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="<?= base_url() ?>bali/booking">Lihat Pemesanan</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Example DataTable for Dashboard Demo-->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Paket Perjalanan</span>
                    <!-- Button berada di ujung kanan -->
                    <a href="<?= base_url() ?>bali/paket" class="btn btn-primary">Detail Paket</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Paket</th>
                                <th>Nama Paket</th>
                                <th>Tipe Paket</th>
                                <th>Deskripsi Paket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($packages) && is_array($packages)): ?>
                                <?php foreach ($packages as $package): ?>
                                    <tr>
                                        <td><?= esc($package['package_id']); ?></td>
                                        <td><?= esc($package['package_name']); ?></td>
                                        <td>
                                            <?php
                                            if ($package['package_type'] === 'single_destination') {
                                                echo 'Single Day';
                                            } elseif ($package['package_type'] === 'multiple_day') {
                                                echo 'Multiple Day';
                                            } else {
                                                echo esc($package['package_type']);
                                            }
                                            ?>
                                        </td>
                                        <td><?= substr(esc($package['description']), 0, strlen($package['description']) / 2); ?>...</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Destinasi</span>
                    <!-- Button berada di ujung kanan -->
                    <a href="<?= base_url() ?>bali/destinasi" class="btn btn-primary">Detail Destinasi</a>
                </div>
                <div class="card-body">
                    <table id="datatablesPaket">
                        <thead>
                            <tr>
                                <th>Kode Destinasi</th>
                                <th>Kode Paket</th>
                                <th>Nama Destinasi</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $destinasi): ?>
                                <tr>
                                    <td><?php echo esc($destinasi['destination_id']); ?></td>
                                    <td><?php echo esc($destinasi['package_id']); ?></td>
                                    <td><?php echo esc($destinasi['destination_name']); ?></td>
                                    <td><?php echo esc($destinasi['latitude'] . ', ' . $destinasi['longitude']); ?></td> <!-- Updated line -->
                                    <td><?php echo esc($destinasi['description']); ?></td>
                                    <td>
                                        <!-- Cek apakah ada foto -->
                                        <?php if (!empty($destinasi['foto'])): ?>
                                            <?php
                                            $photos = explode(',', $destinasi['foto']); // Mengambil semua foto jika ada lebih dari satu
                                            foreach ($photos as $photo):
                                            ?>
                                                <img src="<?= base_url('uploads/destinasi/' . $photo); ?>" alt="Foto Destinasi" style="width: 100px; height: auto;">
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            Tidak ada foto
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>