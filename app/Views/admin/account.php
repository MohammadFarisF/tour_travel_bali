<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Account Settings - Profile
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture Preview</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img id="profilePicturePreview" class="img-account-profile rounded-circle mb-2" src="<?= base_url('uploads/admin/' . $user['photo']) ?>" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;" />
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG atau PNG, maksimal ukuran 5 MB</div>
                            <!-- Profile picture upload form-->
                            <form action="<?= base_url('bali/updateProfile') ?>" method="post" enctype="multipart/form-data">
                                <input type="file" name="photo" class="form-control mt-3" accept="image/png, image/jpeg" onchange="previewImage(event)" />
                                <p id="fileSizeError" class="text-danger mt-2" style="display: none;">Ukuran gambar tidak boleh lebih dari 5 MB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">Account Details
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                Ubah Password
                            </button>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('message')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('message') ?>
                                </div>
                            <?php elseif (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputfullname">Full Name</label>
                                <input class="form-control" id="inputfullname" type="text" name="full_name" value="<?= $user['full_name'] ?>" placeholder="Enter your fullname" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email" value="<?= $user['email'] ?>" disabled />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone_number" value="+62<?= substr($user['phone_number'], 1) ?>" placeholder="Enter your phone number" />
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputrole">User Role</label>
                                <input class="form-control" id="inputrole" type="text" value="<?= ($user['user_role'] === 'owner') ? 'SUPER ADMIN' : 'ADMIN' ?>" disabled />
                            </div>

                            <button class="btn btn-primary" type="submit">Save changes</button>
                            </form>

                            <!-- Button untuk membuka modal ubah password -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm" action="<?= base_url('bali/updatePassword') ?>" method="post">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Password Lama</label>
                                <input type="password" class="form-control" id="currentPassword" name="current_password" placeholder="Masukkan Password Lama..." required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Masukkan Password Baru..." required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirmNewPassword" name="confirm_new_password" placeholder="Masukkan Kembali Password Baru..." required>
                            </div>
                            <div class="text-danger" id="passwordError" style="display: none;">Password baru tidak boleh sama dengan password lama.</div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profilePicturePreview');
            const errorText = document.getElementById('fileSizeError');

            // Reset error message
            errorText.style.display = 'none';

            // Check file size (5 MB max)
            if (file.size > 5 * 1024 * 1024) {
                errorText.style.display = 'block';
                event.target.value = ""; // Clear the input file if size exceeds limit
                preview.src = "<?= base_url('uploads/user/' . $user['photo']) ?>"; // Revert to the current profile picture
                return;
            }

            // Display preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const errorText = document.getElementById('passwordError');

            if (currentPassword === newPassword) {
                e.preventDefault(); // Mencegah form submit jika password baru sama dengan yang lama
                errorText.style.display = 'block';
            } else {
                errorText.style.display = 'none';
            }
        });
    </script>