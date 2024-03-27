<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\PerangkatModel;

class Home extends BaseController
{
    protected $PerangkatModel;
    protected $CardModel;
    protected $authenticate;
    public function __construct()
    {
        helper('shorten');
        $this->authenticate = new AuthController();
        $this->CardModel = new CartModel();
        $this->PerangkatModel =  new PerangkatModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Sistem Pendukung Pemilihan Smartphone - ',
            'latest_perangkat' => $this->PerangkatModel->getLatestPerangkat(4),
            'cart_data' => $this->CardModel->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->countAllResults()
        ];
        return view('home', $data);
    }
}
