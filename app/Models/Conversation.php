<?php

namespace App\Models;

use CodeIgniter\Model;

class Conversation extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'conversations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_1', 'user_2'];
}
