<?php
require __DIR__ . "/../../../core/DataBaseSingleton.php";
require_once __DIR__ . "/../DTO/libroDTO.php";
require_once __DIR__ . "/../entity/libroEntity.php";

class LibroDAO{

    private $db;

    // constructor, construye instancia de DataBaseSingleton
    public function __construct(){
        $this->db = DataBaseSingleton::getInstance();
    }

    public function obtenerLibros(){
        $connection = $this->db->getConnection();
        $queryLibros = "SELECT * FROM libros";
        $statement = $connection->query($queryLibros);
        $resultLibros = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($resultLibros);
        $librosDTO = array();
        for($i=0;$i<count($resultLibros);$i++){
            $libroDTO = new LibroDTO($resultLibros[$i]['titulo'], $resultLibros[$i]['autor'], 
            $resultLibros[$i]['genero'], $resultLibros[$i]['disponible']);
            $librosDTO[] = $libroDTO;
        }
        
        return $librosDTO;
        
    }

    public function obtenerLibroPorId($id){
        
        $result = $this->libroId($id);
        //var_dump($result);
        $libroDTO = new LibroDTO($result[0]['titulo'], $result[0]['autor'], $result[0]['genero'], $result[0]['disponible']);
        
        return $libroDTO;
        
    }

    public function consultarLibroDisponible($data){
        $result = $this->libroId($data['libro_id']);
        var_dump($result);
        $libro = new LibroEntity($result[0]['titulo'], $result[0]['autor'], $result[0]['genero']);
        $libro->setDisponible($result[0]['disponible']);
        $libro->setId($result[0]['id']);
        var_dump($libro->getDisponible());
        if($libro->getDisponible() == 1){
            return true;
        }
        return false;

    } 


    public function libroId($id) {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM libros WHERE id =".$id;
        $statement = $connection->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);   
    }

    // modifica el campo disponible en la base de datos
    function cambiarDisponibilidadLibro($disponible, $id) {
        //var_dump($disponible);
        $id = intval($id);                  
        $connection = $this->db->getConnection();
        $sql = "UPDATE libros SET disponible =".$disponible." WHERE id =".$id; 
        $resultado = $connection->query($sql); 

        //$resultado->bindParam(':disponible', $disponible, PDO::PARAM_BOOL);
      //  $resultado->bindParam(':id', $id, PDO::PARAM_INT);
      //  $resultado->execute();

        if($resultado) {  
            return true;                                   
        }
        return false;        
    }

    // aniade un nuevo libro a la base de datos
    function nuevoLibro($data){
        $titulo = $data['titulo'];
        $autor = $data['autor'];
        $genero = $data['genero'];

        $nuevoLibro = new LibroEntity($data['titulo'], $data['autor'], $data['genero']);

        $connection = $this->db->getConnection();
        $query = "INSERT INTO libros (titulo, autor, genero) VALUES ('" . $nuevoLibro->getTitulo() . "', 
                  '" . $nuevoLibro->getAutor() . "', 
                  '" . $nuevoLibro->getGenero() . "')";
        $result = $connection->query($query);
        if($result){
            return true;
        }    
    }

    // modifica el libro de la base de datos
    // devuelve true o false
    function modificar($id, $data) {
        if($this->comprobarLibro($id)){
            $nuevoLibro = new LibroEntity($data['titulo'], $data['autor'], $data['genero']);
            $nuevoLibro->setId($id);
            $connection = $this->db->getConnection();
            $query = "UPDATE libros 
                SET titulo = '".$nuevoLibro->getTitulo()."', 
                    autor = '". $nuevoLibro->getAutor()."', 
                    genero = '".$nuevoLibro->getGenero()."', 
                    disponible = ".$nuevoLibro->getDisponible()."
                WHERE id = ".$nuevoLibro->getId(); 
            $resultado = $connection->query($query); 
            if($resultado) {
                return true;
            }
            return false;
        }
    }

    // borra el libro de la base de datos
    // devuelve true o false
    function borrar($id) {     
        if($this->comprobarLibro($id)){
            $connection = $this->db->getConnection();
            $query = "DELETE FROM libros WHERE id =".$id; 
            $resultado = $connection->query($query);  
            if($resultado) {
                return true;
            }    
        }
        return false;   
    }

    // devuelve true si el libro existe
    function comprobarLibro($id){
        $connection = $this->db->getConnection();
        $sql = "SELECT * FROM libros WHERE id=".$id;
        $respuesta = $connection->query($sql);
        $result = $respuesta->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        if($result){
            return true;
        }
        return false;
    }

  //  $libro = new LibroEntity($datos['titulo'], $datos['autor'], $datos['genero'], $datos['disponible'], $datos['id'],);
//agregarLibro($libro);
/*
function agregarLibro($nombre, $titulo, $autor, $genero, $anio) {
    $connection = $this->db->getConnection();

    $query = "INSERT INTO libros (nombre, titulo, autor, genero, año) 
              VALUES (:nombre, :titulo, :autor, :genero, :anio)";
    $stmt = $connection->prepare($query);

    return $stmt->execute([
        ':nombre' => $nombre,
        ':titulo' => $titulo,
        ':autor' => $autor,
        ':genero' => $genero,
        ':anio' => $anio
    ]);
}*/

}


?>
