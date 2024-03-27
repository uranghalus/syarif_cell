<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerangkatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'perangkat_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_merek' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'nama_perangkat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tahun_rilis' => [
                'type'       => 'YEAR',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'stok' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'    => null,
            ],
        ]);
        $this->forge->addKey('perangkat_id', true);
        $this->forge->addForeignKey('id_merek', 'merek', 'id_merek');
        $this->forge->createTable('perangkat');
    }

    public function down()
    {
        $this->forge->dropTable('perangkat');
    }
}
