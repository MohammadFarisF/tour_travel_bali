<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\reviewmodel;

class Review extends BaseController
{
    protected $reviewModel;
    protected $roleLabel;

    public function __construct()
    {
        // Inisialisasi model
        $this->reviewModel = new reviewmodel();
        $this->roleLabel = (session()->get('user_role') === 'owner') ? 'Super Admin' : 'Admin';
    }

    // Method untuk menampilkan data review
    public function index()
    {
        // Ambil data review dari model
        $data = [
            'title' => 'Data Review',
            'review' => $this->reviewModel->getReview(),
            'roleLabel' => $this->roleLabel
        ];

        // Tampilkan tampilan template dengan data admin
        echo view('admin/Template/header', $data);   // Header dengan judul halaman
        echo view('admin/Template/sidebar', $data);         // Sidebar yang digunakan
        echo view('admin/review', $data);             // Isi halaman admin dengan data review yang diambil
        echo view('admin/Template/footer');          // Footer
    }

    // Method untuk menghapus data review
    public function delete($id)
    {
        if (session()->get('user_role') !== 'owner') {
            return redirect()->to(base_url('/bali'))->with('dilarang_masuk', 'Anda tidak memiliki akses untuk ke halaman ini.');
        }
        // Mengecek apakah data ada sebelum menghapus
        if (!$this->reviewModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ulasan Customer tidak ditemukan');
        }

        // Menghapus destinasi berdasarkan ID
        $this->reviewModel->delete($id);
        return redirect()->to(base_url('/bali/review'));
    }

    public function cust_index()
    {
        $userId = session()->get('userid'); // Dapatkan user_id dari session
        $data = [
            'title' => 'Review',
            'review' => $this->reviewModel->getReviewCust($userId), // Mengambil review berdasarkan user_id
        ];

        echo view('user/template/header', $data);
        echo view('user/review', $data);
        echo view('user/template/footer');
    }
    // Method untuk menyimpan review
    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'booking_id' => 'required',
            'rating' => 'required|in_list[1,2,3,4,5]',
            'review_text' => 'required|min_length[10]',
            'review_photo' => 'permit_empty|is_image[review_photo]|max_size[review_photo,2048]', // Max size 2MB
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $data = [
            'booking_id' => $this->request->getPost('booking_id'),
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
            'review_date' => date('Y-m-d H:i:s'), // Set tanggal review
        ];

        // Proses upload foto jika ada
        if ($this->request->getFile('review_photo')->isValid()) {
            $file = $this->request->getFile('review_photo');
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/review', $newName); // Pastikan folder ini ada
            $data['review_photo'] = $newName; // Simpan nama file foto
        }

        // Simpan data review ke database
        $this->reviewModel->save($data);

        return redirect()->to(base_url('/bali/review'))->with('success', 'Review berhasil disimpan.');
    }
}
