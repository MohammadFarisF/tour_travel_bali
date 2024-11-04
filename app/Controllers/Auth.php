<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\adminmodel;
use App\Models\custmodel;

class Auth extends BaseController
{
    protected $userModel;
    protected $customerModel;

    public function __construct()
    {
        // Inisialisasi model pengguna
        $this->userModel = new adminmodel();
        $this->customerModel = new CustModel();
    }

    public function login()
    {
        if (session()->get('user_role')) {
            return $this->redirectByRole(session()->get('user_role'));
        }

        // Only initialize validation if POST method is detected
        $data['validation'] = null;
        if ($this->request->getMethod() === 'post') {
            $data['validation'] = \Config\Services::validation();
        }

        echo view('auth/login', $data);
    }


    // Fungsi untuk login
    public function loginPost()
    {
        if (session()->get('user_role')) {
            return $this->redirectByRole(session()->get('user_role'));
        }

        // Validasi input login
        if ($this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Cek di tabel admin terlebih dahulu
            $user = $this->userModel->where('email', $email)->first();

            if (!$user) {
                // Jika tidak ditemukan di admin, cek di tabel customer
                $user = $this->customerModel->where('email', $email)->first();
            }

            if ($user && password_verify($password, $user['password'])) {
                // Set session dasar
                $sessionData = [
                    'userid' => $user['user_id'] ?? $user['customer_id'],
                    'user_role' => $user['user_role'],
                    'userEmail' => $user['email'],
                    'userName' => $user['full_name'],
                    'userPhoto' => $user['photo'] ?? null
                ];

                // Tambahkan session tambahan jika role adalah customer
                if ($user['user_role'] === 'customer') {
                    $sessionData['gender'] = $user['gender'];
                    $sessionData['phone_number'] = $user['phone_number'];
                    $sessionData['tgl_lahir'] = $user['tgl_lahir'];
                    $sessionData['citizen'] = $user['citizen'];
                }

                // Set semua session
                session()->set($sessionData);

                // Redirect berdasarkan role
                return $this->redirectByRole($user['user_role']);
            } else {
                session()->setFlashdata('danger', 'Email atau password salah.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $data['validation'] = \Config\Services::validation();
            return view('auth/login', $data);
        }
    }

    // Fungsi untuk redirect berdasarkan role
    private function redirectByRole($role)
    {
        if ($role === 'admin') {
            return redirect()->to(base_url('bali'));
        } elseif ($role === 'owner') {
            return redirect()->to(base_url('bali'));
        } elseif ($role === 'customer') {
            return redirect()->to(base_url(''));
        }
    }

    public function register()
    {
        if (session()->get('user_role')) {
            return $this->redirectByRole(session()->get('user_role'));
        }
        $data['validation'] = null;
        if ($this->request->getMethod() === 'post') {
            $data['validation'] = \Config\Services::validation();
        }

        echo view('auth/register', $data);
    }

    // Fungsi untuk proses registrasi
    public function registerPost()
    {
        // Validasi input
        $validationRules = [
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap tidak boleh kosong.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[customer.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'Email sudah digunakan oleh akun lain.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'min_length' => 'Password harus terdiri dari minimal 6 karakter.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong.',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password.'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor HP tidak boleh kosong.',
                    'numeric' => 'Nomor HP harus berupa angka.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            // Kembalikan ke form registrasi dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        // Generate User ID otomatis
        $lastUser = $this->customerModel->orderBy('customer_id', 'DESC')->first();
        if ($lastUser) {
            $lastId = substr($lastUser['customer_id'], 1); // Ambil angka setelah "C"
            $newId = 'C' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Generate ID baru
        } else {
            $newId = 'C001'; // ID pertama
        }

        // Hash password
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Data yang akan disimpan ke database
        $data = [
            'customer_id' => $newId,
            'full_name' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('no_hp'),
            'password' => $passwordHash,
            'user_role' => 'customer',
            'created_at' => date('Y-m-d H:i:s'), // Set waktu pembuatan
        ];

        // Simpan data ke database
        $this->customerModel->insert($data);

        // Set flashdata alert bahwa akun berhasil dibuat
        session()->setFlashdata('success', 'Akun telah berhasil dibuat.');

        return redirect()->to(base_url('login')); // Redirect ke halaman login
    }

    // Fungsi logout
    public function logout()
    {
        // Hapus sesi login
        session()->destroy();
        return redirect()->to(base_url('login')); // Redirect ke halaman login setelah logout
    }
}
