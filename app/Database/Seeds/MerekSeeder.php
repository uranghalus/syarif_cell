<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MerekSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'nama_merek' => 'Samsung',
                'foto' => 'samsung.png'
            ],
            [
                'nama_merek' => 'Apple',
                'foto' => 'apple.png'
            ],
            [
                'nama_merek' => 'Xiaomi',
                'foto' => 'xiaomi.png'
            ],
        ];

        // Using Query Builder
        $this->db->table('merek')->insertBatch($data);
    }
}
