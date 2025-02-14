<?php

class PrestamoDTO implements JsonSerializable{

    private string $libro_id;
    private string $usuario_id; 
    private string $fecha_inicio; 
    private string $id;
    private string $fecha_devolucion ;

    // Constructor
    public function __construct($libro, $usuario, $inicio, $id, $fin){       
        $this->libro_id = $libro ?? '';
        $this->usuario_id = $usuario ?? '';
        $this->fecha_inicio = $inicio ?? '';
        $this->id = $id ?? '';
        $this->fecha_devolucion = $fin ?? '';
    
    }

    /**
     * Get the value of libro_id
     */
    public function getLibroId(): string
    {
        return $this->libro_id;
    }

    /**
     * Get the value of usuario_id
     */
    public function getUsuarioId(): string
    {
        return $this->usuario_id;
    }

    /**
     * Get the value of fecha_inicio
     */
    public function getFechaInicio(): string
    {
        return $this->fecha_inicio;
    }

    /**
     * Get the value of id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the value of fecha_devolucion
     */
    public function getFechaDevolucion(): string
    {
        return $this->fecha_devolucion;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>