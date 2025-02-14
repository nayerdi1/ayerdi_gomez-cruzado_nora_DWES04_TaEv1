<?php

require_once __DIR__ . "/../models/DAO/prestamoDAO.php";
require_once __DIR__ . "/../models/DAO/usuarioDAO.php";
require_once __DIR__ . "/../models/DAO/libroDAO.php";


class Prestamos {

    private array $prestamos;
    private array $usuarios;
    private array $libros;
    private string $prestamoActualID = "";

    //--------------------FUNCIONES-------------------


    //-------------Funciones llamadas desde el controlador frontal----------------

    // LLama al resto de funciones para crear el prestamo y devuelve la respuesta al cliente
    function prestamo($data) {
        
        $prestamos = new PrestamoDAO();
        $usuarios = new UsuarioDAO();
        if($usuarios->comprobarSesion($data)){
            $libro = new LibroDAO();
           // var_dump($data);
            if($libro->consultarLibroDisponible($data)) {
                $idUsuario = $usuarios->comprobarID($data);
                
                $prestamoCreado = $prestamos->crearPrestamo($data, $idUsuario);
                if($prestamoCreado){
                    if($libro->cambiarDisponibilidadLibro(0, $data['libro_id'])){
                        $response =new JsonResponse(
                            "success",
                            200,
                            "Prestamo creado correctamente",
                            $prestamoCreado
                        );
                        $response-> sendJsonResponse();
                    }
                }                        
            } else {
                $response = new JsonResponse(
                    "Locked",
                    423,
                    "El libro no esta disponible",
                    "Error"
                );
                    $response-> sendJsonResponse();
            }
        }else {
            $response = new JsonResponse(
                "Unauthorized",
                401,
                "Debe iniciar sesion para pedir el prestamo",
                "Error"
            ); 
            $response-> sendJsonResponse();
        }
    }
   
    // LLama al resto de funciones para procesar la devolucion y devuelve la respuesta al cliente
    function devolucion($id, $data) {
        $prestamos = new PrestamoDAO();
        $usuarios = new UsuarioDAO();
        $libro = new LibroDAO();

        if ($usuarios->comprobarSesion($data)){
                $idUsuario1 = $usuarios->comprobarID($data);
                $idLibro = $prestamos->comprobarIDdevolucion($id,$idUsuario1);
                if($idLibro){
                    if($data['accion'] === "devolver libro") {    
                        if($prestamos->crearDevolucion($id)){ 
                            if($libro->cambiarDisponibilidadLibro(1, $idLibro)){ 
                                $respuesta = new JsonResponse(
                                    "success",
                                    200,
                                    "Devolucion registrada correctamente",
                                    "ok"
                                ); 
                                $respuesta-> sendJsonResponse();   
                                //respuestaJson(['mensaje' => 'La devolucion se ha registrado'], 200);
                            } else{
                                $respuesta = new JsonResponse(
                                    "Bad Request",
                                    400,
                                    "Error al registrar la devolucion",
                                    "ok"
                                );
                                $respuesta-> sendJsonResponse();
                            }
                        } else{
                            $respuesta = new JsonResponse(
                                "Bad Request",
                                400,
                                "Error al registrar la devolucion",
                                "Ese libro ya tenia una devolucion"
                            );
                            $respuesta-> sendJsonResponse();
                        }                       
                    }
                    
                } else{
                    $respuesta = new JsonResponse(
                        "Unauthorized",
                        401,
                        "Este usuario no tenía prestado ese libro",
                        "Error"
                    );
                    $respuesta-> sendJsonResponse();
                }       
        }else {
            $response = new JsonResponse(
                "Unauthorized",
                401,
                "Debe iniciar sesion para realizar la devolucion",
                "Error"
            );
            $respuesta-> sendJsonResponse();
        }
    }

}


?>