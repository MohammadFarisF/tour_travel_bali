<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">CHANGE PASSWORD</h6>
        </div>
        <div class="row g-5">
            <div class="col-lg-7 mx-auto">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <form id="changePasswordForm" onsubmit="handleFormSubmit(event)">
                        <div class="row g-3">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="new-password" class="font-bold text-gray-700">New Password:</label>
                                    <input type="password" id="new-password" placeholder="Enter new password" class="form-input" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="confirm-password" class="font-bold text-gray-700">Confirm Password:</label>
                                    <input type="password" id="confirm-password" placeholder="Confirm new password" class="form-input" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button class="button button-book bg-blue-500 text-white px-6 py-2 rounded-md transition duration-200 hover:bg-blue-600" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-input {
        width: 100%;
        /* Pastikan input mengambil seluruh lebar */
        border: 1px solid #d1d5db;
        /* Border gray */
        border-radius: 0.375rem;
        /* Radius border */
        padding: 0.5rem 0.75rem;
        /* Padding vertikal dan horizontal */
        transition: border-color 0.2s;
        /* Transisi border */
    }

    .form-input:focus {
        border-color: #3b82f6;
        /* Border color saat fokus */
        outline: none;
        /* Hilangkan outline default */
    }
</style>

<script>
    function handleFormSubmit(event) {
        event.preventDefault();
        // Logika untuk mengganti password bisa ditambahkan di sini
        alert('Password has been changed successfully!'); // Contoh alert
    }
</script>