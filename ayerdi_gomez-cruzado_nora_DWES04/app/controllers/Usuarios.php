<?php

require_once __DIR__ . "/../models/DAO/usuarioDAO.php";



class Usuarios {
   
    //--------------Funciones llamadas desde el controlador frontal-------

    public function login($data) {
        $usuario = new usuarioDAO();
        if(!$usuario->comprobarSesion($data)){

            $usuarioLog = $usuario->comprobarUsuario($data);
           
            if(!empty($usuarioLog)) { 
                if($usuario->actualizarSesion(true)){
                    $response = new JsonResponse(
                        'success',
                        200,
                        'Sesion iniciada correctamente',
                        'Ongi Etorri, '. $usuarioLog->getNombre()
                    );
                    $response -> sendJsonResponse();
                }
              
            } else {
                $response = new JsonResponse(
                    'Unauthorized',
                    401,
                    'Error',
                    'Usuario o contraseña incorrectos'
                );
                $response -> sendJsonResponse();
            }

        } else {
            $response = new JsonResponse(
                'Conflict',
                401,
                'Error',
                'Ya tiene la sesion iniciada'
            );
            $response -> sendJsonResponse();
        }  
    } 
     
    // Funcion para cerrar sesion del usuario
    public function salir($data) {
        $usuarios = new usuarioDAO();
        if($usuarios->comprobarSesion($data)){
            $usuarioLog = $usuarios->comprobarUsuario($data);    
            if(!empty($usuarioLog)) { 

                if($usuarios->actualizarSesion(false)){
                    $response = new JsonResponse(
                        'success',
                        200,
                        'Sesion cerrada correctamente',
                        'Ikusi arte, '. $usuarioLog->getNombre()
                    );  
                    $response -> sendJsonResponse();  
                }                    
            } 

        } else {
            $response = new JsonResponse(
                'Conflict',
                401,
                'Error',
                'No tiene la sesion iniciada'
            );
            $response -> sendJsonResponse();
        }     
    }
  
    
}




?>
