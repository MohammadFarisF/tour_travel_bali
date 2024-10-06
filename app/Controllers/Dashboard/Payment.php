<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    protected $paymentModel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->paymentModel = new paymentmodel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pembayaran',
            'payments' => $this->paymentModel->getPayments(), // Mengambil semua bank pelanggan
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar');
        echo view('admin/payment', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }

    public function updateStatus()
    {

        $paymentId = $this->request->getPost('payment_id');
        $status = $this->request->getPost('status');

        // Update status pembayaran
        $this->paymentModel->update($paymentId, ['payment_status' => $status]);

        // Redirect or return response
        return redirect()->to('/bali/payment');
    }
}