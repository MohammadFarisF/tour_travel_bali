<!-- app/Views/admin/kendaraan_create.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Tambah Kendaraan
                            </h1>
                            <div class="page-header-subtitle">Silakan isi formulir di bawah ini untuk menambahkan kendaraan baru.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    <span>Form Tambah Kendaraan</span>
                </div>
                <div class="card-body">
                    <!-- Tampilkan pesan validasi jika ada -->
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('dashboard/kendaraan/store'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="vehicle_name" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('vehicle_name') ? 'is-invalid' : '' ?>" id="vehicle_name" name="vehicle_name" value="<?= set_value('vehicle_name') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('vehicle_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('vehicle_name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="license_plate" class="form-label">Nomor Plat</label>
                            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('license_plate') ? 'is-invalid' : '' ?>" id="license_plate" name="license_plate" value="<?= set_value('license_plate') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('license_plate')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('license_plate') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas Kendaraan</label>
                            <input type="number" class="form-control <?= isset($validation) && $validation->hasError('capacity') ? 'is-invalid' : '' ?>" id="capacity" name="capacity" value="<?= set_value('capacity') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('capacity')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('capacity') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">Tipe Kendaraan</label>
                            <select class="form-select <?= isset($validation) && $validation->hasError('vehicle_type') ? 'is-invalid' : '' ?>" id="vehicle_type" name="vehicle_type" required>
                                <option value="">-- Pilih Tipe Kendaraan --</option>
                                <option value="Mobil" <?= set_select('vehicle_type', 'Mobil') ?>>Mobil</option>
                                <option value="Motor" <?= set_select('vehicle_type', 'Motor') ?>>Motor</option>
                                <option value="Bus" <?= set_select('vehicle_type', 'Bus') ?>>Bus</option>
                                <option value="Truk" <?= set_select('vehicle_type', 'Truk') ?>>Truk</option>
                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                            </select>
                            <?php if (isset($validation) && $validation->hasError('vehicle_type')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('vehicle_type') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_photo" class="form-label">Foto Kendaraan</label>
                            <input class="form-control <?= isset($validation) && $validation->hasError('vehicle_photo') ? 'is-invalid' : '' ?>" type="file" id="vehicle_photo" name="vehicle_photo" accept="image/*">
                            <?php if (isset($validation) && $validation->hasError('vehicle_photo')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('vehicle_photo') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select <?= isset($validation) && $validation->hasError('status') ? 'is-invalid' : '' ?>" id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" <?= set_select('status', 'Aktif') ?>>Aktif</option>
                                <option value="Tidak Aktif" <?= set_select('status', 'Tidak Aktif') ?>>Tidak Aktif</option>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('status')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?= site_url('dashboard/kendaraan'); ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
