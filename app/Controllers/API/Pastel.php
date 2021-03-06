<?php

namespace App\Controllers\API;

use App\Models\PastelModel;
use CodeIgniter\RESTful\ResourceController;
use Config\App;

class Pastel extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new PastelModel());
    }

  public function index()
{
    $pasteles = $this->model->findAll();
   foreach ($pasteles as  &$pastel ) {
    $pastel['imagen_pastel'] = base64_encode(file_get_contents(APPPATH . '../public/images/pasteles/' . $pastel['imagen_pastel']));
  }

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
            $pastel['imagen_pastel'] = base64_encode(file_get_contents(APPPATH . '../public/images/pasteles/' . $pastel['imagen_pastel']));
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
            $pastel = $this->request->getJSON();
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
              $nombreImagen = $pastelVerificado['imagen_pastel'];
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
  