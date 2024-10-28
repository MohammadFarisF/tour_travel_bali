<!-- app/Views/admin/destinasi_edit.php -->

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Edit Destinasi
                            </h1>
                            <div class="page-header-subtitle">Silakan ubah informasi di bawah ini untuk memperbarui destinasi.</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Form Edit Destinasi</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="formdata" action="<?= base_url(); ?>bali/destinasi/update" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="destination_id" class="form-label">Kode Destinasi</label>
                                    <input type="text" class="form-control" id="destination_id" name="destination_id" value="<?= esc($destinasi['destination_id']); ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="destination_name" class="form-label">Nama Destinasi</label>
                                    <input type="text" class="form-control" id="destination_name" name="destination_name" value="<?= esc($destinasi['destination_name']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= esc($destinasi['location']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control no-spinner" id="description" name="description" value="<?= esc($destinasi['description']); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="harga">Harga Destinasi</label>
                                    <input class="form-control" name="harga" id="harga" type="text" value="<?= 'Rp. ' . number_format($destinasi['harga'], 0, ',', '.'); ?>" onkeyup="formatHarga(this)" required />
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="<?= base_url(); ?>/bali/destinasi" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function formatHarga(input) {
            // menghilangkan semua karakter kecuali angka
            let harga = input.value.replace(/\D/g, '');

            // memformat angka sebagai harga
            harga = new Intl.NumberFormat('id-ID').format(harga);


            // menambahkan simbol euro pada depan harga
            input.value = 'Rp ' + harga;

            // jika nilai input kosong, isi dengan simbol euro dan spasi
            if (input.value === '') {
                input.value = 'Rp ';
            }
        }
    </script>