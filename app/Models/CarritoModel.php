<?php namespace App\Models;
use CodeIgniter\Model;

class CarritoModel extends Model {

    protected $table         = 'carrito_pastel';
    protected $primaryKey    = 'id_carrito';
    protected $autoIncrement = true;
    protected $returnType    = 'array';
    protected $allowedFields = ['cantidad','id_pastel', 'id_pedido'];
    

    protected $validationRules    = [


        'cantidad'          =>  'required|integer|min_length[1]|max_length[100]',
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
 
    protected $skipValidation = false;

    public function ver_pedidoUser($id_pedido = null, $id_usuario = null) {
        $builder = $this->db->table($this->table);
        $builder->select('pedido.id_pedido, carrito_pastel.cantidad');
        $builder->select('pastel.id_pastel, pastel.nombre, pastel.precio, pastel.imagen_pastel');
        $builder->select('pedido.fecha_pedido, pedido.estado');
        $builder->select('usuario.nombre, usuario.apellidoP');
        $builder->select('(carrito_pastel.cantidad * pastel.precio) as total');
        $builder->join('pastel', 'pastel.id_pastel = carrito_pastel.id_pastel');
        $builder->join('pedido', 'pedido.id_pedido = carrito_pastel.id_pedido');
        $builder->join('usuario', 'usuario.id_usuario = pedido.id_usuario');
        $builder->where('pedido.id_pedido', $id_pedido);
        $builder->where('pedido.id_usuario', $id_usuario);
        $query = $builder->get();
        return $query->getResult();
     }


    public function calcular_totalPedido($id_pedido = null) {
        $builder = $this->db->table($this->table);
        $builder->select('SUM(carrito_pastel.cantidad * pastel.precio) as total');
        $builder->join('pastel', 'pastel.id_pastel = carrito_pastel.id_pastel');
        $builder->where('carrito_pastel.id_pedido', $id_pedido);
        $query = $builder->get();
        return $query->getRow();
     }

     //metodo para agregar un pastel al carrito 
        public function agregar_pastel($id_pastel = null, $cantidad =1, $id_pedido = null) {
            $builder = $this->db->table($this->table);
            $builder->insert(['id_pastel' => $id_pastel, 'cantidad' => $cantidad, 'id_pedido' => $id_pedido]);
            return $this->db->insertID();
        }
     
        //metodo para ver el carrito de un usuario
        public function ver_carritoUser($id_usuario = null) {
            $builder = $this->db->table($this->table);
            $builder->select('carrito_pastel.id_carrito, carrito_pastel.cantidad');
            $builder->select('pastel.id_pastel, pastel.nombre, pastel.precio, pastel.imagen_pastel');
            $builder->select('pedido.id_pedido, pedido.fecha_pedido, pedido.estado');
            $builder->select('usuario.nombre, usuario.apellidoP');
            $builder->select('(carrito_pastel.cantidad * pastel.precio) as total');
            $builder->join('pastel', 'pastel.id_pastel = carrito_pastel.id_pastel');
            $builder->join('pedido', 'pedido.id_pedido = carrito_pastel.id_pedido');
            $builder->join('usuario', 'usuario.id_usuario = pedido.id_usuario');
            $builder->where('pedido.id_usuario', $id_usuario);
            $query = $builder->get();
            return $query->getResult();
         }

        //metodo para crear dos registros a la vez de la tabla pedido y carrito_pastel
        


          

    }