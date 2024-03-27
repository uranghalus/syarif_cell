<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\AuthController;
use App\Models\CheckoutDetailModel;
use App\Models\CheckoutModel;

class OrderController extends BaseController
{

    protected $CheckoutModel;
    protected $CheckoutDetailModel;
    protected $authenticate;
    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->authenticate = new AuthController();
        $this->CheckoutModel = new CheckoutModel();
        $this->CheckoutDetailModel = new CheckoutDetailModel();
    }
    public function index()
    {
        //
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Data Pembelian',
            'title' => 'Data Pembelian',
            'data_pembelian' => $this->CheckoutModel->getDataCheckout()
        ];
        return view('admin/order/order_index', $data);
    }
    // LINK Detail 
    public function detail($id)
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }

        $where = ['checkout_id' => $id];
        $data = [
            'pagetitle' => 'Data Pembelian',
            'title' => 'Data Pembelian',
            'data_pembelian' => $this->CheckoutModel->getDetailCheckout($where),
            'data_checkout' => $this->CheckoutDetailModel->getCheckoutDetail($where),
        ];

        // Mengembalikan view dengan data yang sudah diproses
        return view('admin/order/order_detail', $data);
    }
    // LINK Verifikasi
    public function verif($id)
    {
        $nilai_verif = $this->request->getGet('jenis');
        if ($nilai_verif == "tolak") {
            $data = [
                'status_pembayaran' => "Pembayaran Ditolak" // Update status_pembayaran sesuai dengan nilai jenis dari URL
            ];
        } else {
            $data = [
                'status_pembayaran' => "Proses Kirim" // Update status_pembayaran sesuai dengan nilai jenis dari URL
            ];
        }
        $updated = $this->CheckoutModel->update($id, $data);
        if ($updated) {
            $response = [
                'res' => 'success',
                'message' => 'Data Berhasil Diupdate'
            ];
        } else {
            $response = [
                'res' => 'error',
                'message' => 'Gagal memperbarui data'
            ];
        }

        return $this->response->setJSON($response);
    }
}
