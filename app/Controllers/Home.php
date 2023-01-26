<?php

namespace App\Controllers;

use App\Models\JenisModel;
use App\Models\FasilitasModel;

class Home extends BaseController
{
    protected $jenis;
    protected $fasilitas;
    public function __construct() {
        $this->jenis = new JenisModel();
        $this->fasilitas = new FasilitasModel();
    }
    public function index()
    {
        $jenis = $this->jenis->asObject()->findAll();
        foreach ($jenis as $key => $value) {
            $value->fasilitas = $this->fasilitas->where('jenis_kamar_id', $value->id)->findAll();
        }
        $data = ['data'=>$jenis];
        return view('home', $data);
    }
}
