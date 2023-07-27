<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\UserModel;

class ManajemenUser extends BaseController
{
    protected $user;
    protected $decode;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->decode = new Decode();
    }

    public function index()
    {
        return view('admin/manajemen_user');
    }

    public function store()
    {
        $data = $this->user->select("user.nama, user.username, user.akses, '' as password")->findAll();
        return $this->respond($data);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        try {
            $item = [
                'nama'=>$data->nama,
                'username'=>$data->username,
                'password'=>password_hash($data->password, PASSWORD_DEFAULT),
                'akses'=>$data->akses
            ];
            $this->user->insert($item);
            $data->id = $this->user->getInsertID();
            return $this->respondCreated($data);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }

    public function put()
    {
        $data = $this->request->getJSON();
        try {
            if($this->user->update($data->id, [
                'nama'=>$data->nama,
                'akses'=>$data->akses,
                'username'=>$data->username,
                'password'=>password_hash($data->password, PASSWORD_DEFAULT)
            ])){
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
            if($this->user->delete($id)){
                return $this->respondDeleted(true);
            }
            throw new \Exception("Gagal Hapus", 1);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
