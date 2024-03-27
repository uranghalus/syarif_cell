<?php

namespace App\Controllers\Admin;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
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
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'data_perangkat' => $this->PerangkatModel->getPerangkatWithMerek()
        ];
        return view('admin/master-data/perangkat/perangkat_index', $data);
    }
    // LINK Insert View
    public function create()
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'data_merek' => $this->MerekModel->findAll()
        ];
        return view('admin/master-data/perangkat/create_perangkat', $data);
    }
    // LINK Store Data
    public function store()
    {
        $validationRules = [
            'nama_merek' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,500]|ext_in[gambar,jpg,png,gif,webp]',
            'merek_id' => 'required',
            'nama_perangkat' => 'required',
            'tahun_rilis' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];
        $gambar_perangkat = $this->request->getFile('gambar');
        $newNamePerangkat = "PR_" . date('hsmyd') . "." . $gambar_perangkat->getExtension();
        if (!$this->validate($validationRules)) {
            $response = ['error' => $this->validator->getErrors()];
        }

        $data = [
            'id_merek' => $this->request->getPost('id_merek'),
            'nama_perangkat' => $this->request->getPost('nama_perangkat'),
            'tahun_rilis' => $this->request->getPost('tahun_rilis'),
            'harga' => $this->request->getPost('harga'),
            'gambar' => $newNamePerangkat, // Simpan nama file gambar
            'stok' => $this->request->getPost('stok'), // Simpan nama file gambar
            'deskripsi' => $this->request->getPost('deskripsi')
        ];
        // Insert data into user_data table
        $inserted = $this->PerangkatModel->insert($data);
        if ($inserted) {
            $gambar_perangkat->move(ROOTPATH . 'public/uploads', $newNamePerangkat);
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
    // LINK Edit View
    public function edit($id)
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Perangkat',
            'data_merek' => $this->MerekModel->findAll(),
            'data_perangkat' => $this->PerangkatModel->where(["perangkat_id" => $id])->first()
        ];
        return view('admin/master-data/perangkat/edit_perangkat', $data);
    }
    // LINK Update Data
    public function update()
    {
        $id = $this->request->getPost('perangkat_id');
        $validationRules = [
            'gambar' => 'max_size[gambar,500]|ext_in[gambar,jpg,png,gif,webp]',
            'id_merek' => 'required',
            'nama_perangkat' => 'required',
            'tahun_rilis' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            $response = [
                'res' => 'error',
                'message' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response); // Mengembalikan response error jika validasi gagal
        }
        $gambar_perangkat = $this->request->getFile('gambar');
        if ($gambar_perangkat && $gambar_perangkat->isValid() && !$gambar_perangkat->hasMoved()) {
            $perangkat_lama = $this->PerangkatModel->find(esc($id));
            // Cek Foto Lama
            if ($perangkat_lama && isset($perangkat_lama['gambar'])) {
                $fotoLamaPath = ROOTPATH . 'public/uploads/' . $perangkat_lama['foto'];
                if ($fotoLamaPath) {
                    unlink($fotoLamaPath);
                }
            }
            // BUat Nama File Baru
            $newNamePerangkat = "PR_" . date('hsmyd') . "." . $gambar_perangkat->getExtension();
            $gambar_perangkat->move(ROOTPATH . 'public/uploads', $newNamePerangkat);
            $data = [
                'id_merek' => $this->request->getPost('id_merek'),
                'nama_perangkat' => $this->request->getPost('nama_perangkat'),
                'tahun_rilis' => $this->request->getPost('tahun_rilis'),
                'harga' => $this->request->getPost('harga'),
                'gambar' => $newNamePerangkat, // Simpan nama file gambar
                'stok' => $this->request->getPost('stok'), // Simpan nama file gambar
                'deskripsi' => $this->request->getPost('deskripsi')
            ];
        } else {
            $data = [
                'id_merek' => $this->request->getPost('id_merek'),
                'nama_perangkat' => $this->request->getPost('nama_perangkat'),
                'tahun_rilis' => $this->request->getPost('tahun_rilis'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'), // Simpan nama file gambar
                'deskripsi' => $this->request->getPost('deskripsi')
            ];
        }
        // Lakukan Update Data
        $update = $this->PerangkatModel->update($id, $data);
        if ($update) {
            $response = [
                'res' => 'success',
                'message' => 'Data Berhasil Diupdate'
            ];
        } else {
            $response = [
                'res' => 'error',
                'message' => 'Data Gagal Diupdate'
            ];
        }
        return $this->response->setJSON($response);
    }
    // LINK Detail Data
    public function detail($id)
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }

        $data = [
            'pagetitle' =>  'Master Data',
            'title' =>  'Master Data',
            'data_perangkat' => $this->PerangkatModel->getPerangkatByID($id),
            'data_spesifikasi' => $this->SpesifikasiModel->getSpesifikasiByPerangkat($id)
        ];
        return view('admin/master-data/perangkat/perangkat_detail', $data);
    }
}
