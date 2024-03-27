<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSpesifikasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'spesifikasi_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'jenis_spesifikasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nilai_spesifikasi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('spesifikasi_id', true);
        $this->forge->addForeignKey('perangkat_id', 'perangkat', 'perangkat_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spesifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('spesifikasi');
    }
}
