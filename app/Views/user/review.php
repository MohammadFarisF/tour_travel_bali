<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Review
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content -->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Review Customer</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Total Harga</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($review as $ulasan): ?>
                                <tr>
                                    <td><?php echo esc($ulasan['booking_id']); ?></td>
                                    <td><?php echo esc($ulasan['package_name']); ?></td>
                                    <td><?php echo esc($ulasan['total_amount']); ?></td>
                                    <td><?php echo esc($ulasan['rating']); ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal"
                                            data-booking-id="<?= esc($ulasan['booking_id']); ?>"
                                            data-package-id="<?= esc($ulasan['package_id']); ?>">
                                            Review
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Submit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" action="<?= site_url('review/store'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="review_id" value=""> <!-- This will be generated automatically -->
                        <input type="hidden" name="booking_id" value=""> <!-- This will be filled automatically -->
                        <input type="hidden" name="package_id" value=""> <!-- This will be filled automatically -->

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <div>
                                <input type="radio" name="rating" value="1" required> 1
                                <input type="radio" name="rating" value="2"> 2
                                <input type="radio" name="rating" value="3"> 3
                                <input type="radio" name="rating" value="4"> 4
                                <input type="radio" name="rating" value="5"> 5
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="review_text">Review Text</label>
                            <textarea class="form-control" name="review_text" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="review_photo">Review Photo (optional)</label>
                            <input type="file" class="form-control-file" name="review_photo">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#reviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var bookingId = button.data('booking-id'); // Extract info from data-* attributes
                var packageId = button.data('package-id');

                var modal = $(this);
                modal.find('input[name="booking_id"]').val(bookingId); // Set booking_id
                modal.find('input[name="package_id"]').val(packageId); // Set package_id
                modal.find('input[name="review_id"]').val(''); // Optionally set review_id if needed
            });
        });
    </script>