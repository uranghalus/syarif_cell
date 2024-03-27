<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCheckoutDetailTable extends Migration
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
            'checkout_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'perangkat_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => '0.00',
            ],
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
        $this->forge->createTable('checkout_detail');
    }

    public function down()
    {
        $this->forge->dropTable('checkout_detail');
    }
}
