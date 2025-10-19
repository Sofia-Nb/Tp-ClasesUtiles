-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2025 a las 21:17:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infoalumnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

-- 1. Tabla Padre: USUARIO
-- Contiene todos los atributos comunes.
CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(10) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    contrasenia VARCHAR(255) NOT NULL, -- Importante: Guardar siempre un HASH, no texto plano.
    rol ENUM('alumno', 'profe', 'admin') NOT NULL -- El rol nos ayuda a saber qué tabla hija buscar.
);

-- 2. Subclase: ALUMNO
-- Contiene solo sus atributos específicos.
-- El 'idUsuario' es al mismo tiempo Llave Primaria (PK) y Llave Foránea (FK).
CREATE TABLE alumno (
    idUsuario INT PRIMARY KEY,
    legajo VARCHAR(50) NOT NULL UNIQUE,
    FOREIGN KEY (idUsuario) 
        REFERENCES usuario(idUsuario) 
        ON DELETE CASCADE, 
        ON UPDATE CASCADE
);

-- 3. Subclase: PROFE
-- Contiene solo sus atributos específicos.
-- El 'idUsuario' es también PK y FK.
CREATE TABLE profe (
    idUsuario INT PRIMARY KEY,
    nombreMateria VARCHAR(150),
    FOREIGN KEY (idUsuario) 
        REFERENCES usuario(idUsuario) 
        ON DELETE CASCADE , 
        ON UPDATE CASCADE
);

-- 4. Tabla NOTA
-- Esta tabla conecta a un alumno con un profesor a través de una nota.
CREATE TABLE nota (
    idNota INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(4, 2) NOT NULL, -- Ej: 9.50 o 10.00
    fecha DATETIME NOT NULL,
    
    -- Relación (1:M) "tiene" con Alumno
    idAlumno_FK INT NOT NULL,
    
    -- Relación (1:M) "carga" con Profe
    idProfe_FK INT, -- Puede ser NULL si el profe es borrado

    -- Definición de las llaves foráneas
    FOREIGN KEY (idAlumno_FK) 
        REFERENCES alumno(idUsuario)
        ON DELETE CASCADE, , 
        ON UPDATE CASCADE

    FOREIGN KEY (idProfe_FK) 
        REFERENCES profe(idUsuario)
        ON DELETE SET NULL , 
        ON UPDATE CASCADE
);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
