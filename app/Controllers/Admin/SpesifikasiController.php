<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AuthController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PerangkatModel;
use App\Models\SpesifikasiModel;

class SpesifikasiController extends BaseController
{
    protected $PerangkatModel;
    protected $SpesifikasiModel;
    protected $authenticate;

    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->authenticate = new AuthController();
        $this->PerangkatModel = new PerangkatModel();
        $this->SpesifikasiModel = new SpesifikasiModel();
    }
    public function index($id)
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'data_perangkat' => $this->PerangkatModel->getPerangkatByID($id),
            'data_spesifikasi' => $this->SpesifikasiModel->getSpesifikasiByPerangkat($id)
        ];
        return view('admin/master-data/spesifikasi/spesifikasi_index', $data);
    }
    // LINK Create Spesifikasi
    public function create_spesifikasi($id)
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'perangkat_id' => $id,
        ];
        return view('admin/master-data/spesifikasi/spesifikasi_create', $data);
    }
    // LINK Store Spesifikasi
    public function store_spesifikasi()
    {
        // Validation
        $validationRules = [
            'jenis_spesifikasi' => 'required',
            'nilai_spesifikasi' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            $response = ['error' => $this->validator->getErrors()];
        }
        // Success Save Data
        else {
            $data = [
                'perangkat_id' => $this->request->getPost('perangkat_id'),
                'jenis_spesifikasi' => $this->request->getPost('jenis_spesifikasi'),
                'nilai_spesifikasi' => $this->request->getPost('nilai_spesifikasi'),
            ];
            $inserted = $this->SpesifikasiModel->insert($data);
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
        }
        return $this->response->setJSON($response);
    }
    // LINK delete  spesifikasi
    public function delete_spesifikasi($id)
    {
        $deleted = $this->SpesifikasiModel->delete(['spesifikasi_id' => $id]);
        if ($deleted) {
            $response = [
                'res' => 'success',
                'message' => 'Data berhasil dihapus'
            ];
        } else {
            $response = [
                'res' => 'error',
                'message' => 'Data gagal dihapus'
            ];
        }
        return $this->response->setJSON($response);
    }
    // LINK edit spesifikasi
    public function edit_spesifikasi($id)
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'data_spesifikasi' => $this->SpesifikasiModel->find($id)
        ];
        return view('admin/master-data/spesifikasi/spesifikasi_edit', $data);
    }
    // LINK Update Spesifikasi
    public function update_spesifikasi()
    {
        $id = $this->request->getPost('spesifikasi_id');
        $validationRules = [
            'jenis_spesifikasi' => 'required',
            'nilai_spesifikasi' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            $response = ['error' => $this->validator->getErrors()];
        }
        // Success Save Data
        else {
            $data = [
                'jenis_spesifikasi' => $this->request->getPost('jenis_spesifikasi'),
                'nilai_spesifikasi' => $this->request->getPost('nilai_spesifikasi'),
            ];
            $update = $this->SpesifikasiModel->update($id, $data);
            if ($update) {
                $response = [
                    'res' => 'success',
                    'message' => 'Data Berhasil Di Update'
                ];
            } else {
                $response = [
                    'res' => 'error',
                    'message' => 'Gagal Memperbaharui data'
                ];
            }
        }
        return $this->response->setJSON($response);
    }
}
