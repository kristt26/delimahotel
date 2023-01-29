<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JenisModel;
use App\Models\FasilitasModel;
use App\Models\TamuModel;
use App\Models\ReservasiModel;
use App\Libraries\Decode;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Booking extends BaseController
{
    use ResponseTrait;
    protected $jenis;
    protected $fasilitas;
    protected $decode;
    protected $tamu;
    protected $reservasi;
    protected $conn;
    public function __construct()
    {
        $this->jenis = new JenisModel();
        $this->fasilitas = new FasilitasModel();
        $this->tamu = new TamuModel();
        $this->reservasi = new ReservasiModel();
        $this->decode = new Decode();
        $this->conn= \Config\Database::connect();
    }
    public function index()
    {
        return view('booking');
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
        $kamar = $this->jenis->select('kamar.*')
        ->asObject()
        ->join('kamar', 'jenis_kamar.id = kamar.jenis_kamar_id', 'RIGHT')
        ->join('reservasi', 'kamar.id = reservasi.kamar_id', 'LEFT')
        ->where("reservasi.id IS NULL OR (reservasi.id IS NOT NULL AND reservasi.status IN('Kosong','Batal'))  AND jenis_kamar.id='$data->jenis_kamar_id'")
        ->first();
        $data->kamar_id = $kamar->id;
        try {
            $this->conn->transException(true)->transStart();
            $this->tamu->insert($data->biodata);
            $data->biodata->id = $this->tamu->getInsertID();
            $data->tamu_id = $data->biodata->id;
            $data->kamar_id = $kamar->id;
            $data->status = "Reservasi";
            $this->reservasi->insert($data);
            $data->id = $this->reservasi->getInsertID();
            $this->conn->transComplete();
            // if($this->conn->transStatus()){
            //     $this->conn->transCommit();
            //     return $this->respondCreated($data);
            // }else{
            //     throw new \Exception($this->conn->transException();, 1);
                
            // }
        } catch (DatabaseException $e) {
            return $this->fail($e->getMessage());
        }
    }
}
