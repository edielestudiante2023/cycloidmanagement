<?php

namespace App\Models;

use CodeIgniter\Model;

class VideosCapacitacionesModel extends Model
{
    protected $table = 'tbl_videos_capacitaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['elemento', 'detalles', 'enlace'];
}
