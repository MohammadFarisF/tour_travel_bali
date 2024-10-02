<!-- app/Views/admin/destinasi_create.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Tambah Destinasi
                            </h1>
                            <div class="page-header-subtitle">Silakan isi formulir di bawah ini untuk menambahkan destinasi baru.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Tambah Destinasi</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>bali/destinasi/store" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="destination_id" class="form-label">Kode Paket</label>
                                    <input type="text" class="form-control" id="destination_id" name="destination_id" value="<?= $newDestinasiId; ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="destination_name" class="form-label">Nama Destinasi</label>
                                    <input type="text" class="form-control" id="destination_name" name="destination_name" placeholder="Masukkan Nama Destinasi..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Masukkan Lokasi Destinasi..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control no-spinner" id="description" name="description" placeholder="Masukkan Deskripsi Destinasi..." required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= base_url(); ?>/bali/destinasi" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>