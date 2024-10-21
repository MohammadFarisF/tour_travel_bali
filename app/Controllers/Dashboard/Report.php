<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends BaseController
{
    protected $bookingModel;
    protected $roleLabel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    // Method untuk menampilkan form laporan
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'roleLabel' => $this->roleLabel
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/report');
        echo view('admin/Template/footer');
    }

    // Method untuk mencetak laporan
    public function printReport()
    {
        // Ambil data dari POST request
        $type = $this->request->getPost('reportType');
        $dateRange = $this->request->getPost('dateRange');

        // Ambil data dari model
        $reportData = $this->bookingModel->getFilteredBookings($type, $dateRange);

        // Mengatur Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Buat HTML untuk laporan
        $html = view('admin/report_view', ['reportData' => $reportData]);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream("laporan.pdf", ["Attachment" => false]);
    }
}
