-- phpMyAdmin SQL Dump
-- versión 2.8.1
-- Servidor: localhost
-- Base de datos: `infoautos`

-- --------------------------------------------------------
-- Tabla: rol
CREATE TABLE `rol` (
  `idRol` INT AUTO_INCREMENT PRIMARY KEY,
  `nombreRol` VARCHAR(50) NOT NULL
);

-- Datos iniciales de roles
INSERT INTO `rol` (`nombreRol`) VALUES ('Alumno'), ('Profesor');

-- --------------------------------------------------------
-- Tabla: alumno
CREATE TABLE `alumno` (
  `idAlumno` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `dni` VARCHAR(15) UNIQUE,
  `fechaNacimiento` DATE,
  `email` VARCHAR(100) UNIQUE,
  `telefono` VARCHAR(20),
  `idRol` INT NOT NULL DEFAULT 1, 
  FOREIGN KEY (`idRol`) REFERENCES `rol`(`idRol`)
);

-- Datos de ejemplo
INSERT INTO `alumno` (`nombre`, `apellido`, `dni`, `fechaNacimiento`, `email`, `telefono`)
VALUES 
('Maria', 'Lopez', '12334355', '1875-06-23', 'maria@gmail.com', '299-5234465'),
('Natalia', 'Gomez', '28326986', '1975-06-21', 'natalia@gmail.com', '299-6543215');

-- --------------------------------------------------------
-- Tabla: profesor
CREATE TABLE `profesor` (
  `idProfesor` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `dni` VARCHAR(15) UNIQUE,
  `especialidad` VARCHAR(100),
  `email` VARCHAR(100) UNIQUE,
  `telefono` VARCHAR(20),
  `idRol` INT NOT NULL DEFAULT 2,
  FOREIGN KEY (`idRol`) REFERENCES `rol`(`idRol`)
);

-- Datos de ejemplo
INSERT INTO `profesor` (`nombre`, `apellido`, `dni`, `especialidad`, `email`, `telefono`)
VALUES
('Pedro', 'Perez', '20123456', 'Matemática', 'pedro@gmail.com', '299-1234567'),
('Laura', 'Martinez', '30234567', 'Física', 'laura@gmail.com', '299-7654321');
