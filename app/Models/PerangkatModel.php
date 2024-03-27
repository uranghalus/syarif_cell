<?php

namespace App\Models;

use CodeIgniter\Model;

class PerangkatModel extends Model
{
    protected $table            = 'perangkat';
    protected $primaryKey       = 'perangkat_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_merek', 'nama_perangkat', 'tahun_rilis', 'harga', 'gambar', 'deskripsi', 'stok'];

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

    public function getPerangkatWithMerek()
    {
        $builder = $this->db->table('perangkat')
            ->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek');
        return $builder->get()->getResultArray();
    }
    public function reportPerangkatByMerek($merek = null, $tahun = null)
    {
        $builder = $this->db->table('perangkat')
            ->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek');
        $builder->where('perangkat.id_merek', $merek);
        $builder->orWhere('perangkat.tahun_rilis', $tahun);
        return $builder->get()->getResultArray();
    }
    public function reportPerangkatByCreated($where = null)
    {
        $builder = $this->db->table('perangkat')
            ->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek');
        $builder = $this->db->table('perangkat')
            ->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek');

        if ($where !== null) {
            $builder->where($where);
        }
        return $builder->get()->getResultArray();
    }
    public function getLatestPerangkat($limit)
    {
        return $this->db->table('perangkat')
            ->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
    public function getPerangkatByID($perangkat_id)
    {
        return $this->select('perangkat.*, merek.*')
            ->join('merek', 'merek.id_merek = perangkat.id_merek')
            ->where('perangkat.perangkat_id', $perangkat_id)
            ->first();
    }
}
