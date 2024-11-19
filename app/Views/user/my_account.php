<!-- Feather Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

<!-- Phone Input CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

<!-- Choices CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.min.css">

<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">


<!-- jQuery (required for Bootstrap Datepicker) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Required Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.min.js"></script>

<style>
    .account-info {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 20px;
        margin-top: 20px;
        text-align: left;
    }

    .info-item {
        border-bottom: 1px solid #dee2e6;
        padding: 10px 0;
        margin-left: 10px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .modal-title {
        margin-left: 10px;
    }

    .form-label {
        margin-left: 10px;
    }

    .iti {
        width: 100%;
    }

    .choices__inner {
        background-color: white;
    }

    .mt-n10 {
        margin-top: -6rem;
    }

    .pb-10 {
        padding-bottom: 6rem;
    }
</style>

<?php
// Ambil userName dari session
$userName = session()->get('userName') ?? 'my-account'; // Ganti 'my-account' dengan nilai default jika session tidak ada

// Buat ID yang disanitasi dari userName
$customerId = strtolower(str_replace(' ', '-', $userName));
?>


<div id="layoutSidenav_content">
    <header class="page-header page-header-light pb-10" id="<?= $customerId ?>">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1>
                            <div data-feather="user" style="height:50px; width:30px"></div>
                            My Account
                        </h1>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" style="width: 120px;" data-bs-toggle="modal" data-bs-target="#editAccountModal">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header-primary text-center">Account Information</div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img id="photoPreview" src="<?= isset($customer['photo']) ? base_url('uploads/customer/' . $customer['photo']) : base_url('asset_user/img/avatar-profile.jpg') ?>" alt="Profile Photo" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="account-info">
                        <div class="info-item">
                            <strong>Name:</strong> <?= $customer['full_name'] ?? '-' ?>
                        </div>
                        <div class="info-item">
                            <strong>NIK:</strong> <?= $customer['nik'] ?? '-' ?>
                        </div>
                        <div class="info-item">
                            <strong>Gender:</strong> <?= $customer['gender'] == 'laki-laki' ? 'Laki-Laki' : ($customer['gender'] == 'perempuan' ? 'Perempuan' : 'Tidak Ada') ?>
                        </div>
                        <div class="info-item">
                            <strong>Birth Date:</strong> <?= !empty($customer['tgl_lahir']) ? date('d F Y', strtotime($customer['tgl_lahir'])) : '-' ?>
                        </div>
                        <div class="info-item">
                            <strong>Email:</strong> <?= $customer['email'] ?? '-' ?>
                        </div>
                        <div class="info-item">
                            <strong>Phone Number:</strong> <?= $customer['phone_number'] ?? '-' ?>
                        </div>
                        <div class="info-item">
                            <strong>Citizenship:</strong> <?= $customer['citizen'] ?? '-' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Edit Account Modal -->
    <!-- Edit Account Modal -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">Edit Account Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('profile/update_account') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3 text-center">
                            <label for="accountPhoto" class="form-label">Profile Photo</label>
                            <div>
                                <img id="modalPhotoPreview" src="<?= isset($customer['photo']) ? base_url('uploads/customer/' . $customer['photo']) : base_url('asset_user/img/avatar-profile.jpg') ?>" alt="Profile Photo" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <input type="file" class="form-control" id="accountPhoto" name="accountPhoto" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="accountName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="accountName" name="accountName" value="<?= $customer['full_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="accountNIK" class="form-label">NIK / ID Number</label>
                            <input type="text" class="form-control" id="accountNIK" name="accountNIK" value="<?= $customer['nik'] ?>" <?= isset($customer['nik']) ? 'readonly' : '' ?> required>
                        </div>

                        <div class="mb-3">
                            <label for="accountGender" class="form-label">Gender</label>
                            <select class="form-select" id="accountGender" name="accountGender" required>
                                <option value="" disabled <?= !isset($customer['gender']) ? 'selected' : '' ?>>Select Gender</option>
                                <option value="laki-laki" <?= (isset($customer['gender']) && $customer['gender'] == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="perempuan" <?= (isset($customer['gender']) && $customer['gender'] == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                <option value="tidak ada" <?= (isset($customer['gender']) && $customer['gender'] == 'tidak ada') ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="accountBirthDate" class="form-label">Birth Date</label>
                            <input type="text" class="form-control" id="accountBirthDate" name="accountBirthDate" value="<?= $customer['tgl_lahir'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="accountEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="accountEmail" name="accountEmail" value="<?= $customer['email'] ?>" <?= isset($customer['email']) ? 'readonly' : '' ?> required>
                        </div>

                        <div class="mb-3">
                            <label for="accountPhone" class="form-label">Phone Number</label>
                            <input type="tel" id="accountPhone" name="accountPhone[full]" class="form-control" value="<?= $customer['phone_number'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="accountCitizen" class="form-label">Citizenship</label>
                            <select class="form-select" id="accountCitizen" name="accountCitizen" required>
                                <option value="<?= $customer['citizen'] ?>" selected><?= $customer['citizen'] ?? 'Select Citizenship' ?></option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize phone input
        const modalPhoneInput = document.querySelector("#accountPhone");
        var modalPhoneNumber = window.intlTelInput(modalPhoneInput, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            separateDialCode: true,
            initialCountry: "id",
            hiddeninput: "full",
            preferredCountries: ["id", "my", "sg"]
        });

        // When form is submitted, ensure the phone number includes country code
        $("form").submit(function() {
            var full_number = modalPhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164);
            $("input[name='accountPhone[full]'").val(full_number);
        });

        // Initialize date picker (Bootstrap Datepicker)
        $('#accountBirthDate').datepicker({
            format: 'dd MM yyyy', // Format tanggal
            autoclose: true, // Menutup kalender setelah memilih tanggal
            startDate: '01 January 1900', // Tanggal awal
            endDate: new Date() // Tanggal akhir (hari ini)
        });

        // Initialize Choices.js for citizenship selection
        // Inisialisasi Choices.js untuk dropdown kewarganegaraan
        const citizenSelect = document.getElementById('accountCitizen');
        const citizenChoices = new Choices(citizenSelect, {
            removeItemButton: true,
            searchEnabled: true,
            itemSelectText: ''
        });

        // Mengambil data negara dari API REST Countries
        fetch("https://restcountries.com/v3.1/all")
            .then(response => response.json())
            .then(data => {
                const countries = data.map(country => ({
                    value: country.name.common, // Kode negara 2 huruf (seperti "ID" untuk Indonesia)
                    label: country.name.common // Nama negara (seperti "Indonesia")
                }));

                // Menambahkan negara ke dropdown Choices.js
                citizenChoices.setChoices(countries, 'value', 'label', true);
            })
            .catch(error => console.error('Error fetching countries:', error));

        // Image preview for profile photo
        // Image preview for profile photo
        const accountPhotoInput = document.getElementById("accountPhoto");
        const modalPhotoPreview = document.getElementById("modalPhotoPreview");

        accountPhotoInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    modalPhotoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        window.addEventListener("load", function() {
            const customerId = "<?= $customerId ?>";
            document.getElementById(customerId)?.scrollIntoView({
                behavior: "smooth"
            });
        });
    </script>