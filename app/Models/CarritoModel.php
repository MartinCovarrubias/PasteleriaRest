<?php namespace App\Models;
use CodeIgniter\Model;

class CarritoModel extends Model {

    protected $table         = 'carrito_pastel';
    protected $primaryKey    = 'id_carrito';
    protected $autoIncrement = true;
    protected $returnType    = 'array';
    protected $allowedFields = ['cantidad', 'total', 'id_pastel', 'id_pedido'];
    

    protected $validationRules    = [
        'cantidad'          =>  'required|integer|min_length[1]|max_length[100]',
        'total'             =>  'required|decimal|min_length[1]|max_length[100]',
        'id_pastel'          =>  'required|integer|min_length[1]|is_valid_pastel',
        'id_pedido'          =>  'required|integer|min_length[1]|is_valid_pedido',
    ];
    
    protected $validationMessages = [
        'cantidad'         => [
            'required'    => 'La cantidad es requerida',
            'integer'     => 'La cantidad debe ser un numero entero',
            'min_length'  => 'La cantidad debe tener al menos 3 caracteres',
            'max_length'  => 'La cantidad debe tener como maximo 100 caracteres'
        ],
        'total'       => [
            'required'    => 'El total es requerido',
            'min_length'  => 'El total debe tener al menos 3 caracteres',
            'max_length'  => 'El total debe tener como maximo 100 caracteres',
            'decimal'     => 'El total debe ser un numero decimal'
        ],
        'id_pastel'  => [
            'required'    => 'El id del pastel es requerido',
            'integer'     => 'El id del pastel debe ser un numero entero',
            'min_length'  => 'El id del pastel debe tener al menos 3 caracteres',
            'is_valid_pastel'  => 'El id del pastel no existe'
        ],
        'id_pedido'  => [
            'required'    => 'El id del pedido es requerido',
            'integer'     => 'El id del pedido debe ser un numero entero',
            'min_length'  => 'El id del pedido debe tener al menos 3 caracteres',
            'is_valid_pedido'  => 'El id del pedido no existe'
        ],
    ];
    protected $useTimestamps  = false;

}