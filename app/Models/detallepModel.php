<?php namespace App\Models;

use CodeIgniter\Model;

Class DetallepModel extends model {
   
    protected $table = 'detalle_pedido';
    protected $primaryKey = 'id_detalle_pedido';
    protected $autoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['precio','cantidad','estado','id_pedido','id_pastel'];
    protected $useTimestamps = false;

    protected $validationRules = [
       
        'precio'         => 'required|decimal|min_length[1]|max_length[100]',
        'cantidad'       => 'required|integer|min_length[1]|max_length[11]',
        'estado'         => 'required|alpha_space|min_length[4]|max_length[100]',
        'id_pedido'      => 'required|integer|is_valid_pedido',
        'id_pastel'      => 'required|integer|is_valid_pastel'
    ];

    protected $validationMessages = [
        'id_pedido'      => [
            'required'    => 'El id del pedido es requerido',
            'integer'     => 'El id del pedido debe ser un numero entero',
            'is_valid_pedido' => 'El id del pedido no existe'
        ],
        'id_pastel'      => [
            'required'    => 'El id del pastel es requerido',
            'integer'     => 'El id del pastel debe ser un numero entero',
            'is_valid_pastel' => 'El id del pastel no existe'
        ],
        'precio'         => [
            'required'    => 'El precio es requerido',
            'min_length'  => 'El precio debe tener al menos 3 caracteres',
            'max_length'  => 'El precio debe tener como maximo 100 caracteres',
            'decimal'     => 'El precio debe ser un numero decimal'
        ],
        'cantidad'       => [
            'required'    => 'La cantidad es requerida',
            'integer'     => 'La cantidad debe ser un numero entero',
            'min_length'  => 'La cantidad debe tener al menos 3 caracteres',
            'max_length'  => 'La cantidad debe tener como maximo 11 caracteres'
        ],
        'estado'         => [
            'required'    => 'El estado es requerido',
            'alpha_space' => 'El estado debe contener solo letras y espacios',
            'min_length'  => 'El estado debe tener al menos 10 caracteres',
            'max_length'  => 'El estado debe tener como maximo 100 caracteres'
        ]
    ];


}
