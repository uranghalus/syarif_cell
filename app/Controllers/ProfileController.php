<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    protected $authenticate;
    protected $userModel;

    protected $CardModel;
    public function __construct()
    {
        $this->authenticate = new AuthController();
        $this->userModel = new UserModel();
        $this->CardModel = new CartModel();
    }
    public function index()
    {
        $role = session()->get('role');
        $userdata = session()->get('id');
        //
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => ($role == "admin") ? 'Profile Admin' :  'Profile User',
            'title' => ($role == "admin") ? 'Profile Admin' :  'Profile User',
            'user_data' => $this->userModel->find($userdata)
        ];
        if ($role == "client") {
            $data['cart_data'] = $this->CardModel->where('cart.user_id', session()->get('id'))->getCartWithPerangkat();
            $data['count_cart'] = $this->CardModel->where('cart.user_id', session()->get('id'))->countAllResults();
        }
        if ($role == "admin") {
            return view('admin/profile/profile_index', $data);
        } else {
            return view('profile/profile_index', $data);
        }
    }
    // LINK Update
    public function update()
    {;
        $user_id = $this->request->getPost('id');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $nomor_telpon = $this->request->getPost('nomor_telpon');
        $alamat = $this->request->getPost('alamat');
        $old_password = $this->request->getPost('old_password');
        $new_password = $this->request->getPost('new_password');

        $user = $this->userModel->where('id', $user_id)->first();
        $password = $user['password'];

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'username' => $username,
            'nomor_telpon' => $nomor_telpon,
            'alamat' => $alamat,
        ];

        // Inisialisasi response dengan nilai default
        $response = [
            'res' => 'error',
            'message' => 'Gagal memperbarui data'
        ];

        if ($old_password != null) {
            $verifyPassword = password_verify($old_password, $password);
            if ($verifyPassword) {
                if ($new_password != null) {
                    $new_password2 = password_hash($new_password, PASSWORD_DEFAULT);
                    $data['password'] = $new_password2;
                }
            } else {
                $response = [
                    'res' => 'error',
                    'message' => 'Password Lama Salah'
                ];
                return $this->response->setJSON($response);
            }
        }

        $updated = $this->userModel->update($user_id, $data);
        if ($updated) {
            $response = [
                'res' => 'success',
                'message' => 'Data Berhasil Diupdate'
            ];
        }

        return $this->response->setJSON($response);
    }
}
