<?php

namespace App\Controllers\Client;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CheckoutDetailModel;
use App\Models\CheckoutModel;
use App\Models\PerangkatModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    protected $authenticate;
    protected $CheckoutModel;
    protected $CheckoutDetailModel;
    protected $CardModel;
    protected $PerangkatModel;

    public function __construct()
    {
        // parent::__construct();
        $this->helpers = ['form', 'url', 'validation'];
        $this->authenticate = new AuthController();
        $this->CheckoutModel = new CheckoutModel();
        $this->CheckoutDetailModel = new CheckoutDetailModel();
        $this->CardModel = new CartModel();
        $this->PerangkatModel = new PerangkatModel();
    }

    public function index()
    {
        //
        $user_id = session()->get('id');
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Checkout',
            'cart_data' => $this->CardModel->where('cart.user_id', $user_id)->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->where('cart.user_id', $user_id)->countAllResults(),
            'order_data' => $this->CheckoutModel->where('user_id', $user_id)->getCheckoutData()
        ];
        return view('order/order_index', $data);
    }
    // LINK Delete 
    public function delete($id)
    {
        // Cari Perangkat
        $perangkat = $this->CheckoutDetailModel->where(["checkout_id" => $id])->findAll();
        foreach ($perangkat as $data) {
            $data_perangkat = $this->PerangkatModel->find($data['perangkat_id']);
            $qty_detail = $this->CheckoutDetailModel->where(['perangkat_id' => $data['perangkat_id']])->find();

            $data_updated = [
                'stok' => $data_perangkat['stok'] + $qty_detail[0]['quantity']
            ];

            $this->PerangkatModel->update($data['perangkat_id'], $data_updated);
        }
        // Hapus data di table checkout dan detail checkout berdasarkan id checkoutny
        $deletedcheckoutdetail = $this->CheckoutDetailModel->where(["checkout_id" => $id])->delete();
        if ($deletedcheckoutdetail) {
            $deleteCheckout = $this->CheckoutModel->delete($id);
            if ($deleteCheckout) {
                $response = [
                    'res' => 'success',
                    'message' => 'Data Berhasil Dihapus'
                ];
            }
        }
        return $this->response->setJSON($response);
    }
    // LINK Upload Bukti
    public function uploadbukti($id)
    {
        $user_id = session()->get('id');
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Upload Bukti Pembayaran',
            'cart_data' => $this->CardModel->where('cart.user_id', $user_id)->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->where('cart.user_id', $user_id)->countAllResults(),
            'data_pembelian' => $this->CheckoutModel->find($id)
        ];
        return view('order/upload_bukti', $data);
    }
    // LINK do upload
    public function do_upload()
    {
        $id = $this->request->getPost('id'); // Menggunakan getPost() untuk mendapatkan id dari form

        $validationRules = [
            'bukti_pembayaran' => 'max_size[bukti_pembayaran,500]|ext_in[bukti_pembayaran,jpg,png,gif,webp]',
        ];

        if (!$this->validate($validationRules)) {
            $response = [
                'res' => 'error',
                'message' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response); // Mengembalikan response error jika validasi gagal
        }

        $foto_bukti = $this->request->getFile('bukti_pembayaran');

        // Cek apakah ada file foto baru diupload
        if ($foto_bukti && $foto_bukti->isValid() && !$foto_bukti->hasMoved()) {
            // Pindahkan foto baru
            $newName = "BU_" . date('his') . "." . $foto_bukti->getExtension();
            $foto_bukti->move(ROOTPATH . 'public/uploads', $newName);

            // Update data dengan foto baru
            $data = [
                'status_pembayaran' => "Sedang Diverifikasi Admin",
                'bukti_pembayaran' => $newName,
            ];
        } else {
            // Jika tidak ada file baru diupload, tetap update data tanpa mengubah foto
            $data = [
                'status_pembayaran' => "Sedang Diverifikasi Admin",
            ];
        }

        // Update data ke CheckoutModel
        $updated = $this->CheckoutModel->update($id, $data);

        if ($updated) {
            $response = [
                'res' => 'success',
                'message' => 'Bukti Berhasil Di Upload'
            ];
        } else {
            $response = [
                'res' => 'error',
                'message' => 'Gagal memperbarui data'
            ];
        }

        return $this->response->setJSON($response);
    }
    // LINK Konfrimasi
    public function konfirmasi($id)
    {
        // Ambil data checkout berdasarkan id yang dikirim
        $checkout = $this->CheckoutModel->find($id);
        // Cek apakah ada
        if (empty($checkout)) {
            $response = [
                'res' => 'error',
                'message' => 'Data Tidak DItemukan'
            ];
        }
        // Jika Ada
        else {
            // Buat sebuah array untuk menampung data yang akan kita insert ke table User
            $data = [
                'status_pembayaran' => "Barang Diterima" // Update status_pembayaran sesuai dengan nilai jenis dari URL
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
