<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_lengkap'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nomor_telpon'      => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'alamat'      => [
                'type'       => 'TEXT',
            ],
            'role'       => [
                'type'       => 'ENUM',
                'constraint' => ['client', 'admin'],
                'default'    => 'client',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
