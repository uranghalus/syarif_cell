<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'cart';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['perangkat_id', 'quantity', 'user_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function getCartWithPerangkat()
    {
        // Lakukan join antara tabel cart dan perangkat
        return $this->select('cart.*, perangkat.nama_perangkat, perangkat.perangkat_id, perangkat.harga ,perangkat.gambar')
            ->join('perangkat', 'perangkat.perangkat_id = cart.perangkat_id')
            ->findAll();
    }
    public function calculateTotalPrice($user_id)
    {
        // Mengambil semua data dari tabel cart
        $cartItems = $this->where('user_id', $user_id)->findAll();

        // Inisialisasi variabel total harga
        $totalPrice = 0;

        // Menghitung total harga dengan menjumlahkan harga per item
        foreach ($cartItems as $item) {
            // Mengambil harga perangkat dari tabel perangkat berdasarkan perangkat_id
            $perangkatModel = new PerangkatModel();
            $perangkat = $perangkatModel->find($item['perangkat_id']);

            // Jika perangkat ditemukan, tambahkan harga perangkat * quantity ke total harga
            if ($perangkat) {
                $totalPrice += $perangkat['harga'] * $item['quantity'];
            }
        }

        return $totalPrice;
    }
}
