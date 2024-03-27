<?php

namespace App\Controllers\Client;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CheckoutDetailModel;
use App\Models\CheckoutModel;
use App\Models\PerangkatModel;
use CodeIgniter\HTTP\ResponseInterface;

class CheckoutController extends BaseController
{
    protected $authenticate;
    protected $CardModel;
    protected $CheckoutModel;
    protected $CheckoutDetailModel;
    protected $PerangkatModel;

    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->authenticate = new AuthController();
        $this->CardModel = new CartModel();
        $this->CheckoutModel = new CheckoutModel();
        $this->CheckoutDetailModel = new CheckoutDetailModel();
        $this->PerangkatModel = new PerangkatModel();
    }
    public function index()
    {
        $user_id = session()->get('id');
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        //
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Checkout',
            'cart_data' => $this->CardModel->where('cart.user_id', $user_id)->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->where('cart.user_id', $user_id)->countAllResults(),
            'total_price' => $this->CardModel->calculateTotalPrice($user_id)
        ];
        return view('checkout/checkout_index', $data);
    }
    // LINK Checkout Action
    public function action()
    {
        $metode_bayar = $this->request->getPost('metode_pembayaran');
        $total_bayar = $this->request->getPost('total_price');
        $cart_data = $this->request->getPost('cart_data');
        // Simpan data checkout

        $checkoutData = [
            'id' => date('hsmyd'),
            'user_id' => session()->get('id'), // Sesuaikan dengan session user Anda
            'total_harga' => $total_bayar,
            'metode_pembayaran' => $metode_bayar,
            'status_pembayaran' => ($metode_bayar == "Transfer") ? 'Belum Dibayar' : "Menunggu Verifikasi Admin", // Atur status pembayaran default
        ];
        $checkoutId = $this->CheckoutModel->insert($checkoutData);
        // Simpan detail checkout perangkat
        foreach ($cart_data as $cd) {
            $data = [
                'checkout_id' => $checkoutId,
                'perangkat_id' => $cd['perangkat_id'],
                'quantity' => $cd['quantity'],
                'harga' => $cd['item_price']
            ];
            // masukkan ke database
            $insertdetail = $this->CheckoutDetailModel->insert($data);
            if ($insertdetail) {
                $item = $this->PerangkatModel->find($cd['perangkat_id']);
                $data_stok = $item['stok'] - $cd['quantity'];
                $dataupdateStok =  [
                    'stok' => $data_stok,
                ];
                $updatestok = $this->PerangkatModel->update($cd['perangkat_id'], $dataupdateStok);
                if ($updatestok) {
                    $deleted = $this->CardModel->delete($cd['id']);
                    if ($deleted) {
                        $response = [
                            'res' => 'success',
                            'message' => 'Anda Berhasil Melakukan Pembelian.'
                        ];
                    } else {
                        $response = [
                            'res' => 'error',
                            'message' => 'Anda Gagal Melakukan Pembelian.'
                        ];
                    }
                } else {
                    $response = [
                        'res' => 'error',
                        'message' => 'Ada Masalah Pada Update Stok'
                    ];
                }
            } else {
                $response = [
                    'res' => 'error',
                    'message' => 'Ada Masalah Pada Insert Detail'
                ];
            }
        }

        return $this->response->setJSON($response);
    }
}
