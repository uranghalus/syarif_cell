<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCheckoutTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => '0.00',
            ],
            'metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'status_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
            ],
            'bukti_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
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
        $this->forge->createTable('checkout');
    }

    public function down()
    {
        $this->forge->dropTable('checkout');
    }
}
