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
                                    <label for="package_id" class="form-label">Nama Paket</label>
                                    <select class="form-control" id="package_id" name="package_id" required>
                                        <option value="" disabled selected>Pilih Nama Paket</option>
                                        <?php foreach ($packages as $package): ?>
                                            <option value="<?= $package['package_id']; ?>"><?= $package['package_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="destination_name" class="form-label">Nama Destinasi</label>
                                    <input type="text" class="form-control" id="destination_name" name="destination_name" placeholder="Masukkan Nama Destinasi..." required>
                                </div>

                                <div class="row gx-3 mb-3">

                                    <div class="col-md-6">
                                        <label class="form-label" for="latitude">Latitude</label>
                                        <input class="form-control" id="latitude" type="text" name="latitude" placeholder="Masukkan Titik Latitude" required />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="longitude">Longitude</label>
                                        <input class="form-control" id="longitude" type="text" name="longitude" placeholder="Masukkan Titik Longitude" required />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control no-spinner" id="description" name="description" placeholder="Masukkan Deskripsi Destinasi..." required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto[]" accept="image/*" multiple>
                                </div>

                                <div class="mb-3">
                                    <label for="harga">Harga Destinasi</label>
                                    <input class="form-control" name="harga" id="harga" type="text" value="Rp " onkeyup="formatHarga(this)" required />
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