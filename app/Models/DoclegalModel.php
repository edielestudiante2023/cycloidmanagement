<?php

namespace App\Models;

use CodeIgniter\Model;

class DoclegalModel extends Model
{
    protected $table = 'tbl_doclegal'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    protected $allowedFields = [
        'tipo_documento',
        'documento',
        'observaciones',
        'created_at',
        'updated_at'
    ]; // Columnas que se pueden insertar o actualizar

    protected $useTimestamps = true; // Habilita el uso automático de created_at y updated_at
    protected $createdField = 'created_at'; // Nombre de la columna de creación
    protected $updatedField = 'updated_at'; // Nombre de la columna de actualización

    // Opcional: Si deseas validaciones en el modelo, puedes añadir reglas aquí
    protected $validationRules = [
        'tipo_documento' => 'required|string|max_length[255]',
        'documento' => 'required|string|max_length[255]',
        'observaciones' => 'permit_empty|string'
    ];

    protected $validationMessages = [
        'tipo_documento' => [
            'required' => 'El campo "Tipo de Documento" es obligatorio.',
            'max_length' => 'El campo "Tipo de Documento" no puede superar los 255 caracteres.'
        ],
        'documento' => [
            'required' => 'El campo "Documento" es obligatorio.',
            'max_length' => 'El campo "Documento" no puede superar los 255 caracteres.'
        ],
    ];
}
