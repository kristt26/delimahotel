<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JenisModel;
use App\Models\FasilitasModel;
use App\Libraries\Decode;

class Jenis extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->jenis = new JenisModel();
        $this->fasilitas = new FasilitasModel();
        $this->decode = new Decode();
    }

    public function index()
    {
        return view('admin/jenis');
    }

    public function store()
    {
        $jenis = $this->jenis->asObject()->findAll();
        foreach ($jenis as $key => $value) {
            $value->fasilitas = $this->fasilitas->where('jenis_kamar_id', $value->id)->findAll();
        }
        return $this->respond($jenis);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->jenis->insert($data);
            $data->id = $this->jenis->getInsertID();
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            $this->jenis->update($data->id, ['nama' => $data->nama, 'ukuran' => $data->ukuran, 'kapasitas' => $data->kapasitas, 'bad' => $data->bad, 'service' => $data->service, 'price' => $data->price]);
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleted($id)
    {
        $this->jenis->delete($id);
        return $this->respondDeleted(true);
    }
}
