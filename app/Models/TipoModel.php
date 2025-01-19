<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoModel extends Model
{
    protected $table = 'tipos_actividad';
    protected $primaryKey = 'id_tipo';
    protected $allowedFields = ['titulo'];
    protected $useTimestamps = false;
}

