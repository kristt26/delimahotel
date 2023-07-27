<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\DetailLaundryModel;
use App\Models\DetailMenuModel;
use App\Models\ReservasiModel;
use App\Models\UserModel;

class Laporan extends BaseController
{
    protected $user;
    protected $decode;
    protected $reservasi;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->decode = new Decode();
        $this->reservasi = new ReservasiModel();
    }

    public function index()
    {
        return view('admin/laporan');
    }

    public function store()
    {
        
        $menu = new DetailMenuModel();
        $laundry = new DetailLaundryModel();
        $data = $this->reservasi->asObject()->select(" `reservasi`.*,
            `tamu`.`nama`,
            `tamu`.`gender`,
            `tamu`.`alamat`,
            `tamu`.`telp`,
            `tamu`.`email`,
            `kamar`.`kode_kamar`,
            `kamar`.`jenis_kamar_id`,
            `jenis_kamar`.`nama` AS `jenis_kamar`,
            `jenis_kamar`.`price`
            ")
            ->join("kamar", "`reservasi`.`kamar_id` = `kamar`.`id`", "LEFT")
            ->join("tamu", "`reservasi`.`tamu_id` = `tamu`.`id`", "LEFT")
            ->join("jenis_kamar", "`kamar`.`jenis_kamar_id` = `jenis_kamar`.`id`", "LEFT")
            ->findAll();
        foreach ($data as $key => $value) {
            $value->menu = $menu->select("detail_menu.*, menu.menu, menu.harga")->join('menu', 'menu.id=detail_menu.menu_id', 'left')
                ->where('reservasi_id', $value->id)->findAll();
            $value->laundry = $laundry->select("detail_laundry.*, laundry.laundry, laundry.harga")->join('laundry', 'laundry.id=detail_laundry.laundry_id', 'left')
                ->where('reservasi_id', $value->id)->findAll();
        }
        return $this->respond($data);
    }
}
