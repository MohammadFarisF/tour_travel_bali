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
        $type = $this->request->getPost('reportType');
        $dateRange = $this->request->getPost('dateRange');
        $status = $this->request->getPost('status');

        $data = [
            'title' => 'Laporan',
            'roleLabel' => $this->roleLabel,
            'reportData' => $this->bookingModel->getFilteredBookings($type, $dateRange, $status)
        ];

        echo view('admin/Template/header', $data);
        echo view('admin/Template/sidebar', $data);
        echo view('admin/report', $data);
        echo view('admin/Template/footer');
    }

    // Method untuk mencetak laporan
    public function printReport()
    {
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // Convert logo to base64
        $imageData = base64_encode(file_get_contents(FCPATH . 'asset_user/img/title.png'));
        $logoSrc = 'data:image/jpeg;base64,' . $imageData;

        $type = $this->request->getPost('reportType');
        $dateRange = $this->request->getPost('dateRange');
        $status = $this->request->getPost('bookingStatus');

        // Filter status
        $reportData = $this->bookingModel->getFilteredBookings($type, $dateRange, $status);

        $statusMap = [
            'confirmed' => 'Sudah Dibayar',
            'pending' => 'Belum Dibayar',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai',
            'all' => 'Semua Status'
        ];

        // Use the status value to get the display text
        $statusText = isset($statusMap[$status]) ? $statusMap[$status] : 'Semua Status';
        $dateRangeText = $this->formatDateRange($dateRange);
        $adminName = session()->get('userName'); // Nama lengkap admin dari session

        $data = [
            'reportData' => $reportData,
            'logoSrc' => $logoSrc,
            'dateRangeText' => $dateRangeText,
            'statusText' => $statusText,
            'adminName' => $adminName
        ];

        $html = view('admin/report_view', $data);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        // Add page numbers
        $canvas = $dompdf->get_canvas();
        $font = $dompdf->getFontMetrics()->get_font('Courier', 'normal');
        $pageCount = $canvas->get_page_count();

        for ($i = 1; $i <= $pageCount; $i++) {
            $canvas->page_text(400, 570, "Halaman $i dari $pageCount", $font, 10, array(0, 0, 0));
        }

        // Generate the dynamic filename
        $fileName = "Lap Pemesanan " . ($status ? $statusText : "Semua Status") . " " . ucfirst($type) . " " . $dateRangeText . ".pdf";
        $dompdf->stream($fileName, ["Attachment" => false]);
    }

    // Helper function to format date range based on the type
    private function formatDateRange($dateRange)
    {
        if ($dateRange === 'all' || empty($dateRange)) {
            return "Semua Data";
        } elseif (strpos($dateRange, '-') !== false) {
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $start = date('d F Y', strtotime($startDate));
            $end = date('d F Y', strtotime($endDate));
            return "$start - $end";
        } else {
            return date('d F Y', strtotime($dateRange));
        }
    }
}
