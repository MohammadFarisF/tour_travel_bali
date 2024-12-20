<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\RefundModel;

class Refund extends BaseController
{
    protected $refundModel;
    protected $roleLabel;

    public function __construct()
    {
        $this->refundModel = new RefundModel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    public function index()
    {
        $data = [
            'title' => 'Pengelolaan Refund',
            'refunds' => $this->refundModel->getRefunds(),
            'roleLabel' => $this->roleLabel
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/refund', $data); // Pastikan view ini ada
        echo view('admin/Template/footer');
    }

    // Update status refund
    public function updateStatus()
    {
        $refundId = $this->request->getPost('refund_id');
        $status = $this->request->getPost('status');

        // Update status refund
        $this->refundModel->update($refundId, ['refund_status' => $status]);

        return redirect()->to(base_url('/bali/refund'));
    }
}
