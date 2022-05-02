<?php namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table         = 'pedido';
    protected $primaryKey    = 'id_pedido';
    protected $autoIncrement = true;

    protected $returnType    = 'array';
    protected $allowedFields = [ 'fecha_pedido', 'estado', 'id_usuario'];

    protected $useTimestamps  = false;
  

    protected $validationRules    = [
        'fecha_pedido'   =>  'required|valid_date[Y-m-d]',
        'estado'         =>  'required|alpha_space|min_length[3]|max_length[100]',
        'id_usuario'     =>  'required|integer|is_valid_usuario'
    ];
   

    protected $validationMessages = [
        'fecha_pedido'   => [
            'required'    => 'La fecha es requerida',
            'valid_date'        => 'La fecha debe ser una fecha valida'
        ],
    
        'estado'      => [
            'required'    => 'El estado es requerido',
            'alpha_space' => 'El estado debe contener solo letras y espacios',
            'min_length'  => 'El estado debe tener al menos 3 caracteres',
        ],
        'id_usuario'  => [
            'integer'     => 'El id del usuario debe ser un numero entero',
            'required'    => 'El id del usuario es requerido',
            'is_valid_usuario' => 'El id del usuario no existe'
        ]
    ];
      
    protected $skipValidation = false;


}

