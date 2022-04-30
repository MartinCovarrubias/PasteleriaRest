<?php

namespace App\Controllers\API;

use App\Models\detallepModel;
use CodeIgniter\RESTful\ResourceController;

class Detalle_Pedido extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new detallepModel());
    }

  public function index()
{
    $detalles = $this->model->findAll();
    return $this->respond($detalles);
}

  public function create()
  {
      try{
          $detalle = $this->request->getJSON();
          if($this->model->insert($detalle)):
            $detalle->id = $this->model->insertID();
            return $this->respondCreated($detalle);
          else:
             return $this->failValidationErrors($this->model->validation->listErrors());
          endif;

      }catch(\Exception $e){
          return $this->failServerError($e,'Error al crear el detalle');
      }
  }

  public function edit($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id del detalle');
            $detalle = $this->model->find($id);
            if($detalle == null)
              return $this->failNotFound('No se encontro el detalle con el id: '.$id);
            return $this->respond($detalle);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

  public function update($id = null)
  {
        try{
           if($id == null)
              return $this->failValidationErrors('No se ha especificado el id del detalle');
            $detalleVerificado = $this->model->find($id);
            if( $detalleVerificado == null)
              return $this->failNotFound('No se encontro el detalle con el id: '.$id);
           $detalle = $this->request->getJSON();
           if($this->model->update($id, $detalle)):
            $detalle->id = $id;
            return $this->respondUpdated($detalle);
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
            $detalleVerificado = $this->model->find($id);
            if( $detalleVerificado == null)
              return $this->failNotFound('No se encontro el detalle  con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($detalleVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el detalle');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }

}