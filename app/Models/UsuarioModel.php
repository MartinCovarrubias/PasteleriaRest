<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $table         = 'usuario';
    protected $primaryKey    = 'id_usuario';

 
   

    protected $autoIncrement = true;
    
    protected $returnType    = 'array';
    protected $allowedFields = ['nombre', 'apellidoP', 'apellidoM', 'telefono', 'correo','password','direccion'];

    protected $useTimestamps  = false;


    protected $validationRules    = [
        'nombre'      => 'required|alpha_space|min_length[3]|max_length[100]',
        'apellidoP'   =>  'required|alpha_space|min_length[3]|max_length[100]',
        'apellidoM'   =>  'required|alpha_space|min_length[3]|max_length[100]',
        'telefono'    =>  'required|numeric|min_length[10]|max_length[10]',
        'correo'      =>  'required|valid_email|min_length[5]|max_length[100] |is_unique[usuario.correo]',
        'password'    =>  'required|min_length[6]|max_length[64]',
        'direccion'   =>  'required|alpha_numeric_space|min_length[5]|max_length[100]',
        'id_rol'      =>  'required|integer|is_valid_rol'
    ];

    protected $validationMessages = [
        'nombre'      => [
            'required'    => 'El nombre es requerido',
            'alpha_space' => 'El nombre debe contener solo letras y espacios',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres',
            'max_length'  => 'El nombre debe tener como maximo 100 caracteres'
        ],
        'apellidoP'   => [
            'required'    => 'El apellido paterno es requerido',
            'alpha_space' => 'El apellido paterno debe contener solo letras y espacios',
            'min_length'  => 'El apellido paterno debe tener al menos 3 caracteres',
            'max_length'  => 'El apellido paterno debe tener como maximo 100 caracteres'
        ],
        'apellidoM'   => [
            'required'    => 'El apellido materno es requerido',
            'alpha_space' => 'El apellido materno debe contener solo letras y espacios',
            'min_length'  => 'El apellido materno debe tener al menos 3 caracteres',
            'max_length'  => 'El apellido materno debe tener como maximo 100 caracteres'
        ],
        'telefono'    => [
            'required'    => 'El telefono es requerido',
            'numeric'     => 'El telefono debe contener solo numeros',
            'min_length'  => 'El telefono debe tener al menos 10 caracteres',
            'max_length'  => 'El telefono debe tener como maximo 10 caracteres'
        ],
        'correo'      => [
            'required'    => 'El correo es requerido',
            'valid_email' => 'El correo debe ser valido',
            'min_length'  => 'El correo debe tener al menos 5 caracteres',
            'max_length'  => 'El correo debe tener como maximo 100 caracteres',
            'is_unique'   => 'El correo ya esta registrado'
        ],

        'password'    => [
            'required'      => 'El password es requerido',
            'min_length'    => 'El password debe tener al menos 6 caracteres',
            'max_length'    => 'El password debe tener como maximo 8 caracteres',
            'alpha_numeric' => 'El password debe contener solo letras y numeros'
        ],
        'direccion'  => [
            'required'      => 'La direccion es requerida',
            'alpha_numeric' => 'La direccion debe contener solo letras y numeros',
            'min_length'    => 'La direccion debe tener al menos 5 caracteres',
            'max_length'    => 'La direccion debe tener como maximo 100 caracteres'
        ],
        'id_rol'      => [
            'required'     => 'El rol es requerido',
            'integer'      => 'El rol debe ser un numero entero',
            'is_valid_rol' => 'El rol no existe'
        ],

        
        ];

    protected $skipValidation = false;

}