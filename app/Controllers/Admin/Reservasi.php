<?php

namespace App\Controllers\Admin;

use CodeIgniter\Database\Exceptions\DatabaseException;
use App\Controllers\BaseController;
use App\Models\DetailLaundryModel;
use App\Models\DetailMenuModel;
use App\Models\JenisModel;
use App\Models\KamarModel;
use App\Models\LaundryModel;
use App\Models\MenuModel;
use App\Models\ReservasiModel;
use App\Models\TamuModel;
use App\Models\UserModel;

class Reservasi extends BaseController
{
    protected $reservasi;
    public function __construct()
    {
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

    public function post()
    {
        $detailLaundry = new DetailLaundryModel();
        $detailMenu = new DetailMenuModel();
        $tamu = new TamuModel();
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transException(true)->transStart();
            $tamu->insert($param);
            $param->id = $tamu->getInsertID();
            foreach ($param->kamar as $key => $value) {
                $value->tamu_id = $param->id;
                $this->reservasi->insert($value);
                $value->id = $this->reservasi->getInsertID();
                foreach ($param->menu as $key => $value1) {
                    $value1->reservasi_id = $value->id;
                    $value1->menu_id = $value1->id;
                    $detailMenu->insert($value1);
                }
                foreach ($param->laundry as $key => $value1) {
                    $value1->reservasi_id = $value->id;
                    $value1->laundry_id = $value1->id;
                    $detailLaundry->insert($value1);
                }
            }
            $conn->transComplete();
        } catch (DatabaseException $th) {
            $conn->transRollback();
            return $this->fail($th->getMessage());
        }
    }

    public function storeadd()
    {
        $kamar = new KamarModel();
        $jenis = new JenisModel();
        $laundry = new LaundryModel();
        $menu = new MenuModel();
        $data['jenis'] = $jenis->asObject()->findAll();
        foreach ($data['jenis'] as $key => $value) {
            $value->kamar = $kamar->select(" `kamar`.*")
                ->join("reservasi", "`kamar`.`id` = `reservasi`.`kamar_id`", "LEFT")
                ->where('jenis_kamar_id', $value->id)
                ->where("(status in('Check Out') OR status IS NULL)")
                ->findAll();
        }
        $data['laundry'] = $laundry->findAll();
        $data['menu'] = $menu->findAll();
        return $this->respond($data);
    }

    public function update()
    {
        $data = $this->request->getJSON();
        try {
            if ($this->reservasi->update($data->id, ['status' => 'Check Out'])) {
                return $this->respondUpdated(true);
            } else {
                throw new \Exception("Error Processing Request", 1);
            }
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function akses()
    {
        $data = $this->request->getJSON();
        $user = new UserModel();
        $itemUser = $user->asObject()->where('akses', 'Admin')->first();
        if ($itemUser) {
            if (password_verify($data->password, $itemUser->password))
                return $this->respond(true);
            else
                return $this->fail(false);
        } else
            return $this->fail(false);
    }

    public function deleted($id)
    {
        $tamu = new TamuModel();
        $tamu->delete($id);
        return $this->respondDeleted(true);
    }
}
