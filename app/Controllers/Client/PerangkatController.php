<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Controllers\AuthController;
use App\Models\CartModel;
use App\Models\MerekModel;
use App\Models\PerangkatModel;
use App\Models\SpesifikasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PerangkatController extends BaseController
{

    protected $PerangkatModel;
    protected $MerekModel;
    protected $SpesifikasiModel;
    protected $CardModel;
    protected $authenticate;
    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->MerekModel = new MerekModel();
        $this->authenticate = new AuthController();
        $this->PerangkatModel = new PerangkatModel();
        $this->SpesifikasiModel = new SpesifikasiModel();
        $this->CardModel = new CartModel();
    }
    public function index()
    {
        //
    }
    public function detail($id)
    {
        $data = [
            'pagetitle' => "Detail Perangkat",
            'title' => "Detail Perangkat",
            'cart_data' => $this->CardModel->where('cart.user_id', session()->get('id'))->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->where('cart.user_id', session()->get('id'))->countAllResults(),
            'data_perangkat' => $this->PerangkatModel->getPerangkatByID($id),
            'data_spesifikasi' => $this->SpesifikasiModel->getSpesifikasiByPerangkat($id)
        ];
        return view('perangkat/perangkat_detail', $data);
    }
}
