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
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Tambah Kendaraan</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>bali/kendaraan/store" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="vehicle_name" class="form-label">Nama Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" placeholder="Masukkan Nama Kendaraan..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="license_plate" class="form-label">Nomor Plat</label>
                                    <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="Masukkan Nomor Plat..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Kapasitas Penumpang</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control no-spinner" id="capacity" name="capacity" placeholder="Masukkan Kapasitas Penumpang..." min="1" required>
                                        <span class="input-group-text text-large"><b>Orang</b></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="vehicle_type" class="form-label">Tipe Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Masukkan Tipe Kendaraan..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="vehicle_photo" class="form-label">Foto Kendaraan</label>
                                    <input class="form-control" type="file" id="vehicle_photo" name="vehicle_photo" accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= base_url(); ?>/bali/kendaraan" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>