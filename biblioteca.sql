-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

-- Crear la tabla libros
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    disponible BOOLEAN DEFAULT TRUE
);

-- Insertar los registros en la tabla libros
INSERT INTO libros (titulo, autor, genero, disponible) VALUES
('1984', 'George Orwell', 'Ciencia ficcion', FALSE),
('Lagun izoztua', 'Joseba Sarrionandia', 'Euskal literatura', FALSE),
('Diez negritos', 'Agatha Christie', 'Novela policiaca', TRUE),
('Los hombres me explican cosas', 'Rebecca Solnit', 'Ensayo', FALSE),
('A las ocho en el Bule', 'Xabier Silveira', 'Narrativa', TRUE),
('Politica del malestar', 'Alicia Valdes', 'Politica', TRUE),
('Ostegunak', 'Jon Arretxe', 'Euskal literatura', TRUE);

-- Crear la tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasenia VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'usuario') NOT NULL,
    sesion_iniciada BOOLEAN NOT NULL DEFAULT FALSE
);

-- Insertar los registros en la tabla usuarios
INSERT INTO usuarios (usuario, contrasenia, rol, sesion_iniciada) VALUES
('nayerdi', SHA2('1234', 256), 'administrador', FALSE),
('iarana', SHA2('4321', 256), 'usuario', FALSE),
('aetxeberria', SHA2('2468', 256), 'usuario', FALSE),
('jarretxe', SHA2('1357', 256), 'usuario', FALSE),
('jurrutia', SHA2('5678', 256), 'usuario', FALSE),
('mgarcia', SHA2('8765', 256), 'usuario', FALSE),
('molasagasti', SHA2('1358', 256), 'usuario', FALSE);

-- Crear la tabla prestamos
CREATE TABLE IF NOT EXISTS prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_devolucion DATE NOT NULL,
    FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insertar los registros en la tabla prestamos
INSERT INTO prestamos (libro_id, usuario_id, fecha_inicio, fecha_devolucion) VALUES
(1, 1, '2024-10-10', '2024-10-24'),
(6, 2, '2024-12-13', '2024-12-27'),
(3, 3, '2024-11-15', '2024-11-30'),
(4, 4, '2024-09-20', '2024-10-05'),
(5, 5, '2024-10-01', '2024-10-15'),
(7, 6, '2024-10-25', '2024-11-10'),
(2, 1, '2024-12-19', '2024-12-19');

-- Insertar mas registros en la tabla libros
INSERT INTO libros (titulo, autor, genero, disponible) VALUES
('Fahrenheit 451', 'Ray Bradbury', 'Ciencia ficcion', TRUE),
('El nombre de la rosa', 'Umberto Eco', 'Novela historica', TRUE),
('Ensayo sobre la ceguera', 'José Saramago', 'Filosofia', FALSE),
('Harri eta herri', 'Gabriel Aresti', 'Euskal literatura', TRUE),
('La conjura de los necios', 'John Kennedy Toole', 'Humor', FALSE),
('El silencio de los corderos', 'Thomas Harris', 'Novela policiaca', TRUE),
('Sapiens: De animales a dioses', 'Yuval Noah Harari', 'Historia', TRUE),
('El guardian entre el centeno', 'J.D. Salinger', 'Novela', FALSE),
('Rayuela', 'Julio Cortázar', 'Narrativa', TRUE),
('El Hobbit', 'J.R.R. Tolkien', 'Fantasia', TRUE),
('Los pilares de la Tierra', 'Ken Follett', 'Novela historica', FALSE),
('El coronel no tiene quien le escriba', 'Gabriel García Márquez', 'Narrativa', TRUE),
('Moby Dick', 'Herman Melville', 'Aventura', FALSE),
('Eneida', 'Virgilio', 'Epica', TRUE),
('Kafka en la orilla', 'Haruki Murakami', 'Ficcion', TRUE),
('Americanah', 'Chimamanda Ngozi Adichie', 'Narrativa', FALSE),
('Crónica de una muerte anunciada', 'Gabriel García Márquez', 'Novela', TRUE);

ALTER TABLE usuarios MODIFY contrasenia VARCHAR(255) NOT NULL;
    select * from usuarios;
    UPDATE libros SET disponible= true WHERE id=8;
    select * from prestamos;