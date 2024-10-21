<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\usermodel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi model pengguna
        $this->userModel = new usermodel();
    }

    // Fungsi untuk login
    public function login()
    {
        if (session()->get('user_role')) {

            // Jika sudah login, redirect berdasarkan role
            if (session()->get('user_role') === 'admin') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'owner') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'customer') {
                redirect()->to('');
            }
        }
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation(),
        ];
        return view('user/login', $data);
    }

    // Fungsi untuk proses login
    public function loginPost()
    {
        // Cek jika sudah login
        if (session()->get('user_role')) {
            if (session()->get('user_role') === 'admin') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'owner') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'customer') {
                redirect()->to('');
            }
        }

        // Validasi input form login
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
            // Ambil data pengguna berdasarkan email
            $user = $this->userModel->where('email', $this->request->getPost('email'))->first();

            if ($user) {
                // Verifikasi password
                if (password_verify($this->request->getPost('password'), $user['password'])) {
                    // Cek role pengguna (misal 'admin' atau 'customer')
                    if ($user['user_role'] === 'admin') {
                        // Set sesi untuk admin
                        session()->set([
                            'userid' => $user['user_id'],
                            'user_role' =>  $user['user_role'], // Set user_role sebagai admin
                            'userEmail' => $user['email'],
                            'userName' => $user['full_name'],
                        ]);

                        // Redirect ke halaman admin (/bali)
                        return redirect()->to(base_url('/bali'));
                    } elseif ($user['user_role'] === 'owner') {
                        // Set sesi untuk customer
                        session()->set([
                            'userid' => $user['user_id'],
                            'user_role' =>  $user['user_role'], // Set user_role sebagai customer
                            'userEmail' => $user['email'],
                            'userName' => $user['full_name'],
                        ]);

                        // Redirect ke halaman customer (/)
                        return redirect()->to(base_url('/bali'));
                    } elseif ($user['user_role'] === 'customer') {
                        session()->set([
                            'userid' => $user['user_id'],
                            'user_role' =>  $user['user_role'], // Set user_role sebagai customer
                            'userEmail' => $user['email'],
                            'userName' => $user['full_name'],
                        ]);
                        return redirect()->to(base_url(''));
                    }
                } else {
                    // Password salah
                    session()->setFlashdata('danger', 'Password tidak tepat.');
                    return redirect()->to(base_url('login'));
                }
            } else {
                // Pengguna tidak ditemukan
                session()->setFlashdata('danger', 'Email tidak ditemukan.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $data['validation'] = \Config\Services::validation();
            return view('user/login', $data);
        }
    }

    public function register()
    {
        if (session()->get('user_role')) {

            // Jika sudah login, redirect berdasarkan role
            if (session()->get('user_role') === 'admin') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'owner') {
                return redirect()->to('bali');
            } elseif (session()->get('user_role') === 'customer') {
                redirect()->to('');
            }
        }
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation(),
        ];

        return view('user/register', $data);
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
                'rules' => 'required|valid_email|is_unique[users.email]',
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
        $lastUser = $this->userModel->orderBy('user_id', 'DESC')->first();
        if ($lastUser) {
            $lastId = substr($lastUser['user_id'], 1); // Ambil angka setelah "C"
            $newId = 'C' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Generate ID baru
        } else {
            $newId = 'C001'; // ID pertama
        }

        // Hash password
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Data yang akan disimpan ke database
        $data = [
            'user_id' => $newId,
            'full_name' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('no_hp'),
            'password' => $passwordHash,
            'user_role' => 'customer', // Set user role ke 'customer'
            'created_at' => date('Y-m-d H:i:s'), // Set waktu pembuatan
        ];

        // Simpan data ke database
        $this->userModel->insert($data);

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
