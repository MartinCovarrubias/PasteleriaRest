<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model {

    protected $table         = 'roles';
    protected $primaryKey    = 'id_rol';
    protected $autoIncrement = true;

    protected $returnType    = 'array';
    protected $allowedFields = ['nombre_rol'];

    protected $useTimestamps = false; //para usar created_at y updated_at
   

    protected $validationRules    = [
        'nombre_rol'   => 'required|alpha_space|min_length[3]|max_length[75]'
    ];

    protected $validationMessages = [
        'nombre_rol' => [
            'required' => 'El nombre del rol es requerido',
            'alpha_space' => 'El nombre del rol debe contener solo letras y espacios',
            'min_length' => 'El nombre del rol debe tener al menos 3 caracteres',
            'max_length' => 'El nombre del rol debe tener como maximo 75 caracteres'
        ]
    ];
    protected $skipValidation = false;

 
}