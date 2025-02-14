-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

-- Crear la tabla libros
CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    disponible BOOLEAN NOT NULL
);

-- Insertar los registros en la tabla libros
INSERT INTO libros (id, titulo, autor, genero, disponible) VALUES
(001, '1984', 'George Orwell', 'Ciencia ficcion', FALSE),
(002, 'Lagun izoztua', 'Joseba Sarrionandia', 'Euskal literatura', FALSE),
(003, 'Diez negritos', 'Agatha Christie', 'Novela policiaca', TRUE),
(004, 'Los hombres me explican cosas', 'Rebecca Solnit', 'Ensayo', FALSE),
(005, 'A las ocho en el Bule', 'Xabier Silveira', 'Narrativa', TRUE),
(006, 'Politica del malestar', 'Alicia Valdes', 'Politica', TRUE),
(007, 'Ostegunak', 'Jon Arretxe', 'Euskal literatura', TRUE);


CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasenia VARCHAR(50) NOT NULL,
    rol ENUM('administrador', 'usuario') NOT NULL,
    sesion_iniciada BOOLEAN NOT NULL DEFAULT FALSE
);

INSERT INTO usuarios (id, usuario, password, rol, sesion_iniciada) VALUES
(01, 'nayerdi', '1234', 'administrador', FALSE),
(02, 'iarana', '4321', 'usuario', FALSE),
(03, 'aetxeberria', '2468', 'usuario', FALSE),
(04, 'jarretxe', '1357', 'usuario', FALSE),
(05, 'jurrutia', '5678', 'usuario', FALSE),
(06, 'mgarcia', '8765', 'usuario', FALSE),
(07, 'molasagasti', '1358', 'usuario', FALSE);

CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    usuario_id VARCHAR(50) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_devolucion DATE NOT NULL,
    FOREIGN KEY (libro_id) REFERENCES libros(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO prestamos (id, libro_id, usuario_id, fecha_inicio, fecha_devolucion) VALUES
(1, 001, 01, '2024-10-10', '2024-10-24'),
(2, 006, 02, '2024-12-13', '2024-12-27'),
(3, 003, 03, '2024-11-15', '2024-11-30'),
(4, 004, 04, '2024-09-20', '2024-10-05'),
(5, 005, 05, '2024-10-01', '2024-10-15'),
(6, 007, 06, '2024-10-25', '2024-11-10'),
(7, 002, 01, '2024-12-19', '2024-12-19');


    