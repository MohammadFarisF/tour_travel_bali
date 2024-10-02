<!-- app/Views/admin/paket_edit.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="edit-2"></i></div>
                                Edit Paket
                            </h1>
                            <div class="page-header-subtitle">Silakan isi formulir di bawah ini untuk mengedit paket.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Edit Paket</div>
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form id="formdata" action="<?= base_url(); ?>bali/paket/update" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="package_id" value="<?= esc($package['package_id']) ?>">

                                    <div class="mb-3">
                                        <label for="package_name" class="form-label">Nama Paket</label>
                                        <input type="text" class="form-control" id="package_name" name="package_name" value="<?= esc($package['package_name']) ?>" placeholder="Masukkan Nama Paket..." required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="package_type" class="form-label">Tipe Paket</label>
                                        <select class="form-select" id="package_type" name="package_type" required>
                                            <option value="single_destination" <?= isset($package['package_type']) && $package['package_type'] === 'single_destination' ? 'selected' : ''; ?>>Single Day</option>
                                            <option value="multiple_day" <?= isset($package['package_type']) && $package['package_type'] === 'multiple_day' ? 'selected' : ''; ?>>Multiple Day</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="description" name="description" value="<?= esc($package['description']) ?>" placeholder="Masukkan Deskripsi Paket..." required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?= base_url(); ?>bali/paket" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
