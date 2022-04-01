<?php

namespace App\Controllers\API;

use App\Models\AdornoModel;
use CodeIgniter\RESTful\ResourceController;

class Adornos extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new AdornoModel());
    }

  public function index()
{
    $adornos = $this->model->findAll();
    return $this->respond($adornos);
}

  

  public function edit($id = null)
  {
        try{
            if($id == null)
            return $this->failValidationErrors('No se ha especificado el id del adorno');
            $adorno = $this->model->find($id);
            if($adorno == null)
            return $this->failNotFound('No se encontro el adorno con el id '.$id);
            return $this->respond($adorno);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
  }

  
  public function update($id = null)
  {
        try{
           if($id == null)
            return $this->failValidationErrors('No se ha especificado el id del adorno');
            $adornoVerificado = $this->model->find($id);
            if( $adornoVerificado == null)
            return $this->failNotFound('No se encontro el usuario con el id del adorno: '.$id);
            $adorno = $this->request->getJSON();
            if($this->model->update($id, $adorno)):
            $adorno->id = $id;
            return $this->respondUpdated($adorno);
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
              return $this->failValidationErrors('No se ha especificado el id del adorno');
            $adornoVerificado = $this->model->find($id);
            if( $adornoVerificado == null)
              return $this->failNotFound('No se encontro el adorno con el id: '.$id);
          
           if($this->model->delete($id)):
           
            return $this->respondDeleted($adornoVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el adorno');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
      
  }



    
public function create() {
  
  try{
    $image = $this->request->getVar('imagen_adorno');
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = 'adorno_'.time().'.png';
    $imageData = base64_decode($image);
    $file = fopen(APPPATH.'../public/images/adornos/'.$imageName, 'w');
    fwrite($file, $imageData);
    fclose($file);
    $adorno = $this->request->getJSON();
    $adorno->imagen_adorno = $imageName;
    if($this->model->insert($adorno)):
      $adorno->id = $this->model->insertID();
      return $this->respondCreated($adorno);
    else:
       return $this->failValidationErrors($this->model->validation->listErrors());
    endif;

  }catch(\Exception $e){
    return $this->failServerError($e,'Error en el servidor');
  }
  
 

  }
}
  

    
    




    

