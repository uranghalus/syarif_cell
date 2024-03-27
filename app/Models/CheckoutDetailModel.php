<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutDetailModel extends Model
{
    protected $table            = 'checkout_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['checkout_id', 'perangkat_id', 'quantity', 'harga', 'created_at', 'updated_at'];

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
    public function getCheckoutDetail($where = null)
    {
        $builder = $this->db->table('checkout_detail')
            ->select('perangkat.*, merek.nama_merek, checkout_detail.quantity, checkout_detail.harga AS harga_perangkat')
            ->join('perangkat', 'perangkat.perangkat_id = checkout_detail.perangkat_id')
            ->join('merek', 'merek.id_merek = perangkat.id_merek');

        if ($where !== null) {
            $builder->where($where);
        }

        return $builder->get()->getResultArray();
    }
}
