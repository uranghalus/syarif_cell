<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use CodeIgniter\HTTP\ResponseInterface;

class NotificationController extends BaseController
{
    protected $CheckoutModel;
    public function __construct()
    {
        $this->CheckoutModel = new CheckoutModel();
    }
    public function index()
    {
        //
        $statuses = ['Menunggu Verifikasi Admin', 'Belum Dibayar', 'Barang Diterima'];
        $notifications = $this->CheckoutModel->getOrdersByStatus($statuses);

        return $this->response->setJSON($notifications);
    }
}
