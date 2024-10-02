<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Data Kendaraan
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Kendaraan :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Kendaraan</span>
                    <!-- Button berada di ujung kanan -->
                    <a href="<?= base_url(); ?>/bali/kendaraan/create" class="btn btn-primary">Tambah Kendaraan</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nama Kendaraan</th>
                                <th>Nomor Plat</th>
                                <th>Kapasitas Kendaraan</th>
                                <th>Tipe Kendaraan</th>
                                <th>Foto Kendaraan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kendaraan as $vehicle): ?>
                                <tr>
                                    <td><?php echo esc($vehicle['vehicle_name']); ?></td>
                                    <td><?php echo esc($vehicle['license_plate']); ?></td>
                                    <td><?php echo esc($vehicle['capacity']); ?> Penumpang</td>
                                    <td><?php echo esc($vehicle['vehicle_type']); ?></td>
                                    <td>
                                        <?php if (!empty($vehicle['vehicle_photo'])): ?>
                                            <img src="<?= base_url('uploads/' . esc($vehicle['vehicle_photo'])); ?>" alt="Foto Kendaraan" style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($vehicle['status'] === 'available') {
                                            echo 'Tersedia';
                                        } elseif ($vehicle['status'] === 'in_use') {
                                            echo 'Sedang Digunakan';
                                        } elseif ($vehicle['status'] === 'maintenance') {
                                            echo 'Pemeliharaan';
                                        } else {
                                            echo esc($vehicle['status']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('/bali/kendaraan/edit/' . $vehicle['vehicle_id']); ?>" class="btn btn-warning">Edit</a>
                                        <form action="<?php echo site_url('/bali/kendaraan/delete/' . $vehicle['vehicle_id']); ?>" method="post" style="display:inline;">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>