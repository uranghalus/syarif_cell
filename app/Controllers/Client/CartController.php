<?php

namespace App\Controllers\Client;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
use App\Models\CartModel;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    protected $CardModel;
    protected $authenticate;
    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation', 'session'];
        $this->authenticate = new AuthController();
        $this->CardModel = new CartModel();
    }
    public function index()
    {
        //
    }
    // Add Cart
    public function addToCart($id)
    {
        $data = [
            'perangkat_id' => $id,
            'quantity' => 1,
            'user_id' => session()->get('id')
        ];
        $inserted = $this->CardModel->insert($data);
        if ($inserted) {
            $response = [
                'res' => 'success',
                'message' => 'Data Berhasil Disimpan'
            ];
        } else {
            $response = [
                'res' => 'error',
                'message' => 'Gagal menyimpan data'
            ];
        }
        return $this->response->setJSON($response);
    }
}
