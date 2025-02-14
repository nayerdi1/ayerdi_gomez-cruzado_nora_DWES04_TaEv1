<?php

class PrestamoEntity {

    private string $libro_id;
    private string $usuario_id; 
    private string $fecha_inicio; 
    private string $id;
    private string $fecha_devolucion ;

    // Constructor
    public function __construct($libro, $usuario, $id) {       
        $this->libro_id = $libro;
        $this->usuario_id = $usuario;
        $this->id = $id ?? "";
        $this->setFechaInicio();
        $this->fecha_devolucion = "";    
    }

    /**
     * Get the value of libro_id
     */
    public function getLibroId(): string
    {
        return $this->libro_id;
    }

    /**
     * Set the value of libro_id
     */
    public function setLibroId(string $libro_id): self
    {
        $this->libro_id = $libro_id;
        return $this;
    }

    /**
     * Get the value of usuario_id
     */
    public function getUsuarioId(): string
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     */
    public function setUsuarioId(string $usuario_id): self
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    /**
     * Get the value of fecha_inicio
     */
    public function getFechaInicio(): string
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of fecha_inicio
     */
    public function setFechaInicio(): self
    {
        $this->fecha_inicio = date('Y-m-d');
        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of fecha_devolucion
     */
    public function getFechaDevolucion(): string
    {
        return $this->fecha_devolucion;
    }

    /**
     * Set the value of fecha_devolucion
     */
    public function setFechaDevolucion(): self
    {
        $this->fecha_devolucion = date('Y-m-d');
        return $this;
    }
}

?>