<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerangkatSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'id_merek' => 1,
                'nama_perangkat' => 'Samsung Galaxy S21',
                'tahun_rilis' => 2021,
                'harga' => 12000000.00,
                'gambar' => 's21.jpg',
                'deskripsi' => 'Samsung flagship smartphone',
                'stok' => 100,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_merek' => 2,
                'nama_perangkat' => 'iPhone 12 Pro',
                'tahun_rilis' => 2020,
                'harga' => 13000000.00,
                'gambar' => 'iphone12pro.jpg',
                'deskripsi' => 'Apple flagship smartphone',
                'stok' => 80,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_merek' => 3,
                'nama_perangkat' => 'Xiaomi Mi 11',
                'tahun_rilis' => 2021,
                'harga' => 9000000.00,
                'gambar' => 'mi11.jpg',
                'deskripsi' => 'Xiaomi flagship smartphone',
                'stok' => 120,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_merek' => 1,
                'nama_perangkat' => 'Samsung Galaxy Note 20 Ultra',
                'tahun_rilis' => 2020,
                'harga' => 14000000.00,
                'gambar' => 'note20ultra.jpg',
                'deskripsi' => 'Samsung flagship smartphone with S Pen',
                'stok' => 70,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_merek' => 2,
                'nama_perangkat' => 'iPhone SE (2020)',
                'tahun_rilis' => 2020,
                'harga' => 7000000.00,
                'gambar' => 'iphonese.jpg',
                'deskripsi' => 'Affordable iPhone with flagship features',
                'stok' => 90,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_merek' => 3,
                'nama_perangkat' => 'Xiaomi Redmi Note 10 Pro',
                'tahun_rilis' => 2021,
                'harga' => 3500000.00,
                'gambar' => 'note10pro.jpg',
                'deskripsi' => 'Affordable Xiaomi smartphone with great features',
                'stok' => 150,
                'created_at' => date('Y-m-d H:i:s')
            ],
            // Tambahkan data perangkat lainnya sesuai kebutuhan
        ];
        // Insert batch data menggunakan Query Builder
        $this->db->table('perangkat')->insertBatch($data);
    }
}
