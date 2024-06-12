<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ForgotPasswordController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->request->getPost('email');
            $credentials = ['email' => $email];
            $user = $this->model->where($credentials)->first();

            if (!$user) {
                session()->setFlashdata('error', 'Email anda tidak terdaftar.');
                return redirect()->back()->withInput();
            }
            session()->set('email', $email);
            return redirect()->to(base_url('auth/recovery-password'));
        }

        // Jika tidak ada data yang dikirimkan melalui POST, tampilkan form
        $data = [
            'title' => 'Forgot Password'
        ];

        return view('auth/forgot-password', $data);
    }
    public function recovery_password()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email_ =  $this->request->getPost('email');
            $password = $this->request->getPost('new_password');
            $confirm_password = $this->request->getPost('confirm_password');

            if ($password !== $confirm_password) {
                session()->setFlashdata('error', 'Password dan Konfirmasi Password tidak cocok.');
                return redirect()->back()->withInput();
            } else {
                $updated = $this->model->where('email', $email_)->set(['password' => $password])->update();
                if ($updated) {
                    session()->remove('email');
                    session()->setFlashdata('success', 'Password berhasil diubah.');
                    return redirect()->to(base_url('auth/login'));
                }
            }
        }
        $data = [
            'email' => session()->get('email'),
            'title' => 'Recovery Password'
        ];

        return view('auth/recovery-password', $data);
    }
}
