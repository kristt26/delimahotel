<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FasilitasModel;
use App\Libraries\Decode;

class Fasilitas extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->fasilitas = new FasilitasModel();
        $this->decode = new Decode();
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $data->photo = $this->decode->decodebase64($data->file->base64);
            $this->fasilitas->insert($data);
            $data->id = $this->fasilitas->getInsertID();
            return $this->respondCreated($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
