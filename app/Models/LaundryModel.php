<?php

namespace App\Models;

use CodeIgniter\Model;

class LaundryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'laundry';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['laundry', 'harga'];

}
