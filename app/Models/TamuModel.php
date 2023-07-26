<?php

namespace App\Models;

use CodeIgniter\Model;

class TamuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tamu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','gender','alamat','telp', 'jenis_identitas', 'no_identitas', 'email'];
}
