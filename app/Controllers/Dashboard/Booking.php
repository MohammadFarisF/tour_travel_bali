<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\bookingmodel;
use App\Models\CustModel;
use App\Models\DestinasiModel;
use App\Models\bookvehiclemodel;
use App\Models\bookdestinasimodel;
use App\Models\paketmodel;
use App\Models\BankTravelModel;
use App\Models\kendaraanmodel;
use App\Models\RefundModel;
use App\Models\PaymentModel;
use App\Models\ReviewModel;

class Booking extends BaseController
{
    protected $bookingModel;
    protected $destinasiModel;
    protected $bookingvehiclemodel;
    protected $bookingdestinasimodel;
    protected $paketModel;
    protected $customerModel;
    protected $banktravelModel;
    protected $kendaraanModel;
    protected $refundModel;
    protected $paymentModel;
    protected $reviewModel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->bookingModel = new bookingmodel();
        $this->bookingdestinasimodel = new bookdestinasimodel();
        $this->bookingvehiclemodel = new bookvehiclemodel();
        $this->destinasiModel = new DestinasiModel();
        $this->paketModel = new paketmodel();
        $this->customerModel = new CustModel();
        $this->banktravelModel = new BankTravelModel();
        $this->kendaraanModel = new kendaraanmodel();
        $this->refundModel = new RefundModel();
        $this->paymentModel = new PaymentModel();
        $this->reviewModel = new ReviewModel();
    }

    public function index()
    {
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        // Mengambil semua data bank pelanggan
        $data = [
            'title' => 'Pemesanan',
            'bookings' => $this->bookingModel->getBooking(),
            'roleLabel' => $roleLabel, // Mengambil semua bank pelanggan
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/booking', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }

    public function completeBooking($bookingId)
    {
        // Check if the request is a POST request
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/')->with('error', 'Invalid request method.');
        }

        // Fetch the booking details
        $booking = $this->bookingModel->where('booking_id', $bookingId)->first();
        if (!$booking) {
            return redirect()->to('/')->with('error', 'Booking not found.');
        }

        // Update the booking status to 'completed'
        $this->bookingModel->update($bookingId, [
            'booking_status' => 'completed'
        ]);

        // Redirect to the booking details page with a success message
        return redirect()->to(base_url('bali/booking'))->with('success', 'Booking has been completed successfully.');
    }

    public function cust_index()
    {
        $userId = session()->get('userid');
        $bookings = $this->bookingModel->getBookingByUserId($userId);


        // Ambil detail pembayaran untuk setiap booking
        foreach ($bookings as &$booking) {
            $payment = $this->paymentModel->where('booking_id', $booking['booking_id'])->first();
            $review = $this->reviewModel->where('booking_id', $booking['booking_id'])->first();
            $booking['payment'] = $payment;
            $booking['review'] = $review; // Tambahkan detail pembayaran ke setiap booking
        } // Ambil user_id dari session
        $data = [
            'title' => 'Pemesanan - ',
            'bookings' => $bookings
        ];

        echo view('user/template/header', $data);
        echo view('user/Template/sidebar', $data);
        echo view('user/payment', $data);
    }

    public function invoice()
    {
        $userId = session()->get('userid'); // Ambil user_id dari session
        $data = [
            'title' => 'Invoice - ',
            'bookings' => $this->bookingModel->getInvoiceBookingsByUserId($userId), // Menggunakan fungsi baru
        ];

        echo view('user/template/header', $data);
        echo view('user/Template/sidebar', $data);
        echo view('user/invoice', $data);
    }

    public function viewInvoice($bookingId)
    {
        // Get booking data
        $booking = $this->bookingModel->find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Invoice tidak ditemukan!');
        }

        // Get customer data - menggunakan array syntax
        $customer = $this->customerModel->find($booking['customer_id']);

        // Get package data
        $package = $this->paketModel->find($booking['package_id']);

        // Get vehicles data
        $bookingVehicles = $this->bookingvehiclemodel
            ->select('vehicles.vehicle_name')
            ->join('vehicles', 'booking_vehicles.vehicle_id = vehicles.vehicle_id')
            ->where('booking_vehicles.booking_id', $bookingId)
            ->findAll();

        // Create comma-separated string of vehicle names
        $vehicleNames = implode(', ', array_column($bookingVehicles, 'vehicle_name'));

        // Get destinations with location details
        $destinationDetails = $this->bookingdestinasimodel
            ->select('
                destinations.destination_name as destination,
                destinations.harga_per_orang,
                CONCAT(destinations.latitude, ", ", destinations.longitude) as coordinates,
                booking_destinations.destination_id
            ')
            ->join('destinations', 'booking_destinations.destination_id = destinations.destination_id')
            ->where('booking_destinations.booking_id', $bookingId)
            ->findAll();

        // Get payment information
        $payment = $this->paymentModel
            ->where('booking_id', $bookingId)
            ->first();

        // Process destination details to include address
        foreach ($destinationDetails as &$destination) {
            // Split coordinates
            list($lat, $lng) = explode(', ', $destination['coordinates']);

            // Get address using reverse geocoding
            $location = $this->getAddressFromCoordinates($lat, $lng);

            $destination['location'] = $location;
            unset($destination['coordinates']); // Remove raw coordinates from final data
        }

        $data = [
            'title' => 'Invoice Details - ',
            'booking' => $booking,
            'customer' => $customer,
            'package' => $package,
            'vehicleNames' => $vehicleNames,
            'destinationDetails' => $destinationDetails,
            'payment' => $payment
        ];

        // Render views
        echo view('user/template/header', $data);
        echo view('user/template/sidebar', $data);
        echo view('user/invoice-detail', $data);
    }

    private function getAddressFromCoordinates($lat, $lng)
    {
        $url = "https://photon.komoot.io/reverse?lat={$lat}&lon={$lng}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Format alamat dari response
        $features = $data['features'][0]['properties'] ?? [];

        // Menyusun detail lokasi
        $details = [];

        // Menambahkan kecamatan (district)
        if (!empty($features['district'])) {
            $details[] = "Kecamatan " . $features['district'];
        }

        // Menambahkan kota/kabupaten (city)
        if (!empty($features['city'])) {
            // Cek apakah kota atau kabupaten
            if (stripos($features['city'], 'kabupaten') !== false) {
                $details[] = $features['city'];
            } else {
                $details[] = "Kota " . $features['city'];
            }
        }

        // Menambahkan provinsi (state)
        if (!empty($features['state'])) {
            $details[] = "Provinsi " . $features['state'];
        }

        // Jika array kosong, kembalikan pesan default
        if (empty($details)) {
            return "Location not found";
        }

        // Gabungkan semua detail dengan koma
        return implode(", ", $details);
    }
    public function confirmBooking()
    {
        // Validate the incoming request
        $this->validate([
            'package_id' => 'required',
            'address' => 'required|string',
            'num_people' => 'required|integer',
            'cust_request' => 'permit_empty|string',
            'booking_date' => 'required|date'
        ]);

        // Retrieve form data
        $packageId = $this->request->getPost('package_id');
        $customerId = session()->get('userid'); // Logged-in user ID
        $totalPeople = $this->request->getPost('num_people');
        $bookingDate = $this->request->getPost('booking_date');
        $destinations = json_decode($this->request->getPost('destinations'), true);
        $totalAmount = $this->request->getPost('total_price');
        $address = $this->request->getPost('address');
        $custRequest = $this->request->getPost('cust_request');

        // Generate a random booking ID (same as booking code) in the format #B12345
        $bookingId = $this->generateUniqueBookingID();
        // Save booking data
        $bookingData = [
            'booking_id' => $bookingId,  // Use the generated booking ID
            'customer_id' => $customerId,
            'package_id' => $packageId,
            'address' => $address,
            'total_people' => $totalPeople,
            'departure_date' => $bookingDate,
            'return_date' => $bookingDate, // Assuming single day for now
            'total_amount' => $totalAmount,
            'cust_request' => $custRequest,
            'booking_status' => 'pending',
            'payment_status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Insert booking data into the database
        $this->bookingModel->insert($bookingData);

        // Save selected destinations if applicable
        if (!empty($destinations)) {
            foreach ($destinations as $destinationId) {
                $this->bookingdestinasimodel->insert([
                    'booking_id' => $bookingId,  // Use the same booking ID
                    'destination_id' => $destinationId,
                ]);
            }
        }

        // Redirect to booking detail page
        return redirect()->to(base_url('booking/' . $bookingId));
    }

    private function generateUniqueBookingID()
    {
        do {
            $bookingId = 'B' . rand(10000, 99999); // Generate a random ID like #B12345
            $existingBooking = $this->bookingModel->where('booking_id', $bookingId)->first();
        } while ($existingBooking); // Repeat if ID exists in the database

        return $bookingId;
    }
    public function bookingDetails($bookingId)
    {
        // Fetch booking details
        $booking = $this->bookingModel->where('booking_id', $bookingId)->first();
        if (!$booking) {
            // Handle booking not found
            return redirect()->to('/')->with('error', 'Booking not found.');
        }

        // Fetch package details
        $package = $this->paketModel->find($booking['package_id']);

        // Fetch customer details
        $customer = $this->customerModel->find($booking['customer_id']);

        // Fetch destinations related to this booking
        $destinationIds = $this->bookingdestinasimodel->where('booking_id', $bookingId)->findAll();

        // Prepare an array to hold destination details
        $destinations = [];
        foreach ($destinationIds as $destination) {
            $dest = $this->destinasiModel->find($destination['destination_id']);
            if ($dest) {
                $destinations[] = [
                    'destination_name' => $dest['destination_name'],
                    'harga_per_orang' => $dest['harga_per_orang'], // Pastikan kolom ini ada di tabel destinations
                ];
            }
        }

        // Fetch bank details
        $banks = $this->banktravelModel->findAll();

        // Fetch vehicles related to this booking
        $vehicles = $this->bookingvehiclemodel->where('booking_id', $bookingId)->findAll();
        $vehicleDetails = [];
        foreach ($vehicles as $vehicle) {
            $vehicleInfo = $this->kendaraanModel->find($vehicle['vehicle_id']);
            if ($vehicleInfo) {
                $vehicleDetails[] = [
                    'vehicle_name' => $vehicleInfo['vehicle_name'],
                    'license_plate' => $vehicleInfo['license_plate'],
                    'vehicle_photo' => $vehicleInfo['vehicle_photo'],
                ];
            }
        }

        $payment = $this->paymentModel->where('booking_id', $bookingId)->first();

        // Prepare data for view
        $data = [
            'title' => 'Booking Details',
            'package' => $package,
            'booking' => $booking,
            'customer' => $customer,
            'destinations' => $destinations,
            'banks' => $banks,
            'total_people' => $booking['total_people'], // Tambahkan total_people ke data
            'vehicles' => $vehicleDetails,
            'payment' => $payment
        ];
        echo view('user/template/header', $data);
        echo view('user/booking', $data);
        echo view('user/template/footer');
    }
    public function cancelBooking($bookingId)
    {
        // Check if the request is a POST request
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/')->with('error', 'Invalid request method.');
        }

        // Fetch the booking details
        $booking = $this->bookingModel->where('booking_id', $bookingId)->first();
        if (!$booking) {
            return redirect()->to('/')->with('error', 'Booking not found.');
        }

        // Find the payment associated with this booking using booking_id
        $payment = $this->paymentModel->where('booking_id', $bookingId)->first();
        if (!$payment) {
            return redirect()->to('/')->with('error', 'Payment not found for this booking.');
        }

        $refundResult = $this->refundModel->processRefund($bookingId);

        // Prepare refund data
        if ($refundResult) {
            // Assuming the procedure returns refund amount, you can check if it's greater than 0
            $refundAmount = $refundResult->refund_amount; // Ganti sesuai dengan cara Anda mendapatkan hasil

            if ($refundAmount > 0) {
                // Prepare refund data
                $refundData = [
                    'customer_id' => $booking['customer_id'], // Assuming you have access to customer_id from booking
                    'booking_id' => $bookingId,
                    'payment_id' => $payment['payment_id'], // Use the payment_id found
                    'refund_amount' => $refundAmount, // Use the refund amount calculated from the procedure
                    'refund_date' => date('Y-m-d H:i:s'),
                    'refund_status' => 'processed', // or whatever status you want to set
                ];

                // Insert refund record
                $this->refundModel->insert($refundData);

                // Update booking status to 'cancelled'
                $this->bookingModel->update($bookingId, [
                    'booking_status' => 'cancelled',
                    'payment_status' => 'refund_processed'
                ]);

                // Redirect to the booking details page with a success message
                return redirect()->to(base_url('profile/my_booking'))->with('success', 'Booking has been canceled and a refund has been processed.');
            } else {
                // Refund amount is 0, show alert
                return redirect()->to(base_url('profile/my_booking'))->with('error', 'Refund cannot be processed as it does not meet the refund policy.');
            }
        } else {
            // Handle case where procedure failed
            return redirect()->to(base_url('profile/my_booking'))->with('error', 'Failed to process refund. Please try again later.');
        }
    }
}
