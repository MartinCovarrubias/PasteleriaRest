<?php namespace App\Models\CustomRules;

use App\Models\UsuarioModel;
use App\Models\PastelModel;
use App\Models\PedidoModel;
use App\Models\RolModel;
class MyCustomRules
{
  

   public function is_valid_rol(int $id): bool{

    $model = new RolModel();
    $rol = $model->find($id);

    return $rol == null ? false : true;

 
   }

   public function is_valid_usuario(int $id): bool{

      $model = new UsuarioModel();
      $usuario = $model->find($id);
  
      return $usuario == null ? false : true;
  
   
     }


  
   public function is_valid_pedido(int $id): bool{

    $model = new PedidoModel();
    $pedido = $model->find($id);

    return $pedido == null ? false : true;

 
   }


   
   public function is_valid_pastel(int $id): bool{

    $model = new PastelModel();
    $pastel = $model->find($id);

    return $pastel == null ? false : true;

 
   }
    
}