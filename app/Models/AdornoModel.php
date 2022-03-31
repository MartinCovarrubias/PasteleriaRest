<?php namespace App\Models;

use CodeIgniter\Model;

class AdornoModel extends Model{

    protected $table         = 'adorno';
    protected $primaryKey    = 'id_adorno';
    protected $autoIncrement = true;

    protected $returnType    = 'array';
    protected $allowedFields = ['nombre','imagen_adorno','precio','descripcion','estado'];

    protected $useTimestamps  = false;


    protected $validationRules    = [
        'nombre'          => 'required|alpha_space|min_length[3]|max_length[100]',
        'imagen_adorno'   =>  'required|alpha_numeric_space|min_length[3]|max_length[100]',
        'precio'          =>  'required|decimal|min_length[3]|max_length[100]',
        'descripcion'     =>  'required|alpha_space|min_length[3]|max_length[100]',
        'estado'          =>  'required|alpha_space|min_length[3]|max_length[100]'
    ];

    protected $validationMessages = [
        'nombre'          => [
            'required'    => 'El nombre es requerido',
            'alpha_space' => 'El nombre debe contener solo letras y espacios',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres',
            'max_length'  => 'El nombre debe tener como maximo 100 caracteres'
        ],
        'imagen_adorno'   => [
            'required'            => 'La imagen es requerida',
            'alpha_numeric_space' => 'La imagen debe contener solo letras y espacios',
            'min_length'          => 'La imagen debe tener al menos 3 caracteres',
            'max_length'          => 'La imagen debe tener como maximo 100 caracteres',

        ],
        'precio'          => [
            'required'    => 'El precio es requerido',
            'min_length'  => 'El precio debe tener al menos 3 caracteres',
            'max_length'  => 'El precio debe tener como maximo 100 caracteres',
            'decimal'     => 'El precio debe ser un numero decimal'
        ],
        'descripcion'     => [
            'required'    => 'La descripcion es requerida',
            'alpha_space' => 'La descripcion debe contener solo letras y espacios',
            'min_length'  => 'La descripcion debe tener al menos 3 caracteres',
            'max_length'  => 'La descripcion debe tener como maximo 100 caracteres'
        ],
        'estado'          => [
            'required'    => 'El estado es requerido',
            'alpha_space' => 'El estado debe contener solo letras y espacios',
            'min_length'  => 'El estado debe tener al menos 3 caracteres',
            'max_length'  => 'El estado debe tener como maximo 100 caracteres'
        ]
    ];

    protected $skipValidation = false;

    
}