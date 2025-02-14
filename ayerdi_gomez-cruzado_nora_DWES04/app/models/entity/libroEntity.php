<?php

class LibroEntity {

    private string $titulo;
    private string $autor;
    private string $genero;
    private bool $disponible;
    private string $id;

    // Constructor
    public function __construct($titulo, $autor, $genero){ 
        $this->titulo = $titulo ?? "";
        $this->autor = $autor ?? "";
        $this->genero = $genero ?? "";
        $this->disponible = $disponible ?? true;
        $this->id = $id ?? "";
        
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor(): string
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero(): string
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     */
    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of disponible
     */
    public function getDisponible(): bool
    {
        return $this->disponible;
    }

    /**
     * Set the value of disponible
     */
    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

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
}
?>