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
                                        <option value="single_destination" <?= isset($package['package_type']) && $package['package_type'] === 'single_destination' ? 'selected' : ''; ?>>Single Destination</option>
                                        <option value="multiple_day" <?= isset($package['package_type']) && $package['package_type'] === 'multiple_day' ? 'selected' : ''; ?>>Multiple Day</option>
                                    </select>
                                </div>

                                <div id="days_input_container" style="display: none;">
                                    <div class="mb-3">
                                        <label for="day_count" class="form-label">Jumlah Hari</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="day_count" name="day_count" value="<?= esc($package['hari']) ?>" min="1" required>
                                            <span class="input-group-text text-large"><b>Hari</b></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="description" name="description" value="<?= esc($package['description']) ?>" placeholder="Masukkan Deskripsi Paket..." required>
                                </div>

                                <div class="mb-3">
                                    <label for="vehicle_photo" class="form-label">Foto Paket</label>
                                    <?php if (!empty($package['foto'])): ?>
                                        <img id="currentPreview" src="<?= base_url('uploads/paket/' . esc($package['foto'])); ?>" alt="Foto Paket" style="width: 100px; height: auto; display: block; margin-bottom: 10px;">
                                    <?php else: ?>
                                        <img id="currentPreview" src="#" alt="Foto Paket" style="width: 100px; height: auto; display: none; margin-bottom: 10px;">
                                    <?php endif; ?>
                                    <input type="hidden" name="foto_lama" value="<?= esc($package['foto']) ?>">
                                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                                    <img id="newPreview" src="#" alt="Preview Foto Baru" style="width: 100px; height: auto; display: none; margin-top: 10px;">
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

    <script>
        document.getElementById('package_type').addEventListener('change', function() {
            const packageType = this.value;
            const daysInputContainer = document.getElementById('days_input_container');
            const dayCountInput = document.getElementById('day_count');

            if (packageType === 'multiple_day') {
                // Show the input field for day count and make it required
                daysInputContainer.style.display = 'block';
                dayCountInput.setAttribute('required', 'required');
            } else {
                // Hide the input field for day count and remove the required attribute
                daysInputContainer.style.display = 'none';
                dayCountInput.removeAttribute('required');
            }
        });

        // Trigger change event on page load to initialize visibility based on the selected package type
        document.getElementById('package_type').dispatchEvent(new Event('change'));
    </script>
    <script>
        const fotoInput = document.getElementById('foto');
        const newPreview = document.getElementById('newPreview');
        const currentPreview = document.getElementById('currentPreview');

        fotoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    newPreview.src = e.target.result;
                    newPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);

                // Optional: Hide the current preview if a new file is selected
                currentPreview.style.display = 'none';
            } else {
                newPreview.style.display = 'none';
                currentPreview.style.display = 'block';
            }
        });
    </script>