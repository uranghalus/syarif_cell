<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMerekTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_merek' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_merek' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_merek', true);
        $this->forge->createTable('merek');
    }

    public function down()
    {
        $this->forge->dropTable('merek');
    }
}
