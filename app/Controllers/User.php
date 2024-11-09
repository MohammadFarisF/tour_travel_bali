<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\paketmodel;
use App\Models\DestinasiModel;
use App\Models\ReviewModel;

class User extends BaseController
{

    protected $paketModel;
    protected $destinasiModel;
    protected $reviewModel;
    protected $roleLabel;

    public function __construct()
    {
        // Inisialisasi model PaketModel
        $this->paketModel = new paketmodel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
        $this->destinasiModel = new DestinasiModel();
        $this->reviewModel = new ReviewModel();
    }

    public function index()
    {
        // Ambil semua paket
        $packages = $this->paketModel->findAll();

        // Siapkan data untuk tampilan
        $data = [
            'packages' => $this->calculatePackageDetails($packages),
        ];

        // Muat tampilan
        echo view('user/Template/header', $data);
        echo view('user/index', $data);
        echo view('user/Template/footer');
    }

    private function calculatePackageDetails($packages)
    {
        foreach ($packages as &$package) {
            // Ambil harga destinasi terkait
            $destinationPrices = $this->destinasiModel->getPricesByPackageId($package['package_id']);

            // Check if destinationPrices is empty and set default values
            if (!empty($destinationPrices)) {
                $package['price'] = min(array_column($destinationPrices, 'harga_per_orang')); // Only set the minimum price
            } else {
                // Set default value if no prices are found
                $package['price'] = null; // Set to null or a specific value to indicate no price available
            }

            // Ambil rating rata-rata
            $reviews = $this->reviewModel->getReviewsByPackageId($package['package_id']);
            $package['average_rating'] = $this->calculateAverageRating($reviews);
        }
        return $packages;
    }

    private function calculateAverageRating($reviews)
    {
        if (count($reviews) === 0) {
            return 0; // Jika tidak ada review, rating rata-rata adalah 0
        }
        $totalRating = array_sum(array_column($reviews, 'rating'));
        return $totalRating / count($reviews);
    }

    public function about()
    {
        echo view('user/template/header');
        echo view('user/about');
        echo view('user/template/footer');
    }

    public function booking()
    {
        echo view('user/template/header');
        echo view('user/booking');
        echo view('user/template/footer');
    }
    public function contact()
    {
        echo view('user/template/header');
        echo view('user/contact');
        echo view('user/template/footer');
    }
    public function payment()
    {
        echo view('user/template/header');
        echo view('user/payment');
        echo view('user/template/footer');
    }
    public function change()
    {
        echo view('user/template/header');
        echo view('user/change');
        echo view('user/template/footer');
    }
    public function my_account()
    {
        echo view('user/template/header');
        echo view('user/my_account');
        echo view('user/template/footer');
    }
    public function review()
    {
        echo view('user/template/header');
        echo view('user/review');
        echo view('user/template/footer');
    }
}
