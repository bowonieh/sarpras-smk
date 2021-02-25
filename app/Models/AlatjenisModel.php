<?php

namespace App\Models;

use CodeIgniter\Model;

class AlatjenisModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'jenis_alat';
    protected $primaryKey           = 'id_alat';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama_alat'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
}
