<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JenisModel;
use App\Models\KamarModel;

class Kamar extends BaseController
{
    use ResponseTrait;
    protected $jenis;
    protected $kamar;
    public function __construct() {
        $this->jenis = new JenisModel();
        $this->kamar = new KamarModel();
    }

    public function index()
    {
        return view('admin/kamar');
    }

    public function store()
    {
        $data = [
            'jenis'=> $this->jenis->findAll(),
            'kamar'=> $this->kamar->select('kamar.*, jenis_kamar.nama')->join('jenis_kamar', 'kamar.jenis_kamar_id=jenis_kamar.id', 'left')->findAll()
        ];
        return $this->respond($data);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->kamar->insert($data);
            $data->id = $this->kamar->getInsertID();
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            if($this->kamar->update($data->id, ['kode_kamar'=>$data->kode_kamar, 'jenis_kamar_id'=>$data->jenis_kamar_id])){
                return $this->respondUpdated(true);
            }
            throw new \Exception("Gagal Update", 1);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }

    public function deleted($id=null)
    {
        try {
            if($this->kamar->delete($id)){
                return $this->respondDeleted(true);
            }
            throw new \Exception("Gagal Hapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
