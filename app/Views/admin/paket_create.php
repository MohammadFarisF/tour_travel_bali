<!-- app/Views/admin/paket_edit.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Tambah Paket
                            </h1>
                            <div class="page-header-subtitle">Silakan isi formulir di bawah ini untuk menambahkan paket baru.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Tambah Paket</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>/bali/paket/store" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Kode Paket</label>
                                    <input type="text" class="form-control" id="package_id" name="package_id" value="<?= $newPackageId; ?>" readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="package_name" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" id="package_name" name="package_name" placeholder="Masukkan Nama Paket..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="package_type" class="form-label">Tipe Paket</label>
                                    <select class="form-select" id="package_type" name="package_type" required>
                                        <option disable selected>Pilih Tipe Paket</option>
                                        <option value="single_destination" nam>Single Day</option>
                                        <option value="multiple_day" >Multiple Day</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi Paket..." required>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= base_url(); ?>bali/paket" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>