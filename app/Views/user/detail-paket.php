    <div class="container-fluid bg-primary hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown"><?= esc($package['package_name']); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-light pb-10">
                <div class="container-xl px-4">
                    <div class="pt-4">
                        <h1>
                            <div data-feather="user" style="height:50px; width:30px"></div>
                            Package Details: <?= esc($package['package_name']); ?>
                        </h1>
                    </div>
                </div>
            </header>

            <div class="container-xl px-4 mt-n10">
                <div class="row mb-4">
                    <div class="col-md-4"><strong>Type:</strong> <?= esc($package['package_type'] === 'single_destination' ? 'Single Day' : ($package['package_type'] === 'multiple_day' ? 'Multiple Day' : $package['package_type'])); ?></div>
                    <div class="col-md-4"><strong>Number of Destinations:</strong> <?= count($destinations); ?></div>
                    <div class="col-md-4"><strong>Province:</strong> Bali</div> <!-- Display Country -->
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
                                <h3 style="margin-top: 20px;">Photo Gallery</h3>
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
                                <h3 style="margin-top:20px">Map of Destinations</h3>
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Card for Booking Form -->
                        <div class="card mb-4">
                            <div class="card-header-primary">Booking Form</div>
                            <div class="card-body">
                                <form id="booking-form">
                                    <input type="hidden" name="package_id" value="<?= esc($package['package_id']); ?>">
                                    <div class="mb-3">
                                        <label for="booking_date" class="form-label">Booking Date:</label>
                                        <input type="text" class="form-control" id="booking_date" name="booking_date" style="background-color: #ffffff;" required>
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
                                                    <input class="form-check-input" type="checkbox" name="destinations[]" value="<?= esc($destination['destination_id']); ?>" id="destination_<?= esc($destination['destination_id']); ?>" data-price="<?= esc($destination['harga_per_orang']); ?>">
                                                    <label class="form-check-label" for="destination_<?= esc($destination['destination_id']); ?>">
                                                        <?= esc($destination['destination_name']); ?> - Rp <?= number_format($destination['harga_per_orang'], 0, ',', '.'); ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="total_price_section" style="display: none;">
                                        <label for="total_price" class="form-label">Total Price:</label>
                                        <input type="text" class="form-control" id="total_price" name="total_price" style="background-color:#ffffff" readonly>
                                        <p id="price_details" style="font-size: 0.875rem; margin-top: 5px;"></p>
                                    </div>

                                    <button type="button" class="btn btn-primary" id="book_now_button" style="display: none;" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</button>
                                    <button type="button" class="btn btn-primary" id="book_now_button_logged_out" style="display: none;" onclick="redirectToLogin()">Book Now (Login Required)</button>
                                    <p id="minimum_participants_warning" style="color: red; display: none;">Minimal Peserta 2 Orang</p>
                                </form>
                            </div>
                        </div>
                        <!-- Card for Contact Us -->
                        <div class="card mb-4 text-center">
                            <div class="card-header-primary">Have Questions?</div>
                            <div class="card-body">
                                <p>Contact us via WhatsApp or email for any questions.</p>
                                <a href="https://wa.me/<?= esc($contact['phone']); ?>" class="btn btn-success">
                                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                                    Contact Us on WhatsApp
                                </a>
                                <p>Email: <?= esc($contact['email']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Confirm Your Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama Paket:</strong> <span id="package_name"></span></p>
                        <p><strong>Destinations:</strong></p>
                        <ul id="destination_list"></ul>
                        <p><strong>Participants:</strong> <span id="participants_count"></span></p>
                        <p><strong>Total Price:</strong> <span id="total_price_display"></span></p>

                        <p id="price_details" style="cursor: pointer; color: blue;" onclick="togglePriceDetails()">Rincian Harga</p>
                        <div id="detailed_price" style="display: none;"></div>

                        <form id="confirm-booking-form" action="<?= base_url('confirm-booking'); ?>" method="POST">
                            <input type="hidden" id="hidden_package_id" name="package_id">
                            <input type="hidden" id="hidden_booking_date" name="booking_date">
                            <input type="hidden" id="hidden_num_people" name="num_people">
                            <input type="hidden" id="hidden_total_price" name="total_price">
                            <input type="hidden" id="hidden_destinations" name="destinations">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="cust_request" class="form-label">Customer Request</label>
                                <textarea class="form-control" id="cust_request" name="cust_request"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            feather.replace();
            // Initialize the map
            var map = L.map('map').setView([-8.434760395434676, 115.2791456846530], 9);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Icon custom untuk marker yang lebih kecil
            var smallIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png', // Anda bisa menggunakan URL gambar icon Anda sendiri di sini
                iconSize: [20, 32], // Ukuran marker (lebih kecil dari ukuran default)
                iconAnchor: [10, 32], // Posisi titik anchor (tengah bawah dari icon)
                popupAnchor: [1, -32] // Posisi popup agar muncul di atas icon
            });

            // Loop through destinations to add markers with popups
            <?php foreach ($destinations as $destination): ?>
                var marker = L.marker([<?= esc($destination['latitude']); ?>, <?= esc($destination['longitude']); ?>], {
                        icon: smallIcon
                    })
                    .addTo(map)
                    .on('click', function() {
                        // Konten popup yang berisi nama dan gambar
                        var popupContent = `
                    <div>
                        <h4><?= esc($destination['destination_name']); ?></h4>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <?php
                            $photos = explode(',', $destination['foto']);
                            foreach ($photos as $photo): ?>
                                <img src="<?= base_url('uploads/destinasi/' . esc(trim($photo))); ?>" alt="Destination Image" style="width: 100px; height: auto; object-fit: cover;">
                            <?php endforeach; ?>
                        </div>
                    </div>
                `;
                        marker.bindPopup(popupContent).openPopup(); // Tampilkan popup dengan konten yang disesuaikan
                    });
            <?php endforeach; ?>

            // Reverse geocoding on map click
            map.on('click', function(e) {
                var latlng = e.latlng;
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json&addressdetails=1`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.address) {
                            var address = data.display_name;
                            document.getElementById('address').value = address;
                        } else {
                            alert('Address not found. Please try again.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>

        <script>
            // Check if the user is logged in and has the 'customer' role
            const isLoggedIn = <?= session()->has('userid') ? 'true' : 'false'; ?>;
            const isCustomer = <?= session()->get('user_role') === 'customer' ? 'true' : 'false'; ?>;

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
                    for (let i = 2; i <= 5; i++) {
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

            // Function to toggle detailed price display
            function togglePriceDetails() {
                const detailedPriceDiv = document.getElementById('detailed_price');
                if (detailedPriceDiv.style.display === 'none' || detailedPriceDiv.style.display === '') {
                    detailedPriceDiv.style.display = 'block';
                } else {
                    detailedPriceDiv.style.display = 'none';
                }
            }

            // Update the calculateTotalPrice function to set detailed price information
            function calculateTotalPrice() {
                const selectedDestinations = document.querySelectorAll('input[name="destinations[]"]:checked');
                const numPeople = document.getElementById('num_people').value;
                const totalPriceField = document.getElementById('total_price');
                const priceDetails = document.getElementById('price_details');
                const totalPriceSection = document.getElementById('total_price_section');
                let totalPrice = 0;
                let detailedPrice = '';

                // Calculate the total price for the selected destinations
                selectedDestinations.forEach(function(checkbox) {
                    const pricePerPerson = parseFloat(checkbox.getAttribute('data-price')); // Get price per person from data-price attribute
                    if (!isNaN(pricePerPerson) && numPeople > 0) { // Check if pricePerPerson is a valid number
                        const totalDestinationPrice = pricePerPerson * numPeople;
                        totalPrice += totalDestinationPrice;

                        // Format the detailed price information
                        detailedPrice += `<p>Rp ${pricePerPerson.toLocaleString('id-ID')} Per Orang x ${numPeople} Orang = Rp ${totalDestinationPrice.toLocaleString('id-ID')}</p>`;
                    } else {
                        console.error("Invalid price or number of people:", pricePerPerson, numPeople);
                    }
                });

                if (selectedDestinations.length > 0 && numPeople) {
                    totalPriceField.value = 'Rp ' + totalPrice.toLocaleString('id-ID');
                    priceDetails.innerHTML = detailedPrice;
                    totalPriceSection.style.display = 'block';
                    document.getElementById('detailed_price').innerHTML = detailedPrice;
                } else {
                    totalPriceSection.style.display = 'none';
                }

                // Enable the appropriate "Book Now" button only when booking date, group size, and destinations are selected
                const bookingDate = document.getElementById('booking_date').value;
                const bookNowButton = document.getElementById('book_now_button');
                const bookNowButtonLoggedOut = document.getElementById('book_now_button_logged_out');

                if (bookingDate && numPeople && selectedDestinations.length > 0) {
                    if (isLoggedIn && isCustomer) {
                        bookNowButton.style.display = 'inline-block';
                        bookNowButtonLoggedOut.style.display = 'none';
                    } else {
                        bookNowButton.style.display = 'none';
                        bookNowButtonLoggedOut.style.display = 'inline-block';
                    }
                } else {
                    bookNowButton.style.display = 'none';
                    bookNowButtonLoggedOut.style.display = 'none';
                }
            }

            document.getElementById('book_now_button').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission
                // Check if the user is logged in and has the 'customer' role
                if (!isLoggedIn || !isCustomer) {
                    redirectToLogin();
                    document.getElementById('book_now_button').style.display = 'none';
                    document.getElementById('book_now_button_logged_out').style.display = 'inline-block';
                    return; // Prevent further execution
                }

                const isDataComplete = <?= json_encode($isDataComplete); ?>;

                if (!isDataComplete) {
                    alert('Lengkapi data diri Anda terlebih dahulu di halaman profil.');
                    window.location.href = '<?= base_url('profile/my_account'); ?>'; // Redirect to profile page
                    return; // Prevent further execution
                }

                // Retrieve data from the form if user is logged in and has the 'customer' role
                const bookingData = {
                    packageName: '<?= esc($package['package_name']); ?>', // Package name
                    destinations: Array.from(document.querySelectorAll('input[name="destinations[]"]:checked')).map(
                        checkbox => {
                            const destinationName = checkbox.nextElementSibling.innerText.split(' - ')[0]; // Mengambil nama
                            const destinationId = checkbox.value; // Mengambil ID dari checkbox
                            return {
                                name: destinationName,
                                id: destinationId
                            }
                        }
                    ), // Only destination names
                    numPeople: document.getElementById('num_people').value, // Number of participants
                    totalPrice: document.getElementById('total_price').value // Total price (displayed separately)
                };

                const bookingDate = document.getElementById('booking_date').value;

                // Convert bookingDate to YYYY-MM-DD format
                const formattedBookingDate = new Date(bookingDate).toISOString().split('T')[0];
                const totalPriceFormatted = parseFloat(bookingData.totalPrice.replace(/[^0-9,-]+/g, "").replace(",", ".")).toFixed(2);

                // Set data in the modal (only if the user is logged in and a customer)
                document.getElementById('package_name').innerText = bookingData.packageName;
                document.getElementById('participants_count').innerText = bookingData.numPeople + ' people';
                document.getElementById('total_price_display').innerText = bookingData.totalPrice;


                // Display only destination names in the modal list
                document.getElementById('destination_list').innerHTML = bookingData.destinations
                    .map(dest => `<li>${dest.name}</li>`) // Ambil nama dari objek
                    .join('');

                // Ensure the hidden fields for num_people and total_price are updated
                document.getElementById('hidden_num_people').value = bookingData.numPeople;
                document.getElementById('hidden_total_price').value = totalPriceFormatted; // Set formatted total price
                document.getElementById('hidden_package_id').value = '<?= esc($package['package_id']); ?>';
                document.getElementById('hidden_booking_date').value = formattedBookingDate;

                const destinationIds = bookingData.destinations.map(dest => dest.id); // Ambil ID destinasi sebagai array
                document.getElementById('hidden_destinations').value = JSON.stringify(destinationIds);
            });

            function redirectToLogin() {
                alert('Anda harus login terlebih dahulu untuk melakukan pemesanan.');
                window.location.href = '<?= base_url('login?redirect=' . current_url()); ?>';
            }

            // Disable more than 4 destinations and hide the booking button initially
            function handleDestinationSelection() {
                const selectedDestinations = document.querySelectorAll('input[name="destinations[]"]:checked');
                const checkboxes = document.querySelectorAll('input[name="destinations[]"]');
                const bookNowButton = document.getElementById('book_now_button');
                const bookNowButtonLoggedOut = document.getElementById('book_now_button_logged_out');

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

                // Check if user has selected a booking date, number of people, and at least one destination
                const bookingDate = document.getElementById('booking_date').value;
                const numPeople = document.getElementById('num_people').value;

                if (selectedDestinations.length > 0 && bookingDate && numPeople) {
                    if (isLoggedIn && isCustomer) {
                        // Show the "Book Now" button for logged-in customers
                        bookNowButton.style.display = 'inline-block';
                        bookNowButtonLoggedOut.style.display = 'none';
                    } else {
                        // Show the "Book Now (Login Required)" button for non-logged-in users
                        bookNowButton.style.display = 'none';
                        bookNowButtonLoggedOut.style.display = 'inline-block';
                    }
                } else {
                    // Hide both buttons if conditions are not met
                    bookNowButton.style.display = 'none';
                    bookNowButtonLoggedOut.style.display = 'none';
                }

                // Calculate total price whenever destinations are selected or unselected
                calculateTotalPrice();
            }
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