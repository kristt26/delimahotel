<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\TambahanModel;

class Tambahan extends BaseController
{
    protected $tambahan;
    protected $decode;
    public function __construct()
    {
        $this->tambahan = new TambahanModel();
        $this->decode = new Decode();
    }

    public function index()
    {
        return view('admin/tambahan');
    }

    public function store()
    {
        $jenis = $this->tambahan->findAll();
        return $this->respond($jenis);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->tambahan->insert($data);
            $data->id = $this->tambahan->getInsertID();
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            $this->tambahan->update($data->id, $data);
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleted($id)
    {
        $this->tambahan->delete($id);
        return $this->respondDeleted(true);
    }
}
