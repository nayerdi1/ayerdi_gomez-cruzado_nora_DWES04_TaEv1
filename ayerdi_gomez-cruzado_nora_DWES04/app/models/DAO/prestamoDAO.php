<?php
//require __DIR__ . "/../../../core/DataBaseSingleton.php";
require_once __DIR__ . "/../DTO/prestamoDTO.php";
require_once __DIR__ . "/../entity/prestamoEntity.php";

class PrestamoDAO{

    private $db;
    private $prestamosEntity = array();
    private $prestamosDTO = array();

    // constructor, construye instancia de DataBaseSingleton
    public function __construct(){
        $this->db = DataBaseSingleton::getInstance();
    }

    public function obtenerPrestamos(){
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM prestamos";
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($resultLibros);
        
        for($i=0;$i<count($result);$i++){
            $prestamoEntity = new PrestamoEntity($result[$i]['libro_id'], $result[$i]['usuario_id'], 
            $result[$i]['fecha_inicio'], $result[$i]['id'], $result[$i]['fecha_devolucion']);
            $prestamosEntity[] = $prestamoEntity;
        }
        return $prestamosEntity;
   
    }

    public function obtenerPrestamoPorId($id){
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM prestamos WHERE id=".$id;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($resultLibros);
        
        
        $prestamoEntity = new PrestamoEntity($result[0]['libro_id'], $result[0]['usuario_id'], 
            $result[0]['fecha_inicio'], $result[0]['id'], $result[0]['fecha_devolucion']);
            
        
        return $prestamoEntity;
   
    }



    public function crearPrestamo($data, $idUsuario) {
        
        $nuevoPrestamo = new PrestamoEntity( $data['libro_id'], $idUsuario, null);

        $connection = $this->db->getConnection();
        $query = "INSERT INTO prestamos (libro_id, usuario_id, fecha_inicio) VALUES ('" . $nuevoPrestamo->getLibroId() . "', 
                  '" . $nuevoPrestamo->getUsuarioId() . "', 
                  '" . $nuevoPrestamo->getFechaInicio() . "')";        
        $result = $connection->query($query);

        if($result){
            $instertId = $connection->lastInsertId();
            $sql = "SELECT * FROM prestamos WHERE id=".$instertId;
            $resultado = $connection->query($sql);
            $prestamoCreado = $resultado->fetchAll(PDO::FETCH_ASSOC);
           
            $nuevoPrestamo->setId($prestamoCreado[0]['id']);
                  
            $this->prestamosEntity[] = $nuevoPrestamo;
            $prestamoDTO =  new PrestamoDTO($nuevoPrestamo->getLibroId(), $nuevoPrestamo->getUsuarioId(),
                    $nuevoPrestamo->getFechaInicio(), $nuevoPrestamo->getId(),$nuevoPrestamo->getFechaDevolucion());
            
            return $prestamoDTO;
        }       
               
    }

    // comprueba la devolucion y la aniade a la base de datos
    function crearDevolucion($id) {
        $prestamo = $this->obtenerPrestamoPorId($id);
       // var_dump($prestamo);
       
        // comprueba si ya tiene aniadida la fecha de devolucion
        if($prestamo->getFechaDevolucion() != "" || $prestamo->getFechaDevolucion() != "0000-00-00"){
            return false;
        }
        $prestamo->setFechaDevolucion();
        
        $connection = $this->db->getConnection();
        $query = "UPDATE prestamos SET fecha_devolucion='".$prestamo->getFechaDevolucion()."' WHERE id= ".$id;
        $result = $connection->query($query);

        if($result){
            return true;
        } 
        return false;             
    }


    // comprueba si el usuario introducido es el que aparece en el prestamo
    // si coinciden, devuelve el id del libro del prestamo
    public function comprobarIDdevolucion($id, $idUsuario) {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM prestamos WHERE id=".$id;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        $prestamoDev = new PrestamoDTO ($result[0]['libro_id'], $result[0]['usuario_id'], 
                                    $result[0]['fecha_inicio'], $result[0]['id'], $result[0]['fecha_devolucion']);
        if($prestamoDev->getUsuarioId() == $idUsuario){
          //  var_dump($prestamoDev->getLibroId());
            return $prestamoDev->getLibroId();
        }
    }
}
?>