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
                                        <input type="text" class="form-control" id="booking_date" name="booking_date" placeholder="Pilih Tanggal Booking" style="background-color: #ffffff;" required>
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

                                    <button type="button" class="btn btn-primary" id="book_now_button" style="display: none;" data-bs-target="#bookingModal">Book Now</button>
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
                                <a href="https://wa.me/<?= esc($contact['phone']); ?>?text=Saya%20ingin%20bertanya%20-%20tanya%20mengenai%20info%20jelas%20dari%20Paket%20Perjalanan%20<?= urlencode($package['package_name']); ?>" target="_blank" class="btn btn-success">
                                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp Icon" style="width: 20px; height: 20px; margin-right: 5px;">
                                    Contact Us on WhatsApp
                                </a>
                                <a href="mailto:<?= esc($contact['email']); ?>?subject=Pertanyaan%20Paket%20Perjalanan%20<?= urlencode($package['package_name']); ?>&body=Saya%20ingin%20bertanya%20mengenai%20informasi%20lengkap%20dari%20Paket%20Perjalanan%20<?= urlencode($package['package_name']); ?>" class="btn btn-primary mt-2" target="_blank">
                                    <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email Icon" style="width: 20px; height: 20px;">
                                    Contact Us via Email
                                </a>
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
                        <p><strong>Tanggal Perjalanan:</strong> <span id="departure_date"></span></p>
                        <p><strong>Destinasi:</strong></p>
                        <ul id="destination_list"></ul>
                        <p><strong>Jumlah Peserta:</strong> <span id="participants_count"></span></p>
                        <p><strong>Total Harga:</strong> <span id="total_price_display"></span></p>

                        <p id="price_details" style="cursor: pointer; color: blue;" onclick="togglePriceDetails()">Rincian Harga</p>
                        <div id="detailed_price" style="display: none;"></div>

                        <form id="confirm-booking-form" action="<?= base_url('confirm-booking'); ?>" method="POST">
                            <input type="hidden" id="hidden_package_id" name="package_id">
                            <input type="hidden" id="hidden_start" name="start_date">
                            <input type="hidden" id="hidden_end" name="end_date">
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
            <?php if (!empty($destinations)): ?>
                // Ambil latitude dan longitude dari destinasi pertama
                var initialLatitude = <?= esc($destinations[0]['latitude']); ?>;
                var initialLongitude = <?= esc($destinations[0]['longitude']); ?>;
            <?php endif; ?>

            var map = L.map('map').setView([initialLatitude, initialLongitude], 9);

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
                const detailedPrice = document.getElementById('detailed_price');
                detailedPrice.style.display = detailedPrice.style.display === 'none' ? 'block' : 'none';
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

            let bookingModal;

            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the modal
                const modalElement = document.getElementById('bookingModal');
                bookingModal = new bootstrap.Modal(modalElement);

                // Add event listeners for closing modal
                const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        bookingModal.hide();
                    });
                });
            });

            document.getElementById('book_now_button').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission
                event.stopPropagation();

                const modal = document.getElementById('bookingModal');

                if (!isLoggedIn || !isCustomer) {
                    redirectToLogin();
                    document.getElementById('book_now_button').style.display = 'none';
                    document.getElementById('book_now_button_logged_out').style.display = 'inline-block';
                    return;
                }

                const isDataComplete = <?= json_encode($isDataComplete); ?>;

                if (!isDataComplete) {
                    alert('Lengkapi data diri Anda terlebih dahulu di halaman profil.');
                    window.location.href = '<?= base_url('profile/my_account'); ?>';
                    return;
                }

                const availableVehicles = <?= json_encode($availableVehicles); ?>;

                if (!availableVehicles) {
                    alert('Mohon Maaf anda sedang tidak dapat memesan paket perjalanan');
                    window.location.href = '<?= base_url('package-detail/' . esc($package['package_id'])); ?>';
                    return;
                }

                const bookingData = {
                    packageName: '<?= esc($package['package_name']); ?>',
                    destinations: Array.from(document.querySelectorAll('input[name="destinations[]"]:checked')).map(
                        checkbox => {
                            const destinationName = checkbox.nextElementSibling.innerText.split(' - ')[0];
                            const destinationId = checkbox.value;
                            return {
                                name: destinationName,
                                id: destinationId
                            };
                        }
                    ),
                    numPeople: document.getElementById('num_people').value,
                    totalPrice: document.getElementById('total_price').value
                };

                const bookingDateValue = document.getElementById('booking_date').value;

                const [startDateStr, endDateStr] = bookingDateValue.split(' - ');

                const monthNames = {
                    'Januari': 0,
                    'Februari': 1,
                    'Maret': 2,
                    'April': 3,
                    'Mei': 4,
                    'Juni': 5,
                    'Juli': 6,
                    'Agustus': 7,
                    'September': 8,
                    'Oktober': 9,
                    'November': 10,
                    'Desember': 11
                };

                const formatDate = (dateStr) => {
                    const [day, monthName, year] = dateStr.split(' ');
                    const month = monthNames[monthName];
                    const formattedDate = new Date(Date.UTC(year, month, day)); // Using UTC to avoid timezone issue
                    return formattedDate.toISOString().split('T')[0]; // 'YYYY-MM-DD'
                };

                let startDateISO, endDateISO;

                if (endDateStr) {
                    // Jika ada dua tanggal (rentang)
                    startDateISO = formatDate(startDateStr);
                    endDateISO = formatDate(endDateStr);
                } else {
                    // Jika hanya ada satu tanggal
                    startDateISO = formatDate(bookingDateValue);
                    endDateISO = startDateISO; // Set start and end date the same
                }

                // Set hidden input values
                document.getElementById('hidden_start').value = startDateISO;
                document.getElementById('hidden_end').value = endDateISO;

                // Set data in the modal
                document.getElementById('package_name').innerText = bookingData.packageName;
                document.getElementById('participants_count').innerText = bookingData.numPeople + ' people';
                document.getElementById('total_price_display').innerText = bookingData.totalPrice;
                document.getElementById('departure_date').innerText = bookingDateValue;

                document.getElementById('destination_list').innerHTML = bookingData.destinations
                    .map(dest => `<li>${dest.name}</li>`)
                    .join('');

                document.getElementById('hidden_num_people').value = bookingData.numPeople;
                document.getElementById('hidden_total_price').value = parseFloat(bookingData.totalPrice.replace(/[^0-9,-]+/g, "").replace(",", ".")).toFixed(2);
                document.getElementById('hidden_package_id').value = '<?= esc($package['package_id']); ?>';

                const destinationIds = bookingData.destinations.map(dest => dest.id);
                document.getElementById('hidden_destinations').value = JSON.stringify(destinationIds);

                bookingModal.show();
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && bookingModal) {
                    bookingModal.hide();
                }
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
            document.addEventListener('DOMContentLoaded', function() {
                const packageType = '<?= esc($package['package_type']); ?>';
                const packageDuration = <?= esc($package['hari'] ?? 1); ?>;

                const flatpickrInstance = flatpickr("#booking_date", {
                    minDate: "today",
                    dateFormat: "d F Y",
                    allowInput: false,
                    mode: packageType === 'multiple_day' ? 'range' : 'single',

                    onChange: function(selectedDates, dateStr, instance) {
                        if (packageType === 'multiple_day') {
                            // Handle multiple_day logic
                            if (selectedDates.length === 1) {
                                const startDate = selectedDates[0];
                                const endDate = new Date(startDate);
                                endDate.setDate(endDate.getDate() + (packageDuration - 1));

                                instance.setDate([startDate, endDate]);

                                const formattedStartDate = startDate.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric'
                                });
                                const formattedEndDate = endDate.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric'
                                });

                                document.getElementById('booking_date').value =
                                    `${formattedStartDate} - ${formattedEndDate}`;
                            }
                        } else {
                            // Handle single_destination logic
                            if (selectedDates.length === 1) {
                                const selectedDate = selectedDates[0];
                                const formattedDate = selectedDate.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric'
                                });

                                document.getElementById('booking_date').value = formattedDate;
                            }
                        }
                        instance.close(); // Close the calendar after selection
                    },

                    onReady: function() {
                        const style = document.createElement('style');
                        style.innerHTML = `
                .flatpickr-day.selected, 
                .flatpickr-day.startRange, 
                .flatpickr-day.endRange,
                .flatpickr-day.selected.inRange, 
                .flatpickr-day.startRange.inRange, 
                .flatpickr-day.endRange.inRange {
                    background-color: #007bff !important;
                    border-color: #007bff !important;
                    color: white !important;
                }
                .flatpickr-day.inRange,
                .flatpickr-day.prevMonthDay.inRange,
                .flatpickr-day.nextMonthDay.inRange,
                .flatpickr-day.today.inRange,
                .flatpickr-day.prevMonthDay.today.inRange,
                .flatpickr-day.nextMonthDay.today.inRange {
                    background-color: #007bff33 !important;
                    border-color: #007bff33 !important;
                    color: #007bff !important;
                }
                .flatpickr-day.hover-in-range {
                    background-color: #007bff33 !important;
                    border-color: #007bff33 !important;
                    color: #007bff !important;
                }
            `;
                        document.head.appendChild(style);
                    },

                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        if (packageType === 'multiple_day') {
                            dayElem.addEventListener('mouseenter', function() {
                                if (!fp.selectedDates.length) {
                                    const hoverDate = new Date(dayElem.dateObj);
                                    const rangeEndDate = new Date(hoverDate);
                                    rangeEndDate.setDate(rangeEndDate.getDate() + (packageDuration - 1));

                                    const allDays = fp.days.childNodes;
                                    allDays.forEach(day => {
                                        const currentDate = new Date(day.dateObj);
                                        if (currentDate >= hoverDate && currentDate <= rangeEndDate) {
                                            day.classList.add('hover-in-range');
                                        }
                                    });
                                }
                            });

                            dayElem.addEventListener('mouseleave', function() {
                                if (!fp.selectedDates.length) {
                                    const allDays = fp.days.childNodes;
                                    allDays.forEach(day => {
                                        day.classList.remove('hover-in-range');
                                    });
                                }
                            });
                        }
                    }
                });
            });
        </script>