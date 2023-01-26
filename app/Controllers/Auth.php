<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function index()
    {
        if (session()->get('is_Login') == true) {
            return redirect()->to(base_url('dashboard'));
        } else {
            $data = $this->user->countAllResults();
            if ($data == 0) {
                $this->user->insert(['username' => 'Administrator', 'password' => password_hash('Administrator#1', PASSWORD_DEFAULT)]);
            }
            return view('auth');
        }
    }

    public function login()
    {
        $user = new UserModel();
        $data = $this->request->getJSON();
        $query = $user->where(['username' => $data->username])->first();
        if (!is_null($query)) {
            if (password_verify($data->password, $query['password'])) {
                $sessi = [
                    'akses' => "Admin",
                    'is_Login'  => TRUE
                ];
                session()->set($sessi);
                return $this->respond(true);
            } else {
                return $this->failUnauthorized("Password yang anda masukkan salah");
            }
        } else {
            return $this->failNotFound('Akun tidak terdaftar');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('auth'));
    }
}
