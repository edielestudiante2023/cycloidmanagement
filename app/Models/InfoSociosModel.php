<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoSociosModel extends Model
{
    protected $table = 'tbl_info_socios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['elemento', 'detalles', 'enlace'];
}
