<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_1' => [
                'type'       => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'user_2' => [
                'type'       => 'INT',
                'constraint' => '100',
                'null' => false
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('conversations', true);
    }

    public function down()
    {
        $this->forge->dropTable('conversations');
    }
}
