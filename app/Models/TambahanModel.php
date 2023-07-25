<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tambahan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tambahan', 'harga'];

}
