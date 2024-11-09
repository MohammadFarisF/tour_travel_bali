<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?> - Explore Tour & Travel Bali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="<?= base_url() ?>asset_user/img/title.png" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Favicon -->
    <link href="<?= base_url() ?>asset_user/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>asset_user/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/style.css" rel="stylesheet">
    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-40 px-lg-5 py-3 py-lg-0">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img class="fa img-fluid" src="<?= base_url() ?>asset_user/img/logobali.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="<?= base_url() ?>" class="nav-item nav-link <?= (uri_string() == '') ? 'active' : '' ?>">Home</a>
                    <a href="<?= base_url() ?>about" class="nav-item nav-link <?= (uri_string() == 'about') ? 'active' : '' ?>">About</a>
                    <a href="<?= base_url() ?>booking" class="nav-item nav-link <?= (uri_string() == 'booking') ? 'active' : '' ?>">Booking</a>
                    <a href="<?= base_url() ?>contact" class="nav-item nav-link <?= (uri_string() == 'contact') ? 'active' : '' ?>">Contact</a>

                    <!-- New Customer Profile Dropdown -->
                    <?php if (session()->get('userid')): ?>
                        <?php if (session()->get('user_role') === 'customer'): ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle <?= (in_array(uri_string(), ['profile/change', 'profile/order_data', 'profile/review'])) ? 'active' : '' ?>" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                                </a>
                                <div class="dropdown-menu m-0">
                                    <a href="<?= base_url() ?>profile/my_account" class="dropdown-item <?= (uri_string() == 'profile/my_account') ? 'active' : '' ?>">My Account</a>
                                    <a href="<?= base_url() ?>profile/my_booking" class="dropdown-item <?= (uri_string() == 'profile/my_booking') ? 'active' : '' ?>">My Booking</a>
                                    <a href="<?= base_url() ?>profile/review" class="dropdown-item <?= (uri_string() == 'profile/review') ? 'active' : '' ?>">Review</a>
                                    <a href="<?= base_url() ?>profile/invoice" class="dropdown-item <?= (uri_string() == 'profile/invoice') ? 'active' : '' ?>">Invoice</a>
                                    <form action="<?= base_url() ?>logout/proses" method="post" class="dropdown-item p-0">
                                        <button type="submit" class="btn btn-danger w-100 text-start">Logout</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="nav-item nav-link">Login</a>
                    <?php endif; ?>

                    <span>
                        <div class="translate" id="google_translate_element"></div>
                        <script type="text/javaScript">
                            function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element'); }
                        </script>
                        <script type="text/javaScript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

    <div class="container-fluid bg-primary py-5 mb-5 hero-header" style="background-image: url('<?= base_url('uploads/paket/' . esc($package['foto'])); ?>'); background-size: cover; background-position: center;">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown"><?= esc($package['package_name']); ?></h1>
                    <div class="position-relative w-75 mx-auto animated slideInDown"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="package"></i></div>
                            Package Details: <?= esc($package['package_name']); ?>
                        </h1>
                    </div>
                </div>
            </header>

            <div class="container-xl px-4 mt-n10">
                <div class="row mb-4">
                    <div class="col-md-4"><strong>Type:</strong> <?= esc($package['package_type'] === 'single_destination' ? 'Single Day' : ($package['package_type'] === 'multiple_day' ? 'Multiple Day' : $package['package_type'])); ?></div>
                    <div class="col-md-4"><strong>Number of Destinations:</strong> <?= count($destinations); ?></div>
                    <div class="col-md-4"><strong>District:</strong> <?= esc($destinations[0]['district'] ?? 'Unknown'); ?></div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <!-- Card for Package Details -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3>Description</h3>
                                <p><?= esc($package['description']); ?></p>

                                <h3>Destinations</h3>
                                <div class="accordion" id="destinationAccordion">
                                    <?php foreach ($destinations as $index => $destination): ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false">
                                                    <?= esc($destination['destination_name']); ?> - Rp <?= number_format(esc($destination['harga_per_orang']), 0, ',', '.'); ?> Per Orang
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#destinationAccordion">
                                                <div class="accordion-body">
                                                    <p><?= esc($destination['description']); ?></p>
                                                    <p><strong>District:</strong> <?= esc($destination['district']); ?></p>
                                                    <?php
                                                    // Assuming the image path is stored in a field like 'foto'
                                                    $photos = explode(',', $destination['foto']); // If multiple images, split by comma
                                                    if (count($photos) > 0):
                                                    ?>
                                                        <div class="destination-images">
                                                            <?php foreach ($photos as $photo): ?>
                                                                <img src="<?= base_url('uploads/destinasi/' . esc(trim($photo))); ?>" alt="Destination Image" style="max-width: 150px; margin-right: 10px; object-fit: contain;">
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <h3>Photo Gallery</h3>
                                <?php
                                // Get all images associated with the destinations
                                $allPhotos = [];
                                foreach ($destinations as $destination) {
                                    // Split the images for each destination if there are multiple (comma-separated)
                                    $photos = explode(',', $destination['foto']);
                                    $allPhotos = array_merge($allPhotos, $photos); // Merge them all into one array
                                }

                                // Check if there are images available
                                if (count($allPhotos) > 0): ?>
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($allPhotos as $index => $photo): ?>
                                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                    <img src="<?= base_url('uploads/destinasi/' . esc(trim($photo))); ?>" class="d-block w-100" alt="Destination Image" style="object-fit: contain; width: 100%; height: 400px; margin-left: auto; margin-right: auto;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>
                                            <span class=" visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <p>No images available for this package.</p>
                                <?php endif; ?>
                                <h3>Map of Destinations</h3>
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Card for Booking Form -->
                        <div class="card mb-4">
                            <div class="card-header">Booking Form</div>
                            <div class="card-body">
                                <form id="booking-form">
                                    <div class="mb-3">
                                        <label for="booking_date" class="form-label">Booking Date:</label>
                                        <input type="text" class="form-control" id="booking_date" name="booking_date" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="group_size" class="form-label">Group Size:</label>
                                        <select class="form-control" id="group_size" name="group_size" required>
                                            <option value="">Select Group Size</option>
                                            <option value="2-5">2 - 5 People</option>
                                            <option value="6-12">6 - 12 People</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" id="group_range_input" style="display: none;">
                                        <label for="num_people" class="form-label">Number of People:</label>
                                        <select class="form-control" id="num_people" name="num_people" required>
                                            <!-- Options will be populated dynamically based on group size -->
                                        </select>
                                    </div>

                                    <div class="mb-3" id="destination_section" style="display: none;">
                                        <label class="form-label">Select Destinations:</label>
                                        <div id="destination_checkboxes">
                                            <?php foreach ($destinations as $destination): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="destinations[]" value="<?= esc($destination['destination_id']); ?>" data-price="<?= esc($destination['harga_per_orang']); ?>">
                                                    <label class="form-check-label" for="destination_<?= esc($destination['destination_id']); ?>">
                                                        <?= esc($destination['destination_name']); ?> - Rp <?= number_format(esc($destination['harga_per_orang']), 0, ',', '.'); ?> per person
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="total_price_section" style="display: none;">
                                        <label for="total_price" class="form-label">Total Price:</label>
                                        <input type="text" class="form-control" id="total_price" name="total_price" readonly>
                                        <p id="price_details" style="font-size: 0.875rem; margin-top: 5px;"></p>
                                    </div>

                                    <input type="hidden" name="package_id" value="<?= esc($package['package_id']); ?>">

                                    <!-- Booking button (initially hidden) -->
                                    <button type="submit" class="btn btn-primary" id="book_now_button" style="display: none;">Book Now</button>
                                </form>
                            </div>
                        </div>
                        <!-- Card for Contact Us -->
                        <div class="card mb-4 text-center">
                            <div class="card-header">Have Questions?</div>
                            <div class="card-body">
                                <p>Contact us via WhatsApp or email for any questions.</p>
                                <a href="https://wa.me/<?= esc($contact['phone']); ?>" class="btn btn-success"><i class="fa fa-whatsapp"></i> Contact Us on WhatsApp</a>
                                <p>Email: <?= esc($contact['email']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            // Initialize the map
            var map = L.map('map').setView([-7.250445, 112.768845], 7); // Set initial view to Indonesia

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            <?php foreach ($destinations as $destination): ?>
                L.marker([<?= esc($destination['latitude']); ?>, <?= esc($destination['longitude']); ?>])
                    .addTo(map)
                    .bindPopup('<?= esc($destination['destination_name']); ?>');
            <?php endforeach; ?>
        </script>
        <script>
            document.getElementById('group_size').addEventListener('change', function() {
                handleGroupAndDateSelection();
            });

            // Handle booking date selection
            document.getElementById('booking_date').addEventListener('change', function() {
                handleGroupAndDateSelection();
            });

            function handleGroupAndDateSelection() {
                const groupSize = document.getElementById('group_size').value;
                const bookingDate = document.getElementById('booking_date').value;
                const destinationSection = document.getElementById('destination_section');

                // Show destination checkboxes only when both group size and booking date are selected
                if (groupSize && bookingDate) {
                    destinationSection.style.display = 'block';
                } else {
                    destinationSection.style.display = 'none';
                }

                // Also ensure total price and "Book Now" button visibility are updated
                calculateTotalPrice();
            }
            // Handle group size selection and populate number of people options
            document.getElementById('group_size').addEventListener('change', function() {
                const groupSize = this.value;
                const numPeopleSelect = document.getElementById('num_people');
                const groupRangeInput = document.getElementById('group_range_input');
                let options = [];

                if (groupSize === '2-5') {
                    for (let i = 1; i <= 5; i++) {
                        options.push(`<option value="${i}">${i} people</option>`);
                    }
                } else if (groupSize === '6-12') {
                    for (let i = 6; i <= 12; i++) {
                        options.push(`<option value="${i}">${i} people</option>`);
                    }
                }

                // Show group range input and populate the dropdown
                groupRangeInput.style.display = 'block';
                numPeopleSelect.innerHTML = options.join('');
            });

            // Handle destination selection and price calculation
            document.querySelectorAll('input[name="destinations[]"]').forEach(function(destinationInput) {
                destinationInput.addEventListener('change', function() {
                    handleDestinationSelection();
                });
            });

            // Handle the number of people change and update the total price
            document.getElementById('num_people').addEventListener('change', function() {
                calculateTotalPrice();
            });

            // Function to calculate and update the total price
            function calculateTotalPrice() {
                const selectedDestinations = document.querySelectorAll('input[name="destinations[]"]:checked');
                const numPeople = document.getElementById('num_people').value;
                const totalPriceField = document.getElementById('total_price');
                const priceDetails = document.getElementById('price_details');
                const totalPriceSection = document.getElementById('total_price_section');
                let totalPrice = 0;
                let details = '';

                // Calculate the total price for the selected destinations
                selectedDestinations.forEach(function(checkbox) {
                    const pricePerPerson = parseFloat(checkbox.getAttribute('data-price'));
                    const totalDestinationPrice = pricePerPerson * numPeople;
                    totalPrice += totalDestinationPrice;

                    // Format each destination's price details
                    details += `<p>Rp ${pricePerPerson.toLocaleString('id-ID')} Per Orang x ${numPeople} Orang = Rp ${totalDestinationPrice.toLocaleString('id-ID')}</p>`;
                });

                if (selectedDestinations.length > 0 && numPeople) {
                    totalPriceField.value = 'Rp ' + totalPrice.toLocaleString('id-ID');
                    priceDetails.innerHTML = details;
                    totalPriceSection.style.display = 'block';
                } else {
                    totalPriceSection.style.display = 'none';
                }

                // Enable the "Book Now" button only when both booking date and group size are selected
                const bookingDate = document.getElementById('booking_date').value;
                const bookNowButton = document.getElementById('book_now_button');
                if (bookingDate && numPeople && selectedDestinations.length > 0) {
                    bookNowButton.style.display = 'inline-block';
                } else {
                    bookNowButton.style.display = 'none';
                }
            }

            // Disable more than 4 destinations and hide the booking button initially
            function handleDestinationSelection() {
                const selectedDestinations = document.querySelectorAll('input[name="destinations[]"]:checked');
                const checkboxes = document.querySelectorAll('input[name="destinations[]"]');
                const bookNowButton = document.getElementById('book_now_button');

                // Disable checkboxes after selecting 4 destinations
                if (selectedDestinations.length >= 4) {
                    checkboxes.forEach(function(checkbox) {
                        if (!checkbox.checked) {
                            checkbox.disabled = true; // Disable unselected checkboxes
                        }
                    });
                } else {
                    checkboxes.forEach(function(checkbox) {
                        checkbox.disabled = false; // Enable checkboxes when less than 4 destinations are selected
                    });
                }

                // Hide the booking button until the user selects a booking date, number of people, and destinations
                if (selectedDestinations.length === 0 || !document.getElementById('booking_date').value || !document.getElementById('num_people').value) {
                    bookNowButton.style.display = 'none';
                } else {
                    bookNowButton.style.display = 'inline-block';
                }

                // Calculate total price whenever destinations are selected or unselected
                calculateTotalPrice();
            }

            // Ensure the "Book Now" button is hidden on page load until the conditions are met
            document.getElementById('booking-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Check if user is logged in
                if (!<?= session()->has('userid') ? 'true' : 'false'; ?>) {
                    window.location.href = '<?= base_url('login'); ?>'; // Redirect to login page
                    return;
                }

                // Jika sudah login, lanjutkan pemesanan
                document.getElementById('booking-form').submit();
            });
        </script>

        <script>
            // Initialize Flatpickr for the booking date
            flatpickr("#booking_date", {
                minDate: "today", // Disable past dates
                dateFormat: "d M Y", // Format the date as dd MM yyyy
                defaultDate: "today", // Default to today's date
                allowInput: false, // Disable manual typing (only calendar selection allowed)
            });
        </script>