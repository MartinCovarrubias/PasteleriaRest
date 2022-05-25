<?php

namespace App\Controllers\API;

use App\Models\CarritoModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PedidoModel;
use App\Models\PastelModel;
use App\Models\UsuarioModel;

class Carrito extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new CarritoModel());
        helper('getUser');
    }

  public function index()
{
    $carritos = $this->model->findAll();
    return $this->respond($carritos);
}

  public function create()
  {
      try{
          $carrito = $this->request->getJSON();
          if($this->model->insert($carrito)):
            $carrito->id = $this->model->insertID();
            return $this->respondCreated($carrito);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el carrito');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id del carrito');
            $carrito = $this->model->find($id);
            if($carrito == null)
              return $this->failNotFound('No se encontro el carrito con el id: '.$id);
            return $this->respond($carrito);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id del detalle');
            $carritoVerificado = $this->model->find($id);
            if( $carritoVerificado == null)
              return $this->failNotFound('No se encontro el detalle con el id: '.$id);
           $carrito = $this->request->getJSON();
           if($this->model->update($id, $carrito)):
            $carrito->id = $id;
            return $this->respondUpdated($carrito);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function delete($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id del detalle');
            $carritoVerificado = $this->model->find($id);
            if( $carritoVerificado == null)
              return $this->failNotFound('No se encontro el detalle  con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($carritoVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el detalle');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }



  //metodo para agregar un pastel a un carrito
  public function agregarc($id = null){
    try {
      $modelPedido = new PedidoModel();
        if($id == null)
        return $this->failValidationErrors('No se ha pasado un numero de pedido valido');

        $pedido = $modelPedido->find($id);
        if($pedido == null)
        return $this->failNotFound('No se encontro el pedido con el id: '.$id);
        $pastel = new PastelModel();
        $pastel = $this->request->getJSON();
        $pedidos = $this->model->agregar_pastel($pastel->id_pastel,1,$id,);
        return $this->respond($pedidos);

    }catch(\Exception $e){
      return $this->failServerError($e,'Error en el servidor');
    }

  }

  //metodo para ver los pasteles de un carrito de un usuario
   
  public function ver_pedidos($id = null){
    try {
      $modelUsuario = new UsuarioModel();
        if($id == null)
          return $this->failValidationErrors('No se ha pasado un id valido');

        $cliente = $modelUsuario->find($id);
        if($cliente == null)
          return $this->failNotFound('No se encontro el cliente con el id: '.$id);
          $pedidos = $this->model->ver_carritoUser($id);
          return $this->respond($pedidos);

    }catch(\Exception $e){
      return $this->failServerError($e,'Error en el servidor');
    }
  }
 
  



  

}

