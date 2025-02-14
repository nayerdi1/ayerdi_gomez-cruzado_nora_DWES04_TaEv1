<?php

require_once __DIR__ . "/../models/DAO/libroDAO.php";

class Libros {

    private array $libros;

  

    //-------------Funciones llamadas desde el controlador frontal----------------

    function consultarLibros() {
        $libroDAO = new libroDAO();
        $libros = $libroDAO->obtenerLibros();
        $response = new JsonResponse(
            "success",
            200,
            "Libros cargados correctamente:",
            $libros
        );  
        $response-> sendJsonResponse();

    }

    function consultarLibroId($id) {
        $libroDAO = new libroDAO();
        $libro = $libroDAO->obtenerLibroPorId($id); 
        $response = new JsonResponse(
            "success",
            200,
            "Libros cargados correctamente:",
            $libro
        ); 
        $response-> sendJsonResponse();
}

   

}





?>