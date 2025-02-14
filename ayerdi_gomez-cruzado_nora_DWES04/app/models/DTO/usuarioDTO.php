<?php

class UsuarioDTO implements JsonSerializable
{
    //private array $usuarios = [];
    private string $id; 
    private string $nombre;
    private string $rol;

   

    // Constructor
    public function __construct($id, $nombre, $rol) {   
        $this->id = $id ?? '';        
        $this->nombre = $nombre ?? '';
        $this->rol = $rol ?? '';      
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getRol(): ?string{
        return $this->rol;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }

}
?>