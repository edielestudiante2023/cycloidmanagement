<?php

namespace App\Models;

use CodeIgniter\Model;

class VideosBackModel extends Model
{
    protected $table = 'tbl_tutoriasles_back';
    protected $primaryKey = 'id';
    protected $allowedFields = ['elemento', 'detalles', 'enlace'];
}
