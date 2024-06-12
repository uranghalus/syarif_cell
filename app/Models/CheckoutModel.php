<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table            = 'checkout';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'total_harga', 'metode_pembayaran', 'status_pembayaran', 'bukti_pembayaran', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
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

    public function getCheckoutData()
    {
        $checkouts = $this->findAll(); // Ambil semua data checkout

        // Loop melalui setiap checkout untuk menambahkan detail perangkat
        foreach ($checkouts as &$checkout) {
            $checkout['perangkat'] = $this->getPerangkatByCheckoutId($checkout['id']);
        }

        return $checkouts;
    }
    public function getDataCheckout($where = null)
    {
        $builder = $this->db->table('checkout')
            ->select('
                 checkout.id AS checkout_id,checkout.total_harga,checkout.created_at AS tanggal_pembelian, checkout.metode_pembayaran,checkout.status_pembayaran,checkout.bukti_pembayaran,checkout_detail.id AS checkout_detail_id, checkout_detail.quantity,users.nama_lengkap,users.nomor_telpon,perangkat.nama_perangkat,perangkat.harga,merek.nama_merek
            ')
            ->join('checkout_detail', 'checkout.id = checkout_detail.checkout_id')
            ->join('users', 'checkout.user_id = users.id')
            ->join('perangkat', 'checkout_detail.perangkat_id = perangkat.perangkat_id')
            ->join('merek', 'perangkat.id_merek = merek.id_merek');
        if ($where !== null) {
            $builder->where('checkout.user_id', $where);
        }
        return $builder->get()->getResultArray();
    }
    public function getDetailCheckout($where = null)
    {
        $builder = $this->db->table('checkout')
            ->select('
                 checkout.id AS checkout_id,checkout.total_harga,checkout.created_at AS tanggal_pembelian, checkout.metode_pembayaran,checkout.status_pembayaran,checkout.bukti_pembayaran,checkout_detail.id AS checkout_detail_id, checkout_detail.quantity,users.nama_lengkap,users.nomor_telpon,users.email,perangkat.nama_perangkat,perangkat.harga,merek.nama_merek
            ')
            ->join('checkout_detail', 'checkout.id = checkout_detail.checkout_id')
            ->join('users', 'checkout.user_id = users.id')
            ->join('perangkat', 'checkout_detail.perangkat_id = perangkat.perangkat_id')
            ->join('merek', 'perangkat.id_merek = merek.id_merek');
        if ($where !== null) {
            $builder->where($where);
        }
        return $builder->get()->getRowArray();
    }
    public function getOrdersByStatus($statuses)
    {
        $builder = $this->db->table('checkout')
            ->select('checkout.id as checkout_id , checkout.created_at AS tanggal_pembelian, checkout.status_pembayaran')
            ->whereIn('checkout.status_pembayaran', $statuses);
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getPerangkatByCheckoutId($checkoutId)
    {
        return $this->db->table('checkout_detail')
            ->select('perangkat.*, checkout_detail.quantity, checkout_detail.harga')
            ->join('perangkat', 'checkout_detail.perangkat_id = perangkat.perangkat_id')
            ->where('checkout_id', $checkoutId)
            ->get()
            ->getResultArray();
    }
}
