<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'perangkat_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            // tambahkan kolom lainnya sesuai kebutuhan Anda
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cart');
    }

    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
