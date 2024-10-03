<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Edit Bank Travel
                            </h1>
                            <div class="page-header-subtitle">Silakan edit informasi bank travel di bawah ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Edit Bank Travel</div>
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>/bali/banktravel/update/<?= esc($banktravel['trabank_id']); ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Nomor Akun</label>
                                    <input type="number" class="form-control" id="account_number" name="account_number" value="<?= esc($banktravel['account_number']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="account_holder_name" class="form-label">Nama Pemegang Akun</label>
                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="<?= esc($banktravel['account_holder_name']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Nama Bank</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?= esc($banktravel['bank_name']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Foto Bank</label>
                                    <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                                    <!-- Tampilkan foto lama -->
                                    <img src="<?= base_url('uploads/' . esc($banktravel['photo'])); ?>" alt="Foto Bank" style="width: 100px;">
                                    <!-- Simpan nama foto lama jika tidak ada foto baru yang diunggah -->
                                    <input type="hidden" name="existing_photo" value="<?= esc($banktravel['photo']); ?>">
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="<?= base_url(); ?>/bali/banktravel" class="btn btn-secondary">Cancel</a>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
