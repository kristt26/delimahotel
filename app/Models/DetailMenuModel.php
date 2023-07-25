<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailMenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['reservasi_id', 'menu_id'];

}
