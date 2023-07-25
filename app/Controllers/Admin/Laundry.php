<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\LaundryModel;

class Laundry extends BaseController
{
    protected $laundry;
    protected $decode;
    public function __construct()
    {
        $this->laundry = new LaundryModel();
        $this->decode = new Decode();
    }

    public function index()
    {
        return view('admin/laundry');
    }

    public function store()
    {
        $jenis = $this->laundry->findAll();
        return $this->respond($jenis);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->laundry->insert($data);
            $data->id = $this->laundry->getInsertID();
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            $this->laundry->update($data->id, $data);
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleted($id)
    {
        $this->laundry->delete($id);
        return $this->respondDeleted(true);
    }
}
