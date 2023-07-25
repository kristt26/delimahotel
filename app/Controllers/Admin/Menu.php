<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\MenuModel;

class Menu extends BaseController
{
    protected $menu;
    protected $decode;
    public function __construct()
    {
        $this->menu = new MenuModel();
        $this->decode = new Decode();
    }

    public function index()
    {
        return view('admin/menu');
    }

    public function store()
    {
        $jenis = $this->menu->findAll();
        return $this->respond($jenis);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $this->menu->insert($data);
            $data->id = $this->menu->getInsertID();
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            $this->menu->update($data->id, $data);
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function deleted($id)
    {
        $this->menu->delete($id);
        return $this->respondDeleted(true);
    }
}
