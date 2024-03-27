<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        //
        $this->call('AdminSeed');
        $this->call('MerekSeeder');
        $this->call('PerangkatSeeder');
        $this->call('SpesifikasiSeeder');
    }
}
