<?php

require_once __DIR__ . "/../models/DAO/usuarioDAO.php";
require_once __DIR__ . "/../models/DAO/libroDAO.php";

class Admin {

    private array $usuarios;
    private array $libros;

    //--------------------FUNCIONES-------------------

    //--------------------Funciones llamadas desde el controlador frontal-------------------

    // Comprueba si el usuario tiene la sesion iniciada y si es Administrador
    // Añade el nuevo libro
    // Devuelve mensaje de exito o error
    function aniadirLibro($data) {
        $usuario = new UsuarioDAO();
        $libro = new LibroDAO();
        if ($usuario->comprobarSesion($data)){
            if($usuario->comprobarAdmin($data)){
                if($libro->nuevoLibro($data)){
                    $response = new JsonResponse(
                        "success",
                        200,
                        "Libro creado correctamente",
                        "ok"
                    );
                    $response-> sendJsonResponse();
                }                   
            } else {
                $response = new JsonResponse(
                    "Unauthorized",
                    401,
                    "no tiene permiso de administrador",
                    "error"
                );
                $response-> sendJsonResponse();
            }        
        }else {
            $response = new JsonResponse(
                "Unauthorized",
                401,
                "Debe iniciar sesion",
                "error"
            );
            $response-> sendJsonResponse();
        }
    }

    // Comprueba si el usuario tiene la sesion iniciada y si es Administrador
    // Modifica el libro
    // Devuelve mensaje de exito o error
    function modificarLibro($id, $data) {
        $usuario = new UsuarioDAO();
        $libro = new LibroDAO();
        if ($usuario->comprobarSesion($data)){
            if($usuario->comprobarAdmin($data)){
                if($libro->modificar($id, $data)) {
                    $response = new JsonResponse(
                        "success",
                        200,
                        "Libro modificado correctamente",
                        "ok"
                    );
                    $response-> sendJsonResponse();
                } else{
                    $response = new JsonResponse(
                        "Not Found",
                        404,
                        "El libro no existe",
                        "error"
                    );
                    $response-> sendJsonResponse();
                }
            }else {
                $response = new JsonResponse(
                    "Unauthorized",
                    401,
                    "No tienes permiso de administrador",
                    "error"
                );
                $response-> sendJsonResponse();
            }
        }else {
            $response = new JsonResponse(
                "Unauthorized",
                401,
                "Primero debes iniciar sesion",
                "error"
            );
            $response-> sendJsonResponse();
        }
    }

    // Comprueba si el usuario tiene la sesion iniciada y si es Administrador
    // Borra el libro
    // Devuelve mensaje de exito o error
    function borrarLibro($id, $data) {
        $usuario = new UsuarioDAO();
        $libro = new LibroDAO();
        if ($usuario->comprobarSesion($data)){
            if($usuario->comprobarAdmin($data)){
                if($libro->borrar($id)) {
                    $response = new JsonResponse(
                        "success",
                        200,
                        "Libro borrado correctamente",
                        "ok"
                    );
                    $response-> sendJsonResponse();
                } else{
                    $response = new JsonResponse(
                        "Not Found",
                        404,
                        "El libro no existe",
                        "error"
                    );
                    $response-> sendJsonResponse();
                }
            }else {
                $response = new JsonResponse(
                    "Unauthorized",
                    401,
                    "No tienes permiso de administrador",
                    "error"
                );
                $response-> sendJsonResponse();
            }
        }else {
            $response = new JsonResponse(
                "Unauthorized",
                401,
                "Primero debes iniciar sesion",
                "error"
            );
            $response-> sendJsonResponse();
        }
    }

}

?>