<?php

class JsonData {
    private $dataFilePath;

    public function __construct($dataFile){
        $this -> dataFilePath = $dataFile; 
    }


    public function getAll(){
        $json = file_get_contents($this->dataFilePath);
        $data = json_decode($json, true);
        $arrayUsuarios = [];
        foreach ($data['usuarios'] as $usuario) {
            $nuevoUsuario= new Usuario(
                $usuario['id'],
                $usuario['usuario'],
                $usuario['password'],
                $usuario['rol'],
                $usuario['sesion_iniciada']
            );
            $arrayUsuarios[]= $nuevoUsuario;
        } 
        return $arrayUsuarios;
    }
}

?>