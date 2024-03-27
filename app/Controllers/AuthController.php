<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }
    // LINK Login View
    public function index()
    {
        if ($this->isLoggedIn()) {
            // Redirect ke halaman dashboard atau home sesuai dengan peran pengguna
            return $this->redirectByRole();
        }

        $data = [
            'title' => 'Login Area'
        ];

        return view('auth/login', $data);
    }
    // LINK Login Process
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $credentials = ['email' => $email];

        $user = $this->model->where($credentials)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Email anda tidak terdaftar.');
            return redirect()->back();
        }

        $userPassword = isset($user['password']) ? (string) $user['password'] : null;

        $passwordCheck = password_verify($password, $userPassword);

        if (!$passwordCheck) {
            session()->setFlashdata('error', 'Password yang anda masukkan salah..');
            return redirect()->back();
        }

        $userData = [
            'id' => $user['id'],
            'name' => $user['nama_lengkap'],
            'alamat' => $user['alamat'],
            'nomor_telpon' => $user['nomor_telpon'],
            'email' => $user['email'],
            'role' => $user['role'],
            'logged_in' => TRUE
        ];

        session()->set($userData);

        // Redirect ke halaman dashboard atau home sesuai dengan peran pengguna
        return $this->redirectByRole();
    }
    // LINK Registration View
    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth/register', $data);
    }
    // LINK Registration Store
    public function storeRegistration()
    {
        // Validasi input
        $validationRules = [
            'username' => 'required|alpha_numeric',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'nomor_telpon' => 'required|is_unique[users.nomor_telpon]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ];

        // Lakukan validasi
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $alamat = $this->request->getPost('alamat');
        $nomor_telpon = $this->request->getPost('nomor_telpon');

        // Data untuk tabel 'users'
        $userData = [
            'username' => $username,
            'password' => $password,
            'nama_lengkap' => $nama_lengkap,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'nomor_telpon' => $nomor_telpon,
            'email' => $email,
            'role' => 'client',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert data ke tabel 'users'
        $userId = $this->model->insert($userData);

        if (!$userId) {
            session()->setFlashdata('error', 'Gagal melakukan registrasi.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
        return redirect()->to(base_url('auth/login'));
    }


    // LINK  Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }

    // LINK Logged In Validation
    public function isLoggedIn(): bool
    {
        return session()->get('logged_in') === true;
    }

    //LINK REDIRECT TO DASHBOARD OR HOME BASED ON USER ROLE
    public function redirectByRole()
    {
        $role = session()->get('role');

        if ($role == 'admin') {
            return redirect()->to(base_url('admin/dashboard'));
        } elseif ($role == 'client') {
            return redirect()->to(base_url('/'));
        } else {
            // Redirect sesuai dengan kebijakan untuk peran lainnya
            return redirect()->to(base_url());
        }
    }
}
