<?php
namespace App\Models;

use CodeIgniter\Model;

class PlanillasModel extends Model
{
    protected $table = 'tbl_planillas_seg_social';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'year',
        'month',
        'planilla',
        'documento',
        'observaciones'
    ];

    protected $useTimestamps = false;
}
