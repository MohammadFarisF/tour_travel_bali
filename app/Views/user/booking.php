    <div class="container-fluid bg-primary hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown"> Booking #<?= esc($booking['booking_id']); ?></h1>
                    <div class="position-relative w-75 mx-auto animated slideInDown"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-light">
                <div class="container-xl px-4">
                    <div class="pt-4">
                        <h1>
                            <div data-feather="briefcase" style="height:50px; width:30px"></div>
                            Booking Details: #<?= esc($booking['booking_id']); ?>
                        </h1>
                    </div>
                </div>
            </header>

            <!-- user/booking_details.php -->
            <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Card for Booking Details -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Booking Details</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Nama Paket:</strong> <?= esc($package['package_name']); ?></p>

                                    <p><strong>Destinasi</strong></p>
                                    <ul>
                                        <?php if (!empty($destinations)): ?>
                                            <?php foreach ($destinations as $destination): ?>
                                                <li><?= esc($destination['destination_name']); ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>-</li>
                                        <?php endif; ?>
                                    </ul>

                                    <p><strong>Alamat Penjemputan:</strong> <?= esc($booking['address']); ?></p>
                                    <p><strong>Total Peserta:</strong> <?= esc($booking['total_people']); ?> Orang</p>
                                    <p><strong>Tanggal Keberangkatan:</strong> <?= date('l, d F Y', strtotime($booking['departure_date'])); ?></p>
                                    <p><strong>Tanggal Kepulangan:</strong> <?= date('l, d F Y', strtotime($booking['return_date'])); ?></p>
                                    <p><strong>Request Pelanggan:</strong> <?= !empty($booking['cust_request']) ? esc($booking['cust_request']) : '-'; ?></p>
                                    <!-- Add this section where you want to display the vehicle details -->
                                    <?php if (!empty($vehicles)): ?>
                                        <h6>Kendaraan yang Digunakan :</h6> <!-- Judul untuk accordion -->
                                        <div class="accordion" id="vehicleAccordion">
                                            <?php foreach ($vehicles as $index => $vehicle): ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingVehicle<?= $index ?>">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVehicle<?= $index ?>" aria-expanded="false" aria-controls="collapseVehicle<?= $index ?>">
                                                            <?= esc($vehicle['vehicle_name']); ?>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseVehicle<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="headingVehicle<?= $index ?>" data-bs-parent="#vehicleAccordion">
                                                        <div class="accordion-body">
                                                            <img src="<?= base_url('uploads/kendaraan/' . esc($vehicle['vehicle_photo'])); ?>" alt="<?= esc($vehicle['vehicle_name']); ?>" style="max-width: 150px; margin-right: 10px; object-fit: contain;">
                                                            <p>No. Plat: <?= esc($vehicle['license_plate']); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Card for Customer Details -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Customer Details</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Nama:</strong> <?= esc($customer['full_name']); ?></p>
                                    <p><strong>Nomor Telepon:</strong> <?= esc($customer['phone_number']); ?></p>
                                    <p><strong>Email:</strong> <?= esc($customer['email']); ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <?php
                                // Hitung selisih hari antara tanggal keberangkatan dan tanggal saat ini
                                $departureDate = strtotime($booking['departure_date']);
                                $currentDate = time();
                                $daysBeforeDeparture = ($departureDate - $currentDate) / (60 * 60 * 24); // Menghitung selisih hari

                                if ($booking['booking_status'] === 'completed'): ?>
                                    <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>
                                <?php elseif ($booking['booking_status'] === 'cancelled'): ?>
                                    <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>
                                <?php elseif ($booking['payment_status'] === 'pending' && !empty($payment['proof_of_payment'])): ?>
                                    <!-- Jika sudah bayar tetapi belum dikonfirmasi admin -->
                                    <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>

                                <?php else: ?>
                                    <?php if ($daysBeforeDeparture > 7 && $booking['booking_status'] === 'confirmed'): ?>
                                        <form action="<?= base_url('booking/cancelBooking/' . esc($booking['booking_id'])) ?>" method="post" onsubmit="return confirm('Dana anda akan dikembalikan 100%. Apakah anda yakin ingin membatalkan pesanan ini?');">
                                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                                        </form>
                                        <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>
                                    <?php elseif ($daysBeforeDeparture > 3 && $booking['booking_status'] === 'confirmed'): ?>
                                        <form action="<?= base_url('booking/cancelBooking/' . esc($booking['booking_id'])) ?>" method="post" onsubmit="return confirm('Dana anda akan dikembalikan 50%. Apakah anda yakin ingin membatalkan pesanan ini?');">
                                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                                        </form>
                                        <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>
                                    <?php elseif ($daysBeforeDeparture <= 3 && $booking['booking_status'] === 'confirmed'): ?>
                                        <p class="text-danger">Anda tidak dapat membatalkan pesanan ini karena waktu keberangkatan kurang dari 3 hari.</p>
                                        <a href="<?= base_url('profile/my_booking') ?>" class="btn btn-secondary">Kembali</a>
                                    <?php else: ?>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" onclick="submitPayment()">Submit Pembayaran</button>
                                        <button class="btn btn-secondary" onclick="payLater()">Bayar Nanti</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Modal for Payment Submission -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Bank Details</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php foreach ($banks as $bank): ?>
                                            <li class="list-group-item d-flex align-items-center">
                                                <img src="<?= base_url('uploads/banktravel/' . esc($bank['photo'])); ?>" width="90" alt="<?= esc($bank['bank_name']); ?>" style="margin-right: 20px;">
                                                <div>
                                                    <h6><?= esc($bank['bank_name']); ?></h6>
                                                    <small><strong>Nama Pemegang Akun: </strong><?= esc($bank['account_holder_name']); ?></small><br>
                                                    <small><strong>Nomor Akun: </strong><?= esc($bank['account_number']); ?></small>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Subtotal</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $totalAmount = esc($booking['total_amount']); // Ambil total amount dari booking
                                    $totalDestinationPrice = 0; // Inisialisasi total harga destinasi

                                    // Iterasi melalui setiap destinasi
                                    foreach ($destinations as $destination) {
                                        $pricePerPerson = esc($destination['harga_per_orang']); // Ambil harga per orang untuk destinasi ini
                                        $numPeople = esc($booking['total_people']); // Ambil jumlah peserta
                                        $destinationTotalPrice = $pricePerPerson * $numPeople; // Hitung total harga untuk destinasi ini
                                        $totalDestinationPrice += $destinationTotalPrice; // Tambahkan ke total harga destinasi

                                        // Tampilkan informasi destinasi
                                        echo "<p>{$destination['destination_name']} - Rp " . number_format($pricePerPerson, 0, ',', '.') . " Per Orang</p>";
                                    }
                                    ?>

                                    <hr>

                                    <?php
                                    // Tampilkan total harga untuk setiap destinasi
                                    foreach ($destinations as $destination) {
                                        $pricePerPerson = esc($destination['harga_per_orang']); // Ambil harga per orang untuk destinasi ini
                                        $numPeople = esc($booking['total_people']); // Ambil jumlah peserta
                                        $destinationTotalPrice = $pricePerPerson * $numPeople; // Hitung total harga untuk destinasi ini

                                        // Tampilkan total harga untuk destinasi
                                        echo "<p>Rp " . number_format($pricePerPerson, 0, ',', '.') . " x " . esc($numPeople) . " Orang = Rp " . number_format($destinationTotalPrice, 0, ',', '.') . "</p>";
                                    }
                                    ?>

                                    <hr>
                                    <p><strong>Total Bayar Pemesanan:</strong> Rp <?= number_format($totalAmount, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        <!-- Modal for Payment Submission -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Submit Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="paymentForm" enctype="multipart/form-data" action="<?= base_url('payment/submit') ?>" method="POST" onsubmit="return submitPaymentForm(event)">
                        <div class="modal-body">
                            <!-- Hidden Booking ID -->
                            <input type="hidden" id="bookingId" name="booking_id" value="<?= esc($booking['booking_id']); ?>">

                            <!-- Transaction History Radio Buttons -->
                            <div class="mb-3">
                                <label class="form-label">Status Transaksi</label>
                                <div class="form-check">
                                    <input type="radio" id="everTransactedYes" name="transactionStatus" value="yes" class="form-check-input" disabled>
                                    <label class="form-check-label" for="everTransactedYes">Sudah Pernah Transaksi</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="everTransactedNo" name="transactionStatus" value="no" class="form-check-input" checked>
                                    <label class="form-check-label" for="everTransactedNo">Belum Pernah Transaksi</label>
                                </div>
                            </div>

                            <!-- Payment Method Selection -->
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                                <select id="paymentMethod" name="paymentMethod" class="form-select" required onchange="handlePaymentMethodChange()">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="e_wallet">E-Wallet</option>
                                </select>
                            </div>

                            <!-- Dynamic Account Holder Field -->
                            <div class="mb-3">
                                <label for="accountHolder" class="form-label">Nama Pemegang Akun</label>
                                <div id="accountHolderContainer">
                                    <input type="text" id="accountHolder" name="accountHolder" class="form-control" required>
                                </div>
                            </div>

                            <!-- Account Name -->
                            <div class="mb-3">
                                <label for="accountName" class="form-label">Nama Akun Bank/E-Wallet</label>
                                <input type="text" id="accountName" name="accountName" class="form-control" required>
                            </div>

                            <!-- Account Number -->
                            <div class="mb-3">
                                <label for="accountNumber" class="form-label">Nomor Rekening/Nomor E-Wallet</label>
                                <input type="text" id="accountNumber" name="accountNumber" class="form-control" required>
                            </div>

                            <!-- Transfer Amount -->
                            <div class="mb-3">
                                <label for="transferAmount" class="form-label">Jumlah Transfer</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" id="transferAmount" name="transferAmount" class="form-control"
                                        value="<?= number_format($booking['total_amount'], 0, ',', '.'); ?>" readonly>
                                </div>
                            </div>

                            <!-- Transfer Proof -->
                            <div class="mb-3">
                                <label for="transferProof" class="form-label">Bukti Transfer</label>
                                <input type="file" id="transferProof" name="transferProof" class="form-control" accept="image/*" required>
                                <small class="text-muted">Format: JPG, PNG, atau PDF. Maksimal 2MB</small>
                            </div>

                            <!-- Preview Image -->
                            <div class="mb-3 d-none" id="imagePreviewContainer">
                                <label class="form-label">Preview Bukti Transfer</label>
                                <div class="text-center">
                                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Submit Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function submitPayment() {
                const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                paymentModal.show();
                checkPaymentHistory();
            }

            function checkPaymentHistory() {
                const customerId = '<?= session()->get('userid') ?>';

                fetch(`getPaymentHistory/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        const radioYes = document.getElementById('everTransactedYes');
                        const radioNo = document.getElementById('everTransactedNo');

                        // Remove disabled state from both radio buttons
                        radioYes.disabled = false;
                        radioNo.disabled = false;

                        if (data.hasHistory) {
                            radioYes.checked = true;
                        } else {
                            radioNo.checked = true;
                        }

                        // Reset payment method and fields
                        const paymentMethod = document.getElementById('paymentMethod');
                        paymentMethod.value = '';
                        resetPaymentFields();

                        // Handle initial state
                        handleTransactionStatusChange();
                    });
            }

            // New function to handle transaction status change
            function handleTransactionStatusChange() {
                const isNewTransaction = document.getElementById('everTransactedNo').checked;
                const paymentMethodSelect = document.getElementById('paymentMethod');

                if (isNewTransaction) {
                    // Reset and enable all fields for new transaction
                    resetPaymentFields();
                    paymentMethodSelect.value = '';
                } else {
                    // Handle existing transaction logic
                    if (paymentMethodSelect.value) {
                        handlePaymentMethodChange();
                    }
                }
            }

            function handlePaymentMethodChange() {
                const paymentMethod = document.getElementById('paymentMethod').value;
                const isNewTransaction = document.getElementById('everTransactedNo').checked;
                const customerId = '<?= session()->get('userid') ?>';

                if (!isNewTransaction && paymentMethod) {
                    const accountHolderContainer = document.getElementById('accountHolderContainer');

                    fetch(`getPreviousPayments/${customerId}/${paymentMethod}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                // Create select element with previous payment data
                                const select = createAccountHolderSelect(data);
                                accountHolderContainer.innerHTML = '';
                                accountHolderContainer.appendChild(select);
                            } else {
                                resetPaymentFields();
                            }
                        });
                } else {
                    resetPaymentFields();
                }
            }

            function createAccountHolderSelect(data) {
                const selectWrapper = document.createElement('div');
                selectWrapper.className = 'select-wrapper position-relative';

                const select = document.createElement('select');
                select.id = 'accountHolder';
                select.name = 'accountHolder';
                select.className = 'form-select';
                select.required = true;

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Account Holder';
                select.appendChild(defaultOption);

                data.forEach(payment => {
                    const option = document.createElement('option');
                    option.value = JSON.stringify(payment);
                    option.textContent = payment.account_holder_name;
                    select.appendChild(option);
                });

                select.addEventListener('change', function() {
                    if (this.value) {
                        const selectedAccount = JSON.parse(this.value);
                        document.getElementById('accountName').value = selectedAccount.account_name;
                        document.getElementById('accountNumber').value = selectedAccount.account_number;
                    } else {
                        document.getElementById('accountName').value = '';
                        document.getElementById('accountNumber').value = '';
                    }
                });

                selectWrapper.appendChild(select);
                return selectWrapper;
            }

            function resetPaymentFields() {
                const accountHolderContainer = document.getElementById('accountHolderContainer');
                const accountName = document.getElementById('accountName');
                const accountNumber = document.getElementById('accountNumber');

                // Create new text input for account holder
                const input = document.createElement('input');
                input.type = 'text';
                input.id = 'accountHolder';
                input.name = 'accountHolder';
                input.className = 'form-control';
                input.required = true;
                input.placeholder = 'Enter Account Holder Name';

                // Replace existing element with text input
                accountHolderContainer.innerHTML = '';
                accountHolderContainer.appendChild(input);

                // Clear and enable all fields
                accountName.value = '';
                accountNumber.value = '';
                accountName.readOnly = false;
                accountNumber.readOnly = false;
            }

            // Add event listeners when document loads
            document.addEventListener('DOMContentLoaded', function() {
                // Add event listeners to radio buttons
                document.querySelectorAll('input[name="transactionStatus"]').forEach(radio => {
                    radio.addEventListener('change', handleTransactionStatusChange);
                });

                // Add event listener to payment method select
                document.getElementById('paymentMethod').addEventListener('change', handlePaymentMethodChange);

                // Initial setup
                const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

                document.getElementById('paymentModal').addEventListener('hidden.bs.modal', function() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                });
            });
            // Add this to your existing JavaScript code
            function submitPaymentForm(event) {
                event.preventDefault();

                const form = event.target;
                const accountHolderInput = document.getElementById('accountHolder');
                let accountHolderName;

                // Check if the input is a select element (for returning customers)
                if (accountHolderInput.tagName === 'SELECT') {
                    // If a value is selected, parse the JSON and get just the name
                    if (accountHolderInput.value) {
                        const selectedAccount = JSON.parse(accountHolderInput.value);
                        accountHolderName = selectedAccount.account_holder_name;
                    } else {
                        accountHolderName = '';
                    }
                } else {
                    // For new customers, just get the input value directly
                    accountHolderName = accountHolderInput.value;
                }

                // Create a new hidden input for the processed account holder name
                const processedNameInput = document.createElement('input');
                processedNameInput.type = 'hidden';
                processedNameInput.name = 'accountHolder';
                processedNameInput.value = accountHolderName;

                // Replace the original account holder input
                accountHolderInput.name = 'original_account_holder';
                form.appendChild(processedNameInput);

                // Submit the form
                form.submit();
                return true;
            }

            // Modify the createAccountHolderSelect function
            function createAccountHolderSelect(data) {
                const selectWrapper = document.createElement('div');
                selectWrapper.className = 'select-wrapper position-relative';

                const select = document.createElement('select');
                select.id = 'accountHolder';
                select.name = 'original_account_holder'; // Change the name to avoid conflict
                select.className = 'form-select';
                select.required = true;

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Account Holder';
                select.appendChild(defaultOption);

                data.forEach(payment => {
                    const option = document.createElement('option');
                    option.value = JSON.stringify(payment);
                    option.textContent = payment.account_holder_name;
                    select.appendChild(option);
                });

                select.addEventListener('change', function() {
                    if (this.value) {
                        const selectedAccount = JSON.parse(this.value);
                        document.getElementById('accountName').value = selectedAccount.account_name;
                        document.getElementById('accountNumber').value = selectedAccount.account_number;
                    } else {
                        document.getElementById('accountName').value = '';
                        document.getElementById('accountNumber').value = '';
                    }
                });

                selectWrapper.appendChild(select);
                return selectWrapper;
            }

            function payLater() {
                // Tampilkan pesan konfirmasi
                const confirmMessage = confirm("Anda memilih untuk membayar nanti. Apakah Anda yakin ingin melanjutkan?");

                if (confirmMessage) {
                    // Jika pengguna mengklik "OK", arahkan mereka ke halaman daftar paket atau halaman yang diinginkan
                    window.location.href = '<?= base_url('bali/#paket') ?>'; // Ganti dengan URL yang sesuai
                } else {
                    // Jika pengguna mengklik "Batal", tidak melakukan apa-apa
                    return;
                }
            }
        </script>