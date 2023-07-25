<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTambahanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_tambahan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['reservasi_id', 'tambahan_id'];

}
