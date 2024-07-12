<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'id_matkul'];

    public function getDosen($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function getNamaMatkul()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('dosen');
        $builder->select('dosen.*, matkul.matkul');
        $builder->join('matkul', 'matkul.id = dosen.id_matkul', 'left');
        return $builder->get()->getResultArray();
    }

}
