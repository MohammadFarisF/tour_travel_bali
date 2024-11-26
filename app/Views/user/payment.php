<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .status-label {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        /* Membuat bentuk melengkung */
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    /* Status Booking */
    .status-pending {
        background-color: #ffc107;
        /* Kuning */
    }

    .status-confirmed {
        background-color: #28a745;
        /* Hijau */
    }

    .status-cancelled {
        background-color: #dc3545;
        /* Merah */
    }

    .status-completed {
        background-color: #17a2b8;
        /* Biru */
    }

    /* Status Pembayaran */
    .payment-pending {
        background-color: #ffc107;
        /* Kuning */
    }

    .payment-paid {
        background-color: #28a745;
        /* Hijau */
    }

    .payment-refund {
        background-color: #6c757d;
        /* Abu-abu */
    }

    .payment-unknown {
        background-color: #343a40;
        /* Hitam */
    }

    .star {
        font-size: 30px;
        color: #d3d3d3;
        cursor: pointer;
    }

    .star.selected {
        color: #ffc107;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-light pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1>
                                <div data-feather="briefcase" style="height:50px; width:30px"></div>
                                Pemesanan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content -->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header-primary d-flex justify-content-between align-items-center">
                    <span>Data Pemesanan</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-black">
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Total Bayar</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td class="text-black"><?php if ($booking['booking_status'] === 'completed' && !$booking['review']): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>">
                                                #<?= $booking['booking_id']; ?>
                                            </a>
                                        <?php else: ?>
                                            #<?= $booking['booking_id']; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-black"><?= $booking['package_name']; ?></td>
                                    <td class="text-black">Rp <?= number_format($booking['total_amount'], 0, ',', '.'); ?></td> <!-- Format Total Bayar -->
                                    <td>
                                        <?php
                                        switch ($booking['booking_status']) {
                                            case 'pending':
                                                echo '<span class="status-label status-pending">Menunggu Konfirmasi</span>';
                                                break;
                                            case 'confirmed':
                                                echo '<span class="status-label status-confirmed">Pesanan Terkonfirmasi</span>';
                                                break;
                                            case 'cancelled':
                                                echo '<span class="status-label status-cancelled">Pesanan Dibatalkan</span>';
                                                break;
                                            case 'completed':
                                                echo '<span class="status-label status-completed">Trip Selesai</span>';
                                                break;
                                            default:
                                                echo '<span class="status-label status-unknown">Status Tidak Diketahui</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($booking['payment_status'] === 'pending' && !empty($booking['payment']['proof_of_payment'])) {
                                            echo '<span class="status-label payment-pending">Menunggu Konfirmasi</span>';
                                        } elseif ($booking['payment_status'] === 'pending') {
                                            echo '<span class="status-label payment-pending">Menunggu Pembayaran</span>';
                                        } elseif ($booking['payment_status'] === 'paid') {
                                            echo '<span class="status-label payment-paid">Sudah Dibayar</span>';
                                        } elseif ($booking['payment_status'] === 'refund_processed') {
                                            echo '<span class="status-label payment-refund">Proses Refund</span>';
                                        } else {
                                            echo '<span class="status-label payment-unknown">Status Tidak Diketahui</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-black">
                                        <?php if ($booking['booking_status'] === 'pending' && $booking['payment_status'] === 'pending' && !empty($booking['payment']['proof_of_payment'])): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>" class="btn btn-success">
                                                Detail
                                            </a>
                                        <?php elseif ($booking['booking_status'] === 'pending' && $booking['payment_status'] === 'pending'): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        <?php elseif ($booking['booking_status'] === 'confirmed' && $booking['payment_status'] === 'paid'): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>" class="btn btn-success">
                                                Detail
                                            </a>
                                        <?php elseif ($booking['booking_status'] === 'cancelled' && $booking['payment_status'] === 'refund_processed'): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>" class="btn btn-success">
                                                Detail
                                            </a>
                                        <?php elseif ($booking['booking_status'] === 'completed' && $booking['payment_status'] === 'paid' && !$booking['review']): ?>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#reviewModal" class="btn btn-warning text-white">
                                                Review
                                            </a>
                                        <?php elseif ($booking['review']): ?>
                                            <a href="<?= base_url('booking/' . esc($booking['booking_id'])) ?>" class="btn btn-success">
                                                Detail
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary" disabled>
                                                Tidak Tersedia
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal Review -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Tulis Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Review -->
                    <form action="<?= base_url('review/store'); ?>" method="post" enctype="multipart/form-data">
                        <!-- Booking ID (hidden) -->
                        <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

                        <!-- Rating (Bintang) -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" name="rating" id="rating">
                        </div>

                        <!-- Review Text -->
                        <div class="mb-3">
                            <label for="review_text" class="form-label">Tulis Review</label>
                            <textarea name="review_text" id="review_text" class="form-control" rows="4" required minlength="10"></textarea>
                        </div>

                        <!-- Foto Review (Opsional) -->
                        <!-- Foto Review (Opsional) -->
                        <div class="mb-3">
                            <label for="review_photo" class="form-label">Unggah Foto (Opsional)</label>
                            <input type="file" name="review_photo[]" id="review_photo" class="form-control" multiple>

                            <!-- Preview Gambar -->
                            <div id="preview-container" class="mt-3">
                                <!-- Preview gambar akan muncul di sini -->
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Kirim Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
    <script>
        document.querySelectorAll('.star').forEach(function(star) {
            star.addEventListener('click', function() {
                var rating = this.getAttribute('data-value');
                document.querySelectorAll('.star').forEach(function(star) {
                    star.classList.remove('selected');
                });
                for (var i = 0; i < rating; i++) {
                    document.querySelectorAll('.star')[i].classList.add('selected');
                }
                document.getElementById('rating').value = rating; // Set rating ke input hidden
            });
        });

        document.getElementById('review_photo').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Clear previous previews

            // Dapatkan file-file yang dipilih
            const files = event.target.files;

            // Loop untuk setiap file yang dipilih
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Pastikan file adalah gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Buat elemen gambar dan set sumbernya ke hasil pembacaan
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        img.style.maxWidth = '150px';
                        img.style.margin = '5px';

                        // Tambahkan gambar ke dalam preview container
                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file); // Membaca file sebagai URL
                }
            }
        });
    </script>