<?php namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table         = 'pedido';
    protected $primaryKey    = 'id_pedido';
    protected $autoIncrement = true;

    protected $returnType    = 'array';
    protected $allowedFields = [ 'fecha_pedido','total', 'estado', 'id_usuario'];

    protected $useTimestamps  = false;
  

    protected $validationRules    = [
        'fecha_pedido'   =>  'required|valid_date[Y-m-d]',
        'total'          =>  'required|integer|min_length[1]|max_length[100]',
        'estado'         =>  'required|alpha_space|min_length[3]|max_length[100]',
        'id_usuario'     =>  'required|integer|is_valid_usuario'
    ];
   

    protected $validationMessages = [
        'fecha_pedido'   => [
            'required'    => 'La fecha es requerida',
            'valid_date'        => 'La fecha debe ser una fecha valida'
        ],
        'total'       => [
            'required'    => 'El total es requerido',
            'min_length'  => 'El total debe tener al menos 3 caracteres',
            'max_length'  => 'El total debe tener como maximo 100 caracteres',
            'decimal'     => 'El total debe ser un numero decimal'
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

    public function PedidoPorUsuario($id_usuario=null)
    {
       //join para ver que usuario hizo el pedido
            $builder = $this->db->table($this->table);
            $builder->select('pedido.id_pedido, pedido.fecha_pedido, pedido.total, pedido.estado, usuario.nombre, usuario.apellidoP');   
            $builder->join('usuario', 'usuario.id_usuario = pedido.id_usuario');
            $builder->where('pedido.id_usuario', $id_usuario);
            $query = $builder->get();
            return $query->getResultArray();
         

    }
}

