<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\PerangkatModel;
use CodeIgniter\HTTP\ResponseInterface;

class GaleryController extends BaseController
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
        //
        $data = [
            'title' => 'Galery Smartphone',
            'latest_perangkat' => $this->PerangkatModel->getLatestPerangkat(4),
            'data_perangkat' => $this->PerangkatModel->getPerangkatWithMerek(),
            'cart_data' => $this->CardModel->getCartWithPerangkat(),
            'count_cart' => $this->CardModel->countAllResults()
        ];
        return view('galery', $data);
    }
}
