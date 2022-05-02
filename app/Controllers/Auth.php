<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        helper('secure_password');
    }

    public function login()
    {
        Try{
           $correo = $this->request->getPost('correo');
           $password = $this->request->getPost('password');

           $usuarioModel = new UsuarioModel();
          $validateUsuario = $usuarioModel->where('correo',$correo)->first();

           if($validateUsuario == null)
           return $this->failNotFound('Usuario no encontrado');

            if (verifyPassword($password, $validateUsuario['password'])):

                $jwt = $this->generateJWT($validateUsuario);
                //retorname el token, el id_rol el id_usuario y el nombre del usuario y el estado 200
                return $this->respond([
                    'token' => $jwt,
                    'id_rol' => $validateUsuario['id_rol'],
                    'id_usuario' => $validateUsuario['id_usuario'],
                    'nombre' => $validateUsuario['nombre'],
                    'apellidoP' => $validateUsuario['apellidoP']
                ], 200);
              
                //return $this->respond(['token'=>$jwt],201);

            else:
                return $this->failValidationErrors('Contraseña incorrecta');
                endif;

        }catch (\Exception $e){
            return $this->failServerError($e,"Error al intentar iniciar sesión");
        }
    }

    protected function generateJWT($usuario){
        $key = Services::getSecretKey();
        $time = time();
        $payload = [
            'aud' => base_url(),
            'iat' =>  $time, //tiempo en que se genero el token
           //tiempo de expiracion del token dato entero 24hrs
            'exp' => $time + (60*60*24),
            'data'=>[
            'nombre'=> $usuario ['nombre'],
            'correo'=> $usuario ['correo'],
            'rol'=> $usuario ['id_rol'],
            'id'=> $usuario ['id_usuario']
            
            ]
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}