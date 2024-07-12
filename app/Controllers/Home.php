<?php

namespace App\Controllers;

use App\Models\DosenModel;

class Home extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $id_matkul = 1;
        $data['dosen'] = $this->dosenModel->findAll();
        $data['dosen'] = $this->dosenModel->getNamaMatkul($id_matkul);

        return view('index', $data);
    }
}
