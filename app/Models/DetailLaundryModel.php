<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailLaundryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_laundry';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['reservasi_id', 'laundry_id', 'jumlah'];

}
