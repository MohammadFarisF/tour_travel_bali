<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
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
        <!-- Main page content -->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header text-center">Account Information</div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img id="photoPreview" src="default-avatar.png" alt="Profile Photo" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="account-info">
                        <div class="info-item">
                            <strong>Name:</strong> <span id="displayName">John Doe</span>
                        </div>
                        <div class="info-item">
                            <strong>Address:</strong> <span id="displayAddress">123 Main St, Cityville</span>
                        </div>
                        <div class="info-item">
                            <strong>Email:</strong> <span id="displayEmail">johndoe@example.com</span>
                        </div>
                        <div class="info-item">
                            <strong>Phone Number:</strong> <span id="displayPhone">123-456-7890</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountModalLabel">Edit Account Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAccountForm">
                    <div class="mb-3 text-center">
                        <label for="accountPhoto" class="form-label">Profile Photo</label>
                        <div>
                            <img id="modalPhotoPreview" src="default-avatar.png" alt="Profile Photo" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <input type="file" class="form-control" id="accountPhoto" accept="image/*" onchange="previewModalPhoto(event)">
                    </div>
                    <div class="mb-3">
                        <label for="accountName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="accountName" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="accountAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="accountAddress" placeholder="Enter your address">
                    </div>
                    <div class="mb-3">
                        <label for="accountEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="accountEmail" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="accountPhone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="accountPhone" placeholder="Enter your phone number">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="saveChanges()" data-bs-dismiss="modal">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview the uploaded profile photo in modal
    function previewModalPhoto(event) {
        const photoPreview = document.getElementById('modalPhotoPreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Save changes from modal and update display
    function saveChanges() {
        document.getElementById('displayName').innerText = document.getElementById('accountName').value;
        document.getElementById('displayAddress').innerText = document.getElementById('accountAddress').value;
        document.getElementById('displayEmail').innerText = document.getElementById('accountEmail').value;
        document.getElementById('displayPhone').innerText = document.getElementById('accountPhone').value;

        // Update profile photo if changed
        const modalPhotoPreview = document.getElementById('modalPhotoPreview').src;
        document.getElementById('photoPreview').src = modalPhotoPreview;
    }
</script>

<style>
    .account-info {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 20px;
        margin-top: 20px;
        text-align: left; /* Align text to the left */
    }

    .info-item {
        border-bottom: 1px solid #dee2e6;
        padding: 10px 0;
        margin-left: 10px; /* Add left margin for spacing */
    }

    .info-item:last-child {
        border-bottom: none; /* Remove border from the last item */
    }

    .page-header-title {
        margin-left: 10px; /* Add margin to the title */
    }

    .modal-title {
        margin-left: 10px; /* Add margin to the modal title */
    }

    .form-label {
        margin-left: 10px; /* Add margin to form labels */
    }
</style>
