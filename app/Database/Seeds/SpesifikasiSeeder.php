<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SpesifikasiSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            // Spesifikasi untuk Samsung Galaxy S21
            [
                'perangkat_id' => 1,
                'jenis_spesifikasi' => 'RAM',
                'nilai_spesifikasi' => '8 GB'
            ],
            [
                'perangkat_id' => 1,
                'jenis_spesifikasi' => 'ROM',
                'nilai_spesifikasi' => '128 GB, 256 GB'
            ],
            [
                'perangkat_id' => 1,
                'jenis_spesifikasi' => 'Kamera',
                'nilai_spesifikasi' => '12 MP + 64 MP + 12 MP'
            ],
            [
                'perangkat_id' => 1,
                'jenis_spesifikasi' => 'Baterai',
                'nilai_spesifikasi' => '4000 mAh'
            ],
            [
                'perangkat_id' => 1,
                'jenis_spesifikasi' => 'Chipset',
                'nilai_spesifikasi' => 'Exynos 2100'
            ],
            // Tambahkan spesifikasi lainnya untuk Samsung Galaxy S21 dan perangkat lainnya
        ];

        // Spesifikasi untuk iPhone 12 Pro
        $data[] = [
            'perangkat_id' => 2,
            'jenis_spesifikasi' => 'RAM',
            'nilai_spesifikasi' => '6 GB'
        ];
        $data[] = [
            'perangkat_id' => 2,
            'jenis_spesifikasi' => 'ROM',
            'nilai_spesifikasi' => '128 GB, 256 GB, 512 GB'
        ];
        $data[] = [
            'perangkat_id' => 2,
            'jenis_spesifikasi' => 'Kamera',
            'nilai_spesifikasi' => '12 MP + 12 MP + 12 MP'
        ];
        $data[] = [
            'perangkat_id' => 2,
            'jenis_spesifikasi' => 'Baterai',
            'nilai_spesifikasi' => '2815 mAh'
        ];
        $data[] = [
            'perangkat_id' => 2,
            'jenis_spesifikasi' => 'Chipset',
            'nilai_spesifikasi' => 'A14 Bionic'
        ];
        // Tambahkan spesifikasi lainnya untuk iPhone 12 Pro dan perangkat lainnya

        // Insert batch data menggunakan Query Builder
        $this->db->table('spesifikasi')->insertBatch($data);
    }
}
