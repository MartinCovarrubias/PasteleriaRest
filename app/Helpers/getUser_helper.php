
<?php

use App\Models\UsuarioModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function get_usuario($authHeader):array {
    
    $get_data_jwt = getDataJWT($authHeader);
    if ($get_data_jwt['authHeaderVacio'] == true) {
        return array('Usuario' => null, 'error' => $get_data_jwt['error']);
    }

    $usuarioModel = new UsuarioModel();
    $usuario = $usuarioModel->usuario_consulta($get_data_jwt['jwt']->data->id);//lo trae en objeto

    if ($usuario == null){
        return array( 'Usuario' => null, 'error' => 'No eres un usuario valido');
    }
    
    return array('Usuario' => $usuario, 'error' => null);
}

function getDataJWT($authHeader):array {
    if ($authHeader == null){
        return array('authHeaderVacio' => true, 'error' => 'No tiene permisos para acceder a este recurso');
    }

    $key = Services::getSecretKey();
    $arr = explode(' ', $authHeader);
    $jwt = $arr[1];
    $jwt = JWT::decode($jwt, new Key($key, 'HS256'));

    return array('authHeaderVacio' => false, 'error' => null, 'jwt' => $jwt);
}