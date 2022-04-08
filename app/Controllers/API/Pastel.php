<?php

namespace App\Controllers\API;

use App\Models\PastelModel;
use CodeIgniter\RESTful\ResourceController;

class Pastel extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new PastelModel());
    }

  public function index()
{
    $pasteles = $this->model->findAll();
    return $this->respond($pasteles);
}

  

  public function edit($id = null)
  {
        try{
            if($id == null)
            return $this->failValidationErrors('No se ha especificado el id del pastel');
            $pastel = $this->model->find($id);
            if($pastel == null)
            return $this->failNotFound('No se encontro el pastel con el id '.$id);
            return $this->respond($pastel);
        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
  }

  public function update($id = null)
  {
        try{
           if($id == null)
            return $this->failValidationErrors('No se ha especificado el id del pastel');
            $pastelVerificado = $this->model->find($id);
            if( $pastelVerificado == null)
            return $this->failNotFound('No se encontro el pastel con el id: '.$id);
            // ! aqui termina el codigo de verificacion de usuario
            $pastel = $this->request->getJSON();
            //si el json trae el campo imagen_pastel, entonces se actualiza la imagen del pastel
            if(isset($pastel->imagen_pastel)):
              $nombreImagen = $pastelVerificado['imagen_pastel']; 
            unlink(APPPATH.'../public/images/pasteles/'.$nombreImagen);
          
            $image = $this->request->getVar('imagen_pastel');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'pastel_'.time().'.png';
            $imageData = base64_decode($image);
            $file = fopen(APPPATH.'../public/images/pasteles/'.$imageName, 'w');
            fwrite($file, $imageData);
            fclose($file);
            $pastel->imagen_pastel = $imageName;
            //si el json no trae el campo imagen_pastel, entonces se mantiene la imagen del pastel y se actualiza el resto de campos
            else:
              $pastel->imagen_pastel = $pastelVerificado['imagen_pastel'];
            endif;
          
            if($this->model->update($id, $pastel)):
            
            return $this->respondUpdated($pastel);
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
              return $this->failValidationErrors('No se ha especificado el id del pastel');
            $pastelVerificado = $this->model->find($id);
            if( $pastelVerificado == null)
              return $this->failNotFound('No se encontro el pastel con el id: '.$id);  
              if($pastelVerificado['imagen_pastel'] != null)
              $nombreImagen = $pastelVerificado['imagen_pastel'];//aqui rompe 
              unlink(APPPATH.'../public/images/pasteles/'.$nombreImagen);
              if($this->model->delete($id)):
            $pastelVerificado = $this->model->find($id);
            return $this->respondDeleted($pastelVerificado);
          else:
             return $this->failValidationErrors('No se pudo eliminar el pastel');
          endif;

        }catch(\Exception $e){
            return $this->failServerError($e,'Error en el servidor');
        }
  }



    
public function create() {
  
  try{
    $image = $this->request->getVar('imagen_pastel');
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = 'pastel_'.time().'.png';
    $imageData = base64_decode($image);
    $file = fopen(APPPATH.'../public/images/pasteles/'.$imageName, 'w');
    fwrite($file, $imageData);
    fclose($file);
    $pastel = $this->request->getJSON();
    $pastel->imagen_pastel = $imageName;
    if($this->model->insert($pastel)):
      $pastel->id = $this->model->insertID();
      return $this->respondCreated($pastel);
    else:
       return $this->failValidationErrors($this->model->validation->listErrors());
    endif;
     
  }catch(\Exception $e){
    return $this->failServerError($e,'Error en el servidor');
  }
  
 

  }
}
  