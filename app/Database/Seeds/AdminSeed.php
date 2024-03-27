<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeed extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT), // Gantilah dengan password yang lebih aman
                'email' => 'admin@syarifcell.com',
                'nama_lengkap' => 'muhammad maulana',
                'nomor_telpon' => '089723424422',
                'alamat' => 'Bumi',
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'masyarakat',
                'password' => password_hash('user123', PASSWORD_DEFAULT), // Gantilah dengan password yang lebih aman
                'email' => 'user@syarifcell.com',
                'nama_lengkap' => 'muhammad zainudin',
                'nomor_telpon' => '089723424422',
                'alamat' => 'Bumi',
                'role' => 'client',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
