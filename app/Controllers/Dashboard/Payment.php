<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\BookingModel;
use App\Models\bookvehiclemodel;

class Payment extends BaseController
{
    protected $paymentModel;
    protected $bookingModel;
    protected $bookingvehiclemodel;
    protected $roleLabel;

    public function __construct()
    {
        // Inisialisasi model bank pelangganModel
        $this->paymentModel = new paymentmodel();
        $this->bookingvehiclemodel = new bookvehiclemodel();
        $this->bookingModel = new BookingModel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }
    public function index()
    {
        $data = [
            'title' => 'Pembayaran',
            'payments' => $this->paymentModel->getPayments(),
            'roleLabel' => $this->roleLabel
        ];

        // Menampilkan view dengan data bank pelanggan
        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/payment', $data); // Pastikan view ini ada untuk menampilkan daftar bank pelanggan
        echo view('admin/Template/footer');
    }

    public function updateStatus()
    {
        $paymentId = $this->request->getPost('payment_id');
        $status = $this->request->getPost('status');

        // Fetch the payment details
        $payment = $this->paymentModel->find($paymentId);
        if (!$payment) {
            return redirect()->to(base_url('/bali/payment'))->with('error', 'Payment not found.');
        }

        // Update the payment status
        $this->paymentModel->update($paymentId, ['payment_status' => $status]);

        // Retrieve booking ID from the bookings table based on the payment entry
        $booking = $this->bookingModel->where('booking_id', $payment['booking_id'])->first(); // Adjust field names as necessary

        if ($status === 'validated' && $booking) {
            try {
                // Use booking ID from the bookings table for allocation
                $this->bookingvehiclemodel->allocateVehicles($booking['booking_id']);
                log_message('debug', 'Vehicles allocated successfully for bookingId: ' . $booking['booking_id']);
            } catch (\Exception $e) {
                log_message('error', 'Failed to allocate vehicles: ' . $e->getMessage());
            }
        }

        return redirect()->to(base_url('/bali/payment'))->with('success', 'Payment status updated successfully.');
    }
    public function submit()
    {
        $bookingId = $this->request->getPost('booking_id');

        $customerId = session()->get('userid');

        // Handle file upload
        $proofFile = $this->request->getFile('transferProof');
        $newFileName = null;

        if ($proofFile->isValid() && !$proofFile->hasMoved()) {
            $newFileName = $proofFile->getRandomName();
            $proofFile->move(FCPATH . 'uploads/bukti_tf', $newFileName);
        }

        $accountHolderName = trim($this->request->getPost('accountHolder'));

        $data = [
            'booking_id' => $bookingId,
            'customer_id' => $customerId,
            'payment_method' => $this->request->getPost('paymentMethod'),
            'account_holder_name' => $accountHolderName,
            'account_name' => $this->request->getPost('accountName'),
            'account_number' => $this->request->getPost('accountNumber'),
            'proof_of_payment' => $newFileName,
            'payment_status' => 'pending'
        ];

        $success = $this->paymentModel->save($data);

        if ($success) {
            return redirect()->to(base_url('profile/my_booking'))->with('success', 'Pembayaran berhasil disubmit');
        }

        // Atau kembalikan JSON jika menggunakan AJAX
        return $this->response->setJSON([
            'success' => $success,
            'redirectUrl' => base_url('profile/my_booking'),
            'message' => $success ? 'Payment submitted successfully' : 'Failed to submit payment'
        ]);
    }

    public function getPaymentHistory($customerId)
    {
        $hasHistory = $this->paymentModel->where('customer_id', $customerId)->countAllResults() > 0;

        return $this->response->setJSON(['hasHistory' => $hasHistory]);
    }
    public function getPreviousPayments($customerId = null, $paymentMethod = null)
    {

        // Get customer_id from session if not provided
        $customerId = $customerId ?? session()->get('userid');

        // Get previous payments for this customer and payment method
        $query = $this->paymentModel
            ->select('account_holder_name, account_name, account_number')
            ->where('customer_id', $customerId)
            ->where('payment_method', $paymentMethod)
            ->groupBy('account_holder_name, account_name, account_number')
            ->get();

        return $this->response->setJSON($query->getResultArray());
    }
}
