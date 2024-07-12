<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdMatkulToDosen extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dosen', [
            'id_matkul' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('id_matkul', 'matkul', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('dosen', 'dosen_id_matkul_foreign');
        $this->forge->dropColumn('dosen', 'id_matkul');
    }
}
