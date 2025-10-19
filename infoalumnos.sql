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
    contrasenia VARCHAR(255) NOT NULL,
    rol ENUM('alumno', 'profe', 'admin') NOT NULL
);

-- 2. Subclase: ALUMNO
-- Contiene solo sus atributos específicos.
-- El 'idUsuario' es al mismo tiempo Llave Primaria (PK) y Llave Foránea (FK).
CREATE TABLE alumno (
    idUsuario INT PRIMARY KEY,
    legajo VARCHAR(50) NOT NULL UNIQUE,
    FOREIGN KEY (idUsuario) 
        REFERENCES usuario(idUsuario) 
        ON DELETE CASCADE
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
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE peticion(
  idUsuario int(11) NOT NULL,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  dni varchar(15) NOT NULL,
  email varchar(100) NOT NULL,
  rol varchar(20) NOT NULL,
  nombreMateria varchar(20) NULL,
  legajo int NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Tabla NOTA
-- Esta tabla conecta a un alumno con un profesor a través de una nota.
CREATE TABLE nota (
    idNota INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(4, 2) NOT NULL,
    fecha DATETIME NOT NULL,
    idAlumno_FK INT NOT NULL,
    idProfe_FK INT,
    FOREIGN KEY (idAlumno_FK) 
        REFERENCES alumno(idUsuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        
    FOREIGN KEY (idProfe_FK) 
        REFERENCES profe(idUsuario)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
