<?php

namespace App\Controllers;

use App\Models\paketmodel;
use App\Models\destinasimodel;
use App\Models\kendaraanmodel;
use App\Models\paymentmodel;
use App\Models\refundmodel;
use App\Models\BookingModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $paketModel;
    protected $destinasiModel;
    protected $kendaraanModel;
    protected $paymentModel;
    protected $refundModel;
    protected $bookingModel;

    public function __construct()
    {

        $this->paketModel = new paketmodel();
        $this->destinasiModel = new destinasimodel();
        $this->kendaraanModel = new kendaraanmodel();
        $this->paymentModel = new paymentmodel();
        $this->refundModel = new refundmodel();
        $this->bookingModel = new BookingModel();
    }


    public function index()
    {

        // Cek role dan tentukan label yang akan muncul
        $roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';

        // Ambil data paket dan destinasi dari database
        $packages = $this->paketModel->findAll();
        $destinations = $this->destinasiModel->findAll();
        $vehicles = $this->kendaraanModel->where('status', 'available')->findAll(); // Kendaraan dengan status 'available'
        $pendingPayments = $this->paymentModel->where('payment_status', 'pending')->countAllResults(); // Pembayaran yang masih 'pending'
        $pendingRefunds = $this->refundModel->where('refund_status', 'processed')->countAllResults(); // Refund yang masih 'pending'
        $currentDate = date('Y-m-d'); // Ambil tanggal saat ini
        $pendingTasks = $this->bookingModel->where('departure_date <', $currentDate)
            ->where('booking_status', 'confirmed')
            ->countAllResults(); // Hitung pemesanan yang perlu diselesaikan

        // Siapkan data untuk dikirimkan ke view
        $data = [
            'title' => 'Dashboard',
            'roleLabel' => $roleLabel, // Label role (Admin/Super Admin)
            'packages' => $packages, // Data paket
            'destinations' => $destinations, // Data destinasi
            'availableVehicles' => count($vehicles), // Jumlah kendaraan yang tersedia
            'pendingPayments' => $pendingPayments, // Jumlah pembayaran yang perlu dikonfirmasi
            'pendingRefunds' => $pendingRefunds,
            'pendingTasks' => $pendingTasks
        ];

        // Tampilkan view dengan data yang dikirimkan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/index', $data);
        echo view('admin/Template/footer');
    }
}
