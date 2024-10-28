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
                    <?php if (session()->get('user_role') === 'owner'): ?>
                        <a href="<?= base_url(); ?>/bali/kendaraan/create" class="btn btn-primary">Tambah Kendaraan</a>
                    <?php endif; ?>
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
                                            <img src="<?= base_url('uploads/kendaraan/' . esc($vehicle['vehicle_photo'])); ?>" alt="Foto Kendaraan" style="width: 100px; height: auto;">
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
                                        <?php if (session()->get('user_role') === 'owner'): ?>
                                            <a href="<?php echo site_url('/bali/kendaraan/edit/' . $vehicle['vehicle_id']); ?>" class="btn btn-warning">Edit</a>
                                            <form action="<?php echo site_url('/bali/kendaraan/delete/' . $vehicle['vehicle_id']); ?>" method="post" style="display:inline;">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if (session()->get('user_role') === 'admin'): ?>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal" data-id="<?= $vehicle['vehicle_id']; ?>">
                                                Update Status
                                            </button>
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

    <!-- Modal untuk Update Status Kendaraan -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Status Kendaraan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('/bali/kendaraan/updatestatus/' . $vehicle['vehicle_id']); ?>" method="post">
                    <div class="modal-body">
                        <label for="status">Status:</label>
                        <select name="status" class="form-select">
                            <option value="available">Tersedia</option>
                            <option value="in_use">Sedang Digunakan</option>
                            <option value="maintenance">Pemeliharaan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusModal = document.getElementById('statusModal');
            statusModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const vehicleId = button.getAttribute('data-id');
                const form = statusModal.querySelector('form');
                form.action = `<?= site_url('/bali/kendaraan/updatestatus/'); ?>${vehicleId}`;
            });
        });
    </script>