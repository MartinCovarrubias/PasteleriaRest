<?php namespace App\Models;

use CodeIgniter\Model;
 class PastelModel extends Model {
         
        protected $table         = 'pastel';
        protected $primaryKey    = 'id_pastel';
        protected $autoIncrement = true;
    
        protected $returnType    = 'array';
        protected $allowedFields = ['nombre','imagen_pastel','precio','descripcion','estado','id_adorno'];
    
        protected $useTimestamps  = false;

        protected $validationRules    = [
            'nombre'          =>  'required|alpha_space|min_length[3]|max_length[100]',
            'imagen_pastel'   =>  'required|alpha_numeric_punct|min_length[3]|max_length[255]',
            'precio'          =>  'required|decimal|min_length[1]|max_length[100]',
            'descripcion'     =>  'required|alpha_space|min_length[3]|max_length[100]',
            'estado'          =>  'required|alpha_space|min_length[3]|max_length[100]',
           // 'id_adorno'       =>  'integer'
        ];

        protected $validationMessages = [
            'nombre'         => [
                'required'    => 'El nombre es requerido',
                'alpha_numeric_punct' => 'El nombre debe contener solo letras, numeros y signos de puntuacion',
                'min_length'  => 'El nombre debe tener al menos 3 caracteres',
                'max_length'  => 'El nombre debe tener como maximo 100 caracteres'
            ],
            'imagen_pastel'   => [
                'required'            => 'La imagen es requerida',
                'alpha_numeric_space' => 'La imagen debe contener solo letras y espacios',
                'min_length'          => 'La imagen debe tener al menos 3 caracteres',
                'max_length'          => 'La imagen debe tener como maximo 100 caracteres',
            ],
            'precio'       => [
                'required'    => 'El precio es requerido',
                'min_length'  => 'El precio debe tener al menos 3 caracteres',
                'max_length'  => 'El precio debe tener como maximo 100 caracteres',
                'decimal'     => 'El precio debe ser un numero decimal'
            ],
            'descripcion'  => [
                'required'    => 'La descripcion es requerida',
                'alpha_space' => 'La descripcion debe contener solo letras y espacios',
                'min_length'  => 'La descripcion debe tener al menos 3 caracteres',
                'max_length'  => 'La descripcion debe tener como maximo 100 caracteres'
            ],
            'estado'       => [
                'required'    => 'El estado es requerido',
                'alpha_space' => 'El estado debe contener solo letras y espacios',
                'min_length'  => 'El estado debe tener al menos 3 caracteres',
            ],
            'id_adorno'    => [
                'integer'     => 'El id del adorno debe ser un numero entero'
            ]
    ];
        protected $skipValidation = false;

 }