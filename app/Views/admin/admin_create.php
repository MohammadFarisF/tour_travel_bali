<!-- app/Views/admin/admin_create.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Tambah Admin
                            </h1>
                            <div class="page-header-subtitle">Silakan isi formulir di bawah ini untuk menambahkan admin.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Tambah Admin</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>bali/admin/store" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">ID Admin</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $newIdUser; ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Nama Admin</label>
                                    <input type="text" class="form-control" id="ull_name" name="full_name" placeholder="Masukkan Nama Admin..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">No HP</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan Nomor HP..." required>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= base_url(); ?>/bali/admin" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>