<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisModel;
use App\Models\KamarModel;
use App\Models\ReservasiModel;
use App\Models\TamuModel;

class Reservasi extends BaseController
{
    protected $reservasi;
    public function __construct() {
        $this->reservasi = new ReservasiModel();
    }
    public function index()
    {
        return view('admin/reservasi');
    }

    public function tambah()
    {
        return view('admin/tambah_reservasi');
    }

    public function store()
    {
        $reservasi = new ReservasiModel();
        $data = $this->reservasi->select(" `reservasi`.*,
        `tamu`.`nama`,
        `tamu`.`gender`,
        `tamu`.`alamat`,
        `tamu`.`telp`,
        `tamu`.`email`,
        `kamar`.`kode_kamar`,
        `kamar`.`jenis_kamar_id`,
        `jenis_kamar`.`nama` AS `jenis_kamar`")
        ->join("kamar", "`reservasi`.`kamar_id` = `kamar`.`id`", "LEFT")
        ->join("tamu", "`reservasi`.`tamu_id` = `tamu`.`id`", "LEFT")
        ->join("jenis_kamar", "`kamar`.`jenis_kamar_id` = `jenis_kamar`.`id`", "LEFT")
        ->findAll();
        return $this->respond($data);
    }

    public function update()
    {
        $data = $this->request->getJSON();
        try {
            if($this->reservasi->update($data->id, ['status'=>$data->status])){
                return $this->respondUpdated(true);
            }else{
                throw new \Exception("Error Processing Request", 1);
            }
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
