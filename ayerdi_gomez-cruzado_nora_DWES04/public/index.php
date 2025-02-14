<?php

require_once __DIR__ .'/../core/router.php';
require_once __DIR__ .'/../app/controllers/Admin.php';
require_once __DIR__ .'/../app/controllers/Libros.php';
require_once __DIR__ .'/../app/controllers/Prestamos.php';
require_once __DIR__ .'/../app/controllers/Usuarios.php';
require_once __DIR__ . '/../utils/jsonData.php';
require_once __DIR__ . "/../utils/jsonResponse.php";
require_once __DIR__ . '/../core/DataBaseSingleton.php';

$url = $_SERVER['QUERY_STRING'];



$router = new Router();
$router -> add('public/login', array (
    'controller' => 'Usuarios',
    'action' => 'login'
));
$router -> add('public/salir', array (
    'controller' => 'Usuarios',
    'action' => 'salir'
));
$router -> add('public/libros', array (
    'controller' => 'Libros',
    'action' => 'consultarLibros'
));
$router -> add('public/libros/{id}', array (
    'controller' => 'Libros',
    'action' => 'consultarLibroId'
));
$router -> add('public/prestamos', array (
    'controller' => 'Prestamos',
    'action' => 'prestamo'
));
$router -> add('public/prestamos/{id}', array (
    'controller' => 'Prestamos',
    'action' => 'devolucion'
));
$router -> add('public/admin/create', array (
    'controller' => 'Admin',
    'action' => 'aniadirLibro'
));
$router -> add('public/admin/update/{id}', array (
    'controller' => 'Admin',
    'action' => 'modificarLibro'
));
$router -> add('public/admin/delete/{id}', array (
    'controller' => 'Admin',
    'action' => 'borrarLibro'
));


if ($router->matchRoutes($url)) {
    
    $method = $_SERVER['REQUEST_METHOD'];
    $params = [];
    
    if($method === 'GET' ) {
        // Agrega el id al arreglo de parámetros
        $params['id'] = $router->getParams()['id'] ?? NULL;
  

    } elseif($method === 'POST') {
        $json = file_get_contents('php://input');  
        $params[] = json_decode($json, true);
    
    } elseif($method === 'PUT' || $method === 'DELETE') {
        $params['id'] = $router->getParams()['id'] ?? NULL;   
        $json = file_get_contents('php://input');
        $params[] = json_decode($json, true);
     

    } 
    $controller = $router -> getParams()['controller'];
    
    $action = $router -> getParams()['action'];
    $controller = new $controller();
   
    if(method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], array_values($params));
    } else {
        $response = new JsonResponse(
            "Not found",
            404,
            "El metodo no existe",
            "error"
        );
        $response->sendJsonResponse();        
    }

}else {
    $response = new JsonResponse(
        "Not found",
        404,
        "El Endpoint no existe",
        "error"
    );
    $response-> sendJsonResponse();
  
}



?>