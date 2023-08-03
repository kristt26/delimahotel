<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservasiModel;

class Dashboard extends BaseController
{
    protected $reservasi;
    public function __construct()
    {
        $this->reservasi = new ReservasiModel();
    }
    public function index()
    {
        // return view("admin/dashboard");
        return view("admin/dashboard");
    }

    public function store()
    {
        $tanggal = date('Y-m-d');
        $data['this'] = $this->reservasi->where("checkin='$tanggal'")->countAllResults();
        $data['all'] = $this->reservasi->countAllResults();
        
        return $this->respond($data);
    }
}
