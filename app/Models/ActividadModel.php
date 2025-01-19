<?php

namespace App\Models;

use CodeIgniter\Model;



class ActividadModel extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'id_actividad';
    protected $allowedFields = [
        'nombre_actividad', 
        'id_tipo', 
        'responsable', 
        'estado', 
        'fecha_apertura', 
        'fecha_vencimiento', 
        'avance', 
        'comentarios', 
        'documentos_adjuntos', 
        'enlaces_adjuntos'
    ];
    protected $useTimestamps = false;
}
