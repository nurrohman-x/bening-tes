<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChatsTable extends Migration
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
            'from_id' => [
                'type'       => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'to_id' => [
                'type'       => 'INT',
                'constraint' => '100',
                'null' => false
            ],
            'message' => [
                'type'       => 'TEXT',
                'null' => false
            ],
            'opened' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default' => 0,
            ],
            'conversation_id' => [
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
        $this->forge->createTable('chats', true);
    }

    public function down()
    {
        $this->forge->dropTable('chats');
    }
}
