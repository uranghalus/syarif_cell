<?php

namespace App\Controllers\Admin;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
use App\Models\MerekModel;
use CodeIgniter\HTTP\ResponseInterface;

class MerekController extends BaseController
{
    protected $MerekModel;
    protected $authenticate;
    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->MerekModel = new MerekModel();
        $this->authenticate = new AuthController();
    }
    public function index()
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Merek',
            'data_merek' => $this->MerekModel->findAll()
        ];
        return view('admin/master-data/merek/merek_index', $data);
    }
    // LINK Insert View
    public function create()
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Merek',
        ];
        return view('admin/master-data/merek/create_merek', $data);
        //
    }
    // LINK Store Data
    public function store()
    {
        $validationRules = [
            'nama_merek' => 'required',
            'foto' => 'max_size[foto,500]|ext_in[foto,jpg,png,gif,webp]',
        ];

        if (!$this->validate($validationRules)) {
            $response = ['error' => $this->validator->getErrors()];
        }
        $foto_merek = $this->request->getFile('foto');
        $newNameMerek = "IP_" . date('hsmyd') . "." . $foto_merek->getExtension();
        $foto_merek->move(ROOTPATH . 'public/uploads', $newNameMerek);

        $data = [
            'nama_merek' => $this->request->getPost('nama_merek'),
            'foto' => $newNameMerek,
        ];
        // Insert data into user_data table
        $inserted = $this->MerekModel->insert($data);
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
    // LINK edit
    public function edit($id)
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Master Data',
            'title' => 'Master Data Merek',
            'data_merek' => $this->MerekModel->find($id)
        ];
        return view('admin/master-data/merek/edit_merek', $data);
    }
    // LINK Update Merek
    public function update()
    {
        $id = $this->request->getPost('id_merek'); // Menggunakan getPost() untuk mendapatkan id_merek dari form

        $validationRules = [
            'nama_merek' => 'required',
            'foto' => 'max_size[foto,500]|ext_in[foto,jpg,png,gif,webp]',
        ];

        if (!$this->validate($validationRules)) {
            $response = [
                'res' => 'error',
                'message' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response); // Mengembalikan response error jika validasi gagal
        }

        $foto_merek = $this->request->getFile('foto');

        // Cek apakah ada file foto baru diupload
        if ($foto_merek && $foto_merek->isValid() && !$foto_merek->hasMoved()) {
            // Hapus foto lama jika ada
            $merekLama = $this->MerekModel->find($id);
            if ($merekLama && isset($merekLama['foto'])) { // Memeriksa apakah ada foto lama
                $fotoLamaPath = ROOTPATH . 'public/uploads/' . $merekLama['foto'];
                if (file_exists($fotoLamaPath)) {
                    unlink($fotoLamaPath);
                }
            }

            // Pindahkan foto baru
            $newNameMerek = "IP_" . date('hsmyd') . "." . $foto_merek->getExtension();
            $foto_merek->move(ROOTPATH . 'public/uploads', $newNameMerek);

            // Update data dengan foto baru
            $data = [
                'nama_merek' => $this->request->getPost('nama_merek'),
                'foto' => $newNameMerek,
            ];
        } else {
            // Jika tidak ada file baru diupload, tetap update data tanpa mengubah foto
            $data = [
                'nama_merek' => $this->request->getPost('nama_merek'),
            ];
        }

        // Update data ke MerekModel
        $updated = $this->MerekModel->update($id, $data);

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
    // LINK Delete
    public function delete($id)
    {
        // Cek apakah id-nya ada didatabase atau tidak
        $cekId = $this->MerekModel->find($id);
        if (empty($cekId)) {
            $response = [
                'res' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ];
        } else {
            // Hapus Data dari database berdasarkan id-nya
            $deleted = $this->MerekModel->delete($id);
            if ($deleted) {
                $response = [
                    'res' => 'success',
                    'message' => 'Data Berhasil Dihapus'
                ];
            } else {
                $response = [
                    'res' => 'error',
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        return $this->response->setJSON($response);
    }
}
