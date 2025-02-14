<?php

    class UsuarioEntity{
        
        private string $id ;
        private string $nombre;
        private string $rol;
        private string $passwordHash;
        private bool $sesion_iniciada;

        // Constructor
        public function __construct($id, $nombre, $password, $rol, $sesion) {      
            $this->id = $id ?? '';
            $this->nombre = $nombre ?? '';
            $this->setPassword($password);
            $this->rol = $rol ?? '';
            $this->sesion_iniciada = $sesion ?? '';         
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
         * Get the value of nombre
         */
        public function getNombre(): string
        {
            return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre(string $nombre): self
        {
            $this->nombre = $nombre;

            return $this;
        }

        /**
         * Get the value of rol
         */
        public function getRol(): string
        {
            return $this->rol;
        }

        /**
         * Set the value of rol
         */
        public function setRol(string $rol): self
        {
            $this->rol = $rol;

            return $this;
        }

        /**
         * Get the value of sesion_iniciada
         */
        public function getSesion(): bool
        {
            return $this->sesion_iniciada;
        }

        /**
         * Set the value of sesion_iniciada
         */
        public function setSesion(bool $sesion_iniciada): self
        {
            $this->sesion_iniciada = $sesion_iniciada;

            return $this;
        }

        public function getPasswordHash(): string {
            return $this->passwordHash;
        }
    
        // Setter para cifrar la contraseña antes de almacenarla
        public function setPassword(string $password): void {
            $this->passwordHash = $this->hashPassword($password);
        }
    
        // Método para encriptar la contraseña usando Bcrypt
        private function hashPassword(string $password): string {
            return password_hash($password, PASSWORD_BCRYPT);
        }
    
        // Método para verificar si la contraseña ingresada es correcta
        public function verifyPassword(string $password): bool {
            return password_verify($password, $this->passwordHash);
        }
    }
?>