<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AuthController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $authenticate;
    public function __construct()
    {
        $this->authenticate = new AuthController();
    }
    // LINK Dashboard View
    public function index()
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Dashboard Admin',
            'title' => 'Dashboard Admin'
        ];
        return view('admin/dashboard', $data);
    }
}
