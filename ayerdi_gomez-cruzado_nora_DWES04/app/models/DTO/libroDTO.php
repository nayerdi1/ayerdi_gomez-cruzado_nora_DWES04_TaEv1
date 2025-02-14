<?php

    class LibroDTO implements JsonSerializable{
        private string $titulo;
        private string $autor;
        private string $genero;
        private bool $disponible;
        private string $id;

        // Constructor
        public function __construct($titulo, $autor, $genero, $disponible){ 
            $this->titulo = $titulo ?? "";
            $this->autor = $autor ?? "";
            $this->genero = $genero ?? "";
            $this->disponible = $disponible ?? false;
        }

        

        /**
         * Get the value of titulo
         */
        public function getTitulo(): string
        {
                return $this->titulo;
        }


        /**
         * Get the value of autor
         */
        public function getAutor(): string
        {
                return $this->autor;
        }

      
        /**
         * Get the value of genero
         */
        public function getGenero(): string
        {
                return $this->genero;
        }      

        /**
         * Get the value of disponible
         */
        public function getDisponible(): bool
        {
                return $this->disponible;
        }
       
    
        public function jsonSerialize(){
            return get_object_vars($this);
        }
    }


?>