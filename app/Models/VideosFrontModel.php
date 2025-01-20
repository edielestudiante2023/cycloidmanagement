<?php

namespace App\Models;

use CodeIgniter\Model;

class VideosFrontModel extends Model
{
    protected $table = 'tbl_tutoriales_front';
    protected $primaryKey = 'id';
    protected $allowedFields = ['elemento', 'detalles', 'enlace'];
}
