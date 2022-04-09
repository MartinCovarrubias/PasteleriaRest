<?php

namespace App\Controllers\API;

use App\Models\PedidoModel;
use CodeIgniter\RESTful\ResourceController;

class Pedidos extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new PedidoModel());
    }

  public function index()
{
    $pedidos = $this->model->findAll();
    return $this->respond($pedidos);
}

  public function create()
  {
      try{
          $pedido = $this->request->getJSON();
          if($this->model->insert($pedido)):
            $pedido->id = $this->model->insertID();
            return $this->respondCreated($pedido);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el pedido');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $pedido = $this->model->find($id);
            if($pedido == null)
              return $this->failNotFound('No se encontro el pedido con el id: '.$id);
            return $this->respond($pedido);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id');
            $pedidoVerificado = $this->model->find($id);
            if( $pedidoVerificado == null)
              return $this->failNotFound('No se encontro el pedido con el id: '.$id);
           $pedido = $this->request->getJSON();
           if($this->model->update($id, $pedido)):
            $pedido->id = $id;
            return $this->respondUpdated($pedido);
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
              return $this->failValidationErrors('No se ha especificado el id');
            $pedidoVerificado = $this->model->find($id);
            if( $pedidoVerificado == null)
              return $this->failNotFound('No se encontro el pedido con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($pedidoVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el pedido');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

}