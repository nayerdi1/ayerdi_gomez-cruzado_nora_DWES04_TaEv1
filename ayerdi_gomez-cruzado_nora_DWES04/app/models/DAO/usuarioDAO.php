<?php

require_once __DIR__ . "/../DTO/usuarioDTO.php";
require_once __DIR__ . "/../entity/usuarioEntity.php";

    class UsuarioDAO{

        private $db;
        private $usuarioEntity;

        // constructor, construye instancia de DataBaseSingleton
        public function __construct(){
            $this->db = DataBaseSingleton::getInstance();
        }

        // comprueba si la sesion del usuario ya esta iniciada
        // devuelve true o false
        public function comprobarSesion($data){
            $connection = $this->db->getConnection();
            $query = "SELECT * FROM usuarios WHERE usuario = '".$data['usuario']."'"; 
            $statement = $connection->query($query);
              
            $usuario = $statement->fetch(PDO::FETCH_ASSOC);

            // parsear a UsuarioEntity
            $this->usuarioEntity = new UsuarioEntity($usuario['id'],$usuario['usuario'], $usuario['contrasenia'],
                                $usuario['rol'], $usuario['sesion_iniciada']);
            
            if($this->usuarioEntity->getSesion() == true){
                return true;
            }                    
            return false;    
        }
        
        // comprueba que el nombre y la contrasenia introducidos sean correctos
        function comprobarUsuario($data) { 
         
            if($this->usuarioEntity->getNombre() == $data['usuario'] && $this->usuarioEntity->verifyPassword($data['password'])){
                    return new UsuarioDTO($this->usuarioEntity->getId(), $this->usuarioEntity->getNombre(), 
                        $this->usuarioEntity->getRol());
            }         
        }

        // actualiza la sesion del usuario
        public function actualizarSesion($sesion) {

            $id = $this->usuarioEntity->getId();           
            // Establecer la conexión a la base de datos
            $connection = $this->db->getConnection();
            $query = "UPDATE usuarios SET sesion_iniciada =:sesion_iniciada WHERE id =:id";
            $statement = $connection->prepare($query);           
            // Vincular los parámetros
            $statement->bindParam(':sesion_iniciada', $sesion, PDO::PARAM_BOOL);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);  
            // Ejecutar la consulta
            $statement->execute();

            if($statement){
                return true;
            }
            return false;
        }

        // Comprueba el Id 
        function comprobarID($data){
                if($this->usuarioEntity->getNombre() == $data['usuario']){
                    $usuarioDTO = new UsuarioDTO($this->usuarioEntity->getId(), $this->usuarioEntity->getNombre(), $this->usuarioEntity->getRol());
                    return $usuarioDTO->getId();
                }
        }

        // comprueba si el usuario introducido tiene rol de administrador
        function comprobarAdmin($data){
            $connection = $this->db->getConnection();
            $query = "SELECT * FROM usuarios WHERE usuario = '".$data['usuario']."'"; 
            $statement = $connection->query($query);

            $usuario = $statement->fetch(PDO::FETCH_ASSOC);

            $usuarioEntity = new UsuarioEntity($usuario['id'],$usuario['usuario'], $usuario['contrasenia'],
                                $usuario['rol'], $usuario['sesion_iniciada']);
  
            if($usuarioEntity->getRol() == "administrador"){
                return true;           
            }
            return false;
        }
        
    }
?>