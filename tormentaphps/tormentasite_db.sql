-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 06:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tormentasite_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE DATABASE `tormentasite_db`;
USE `tormentasite_db`;
CREATE TABLE `Usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `senha_hash` varchar(64) NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Personagens` (
  `id_personagem` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_personagem),

  `id_user` int NOT NULL,
  FOREIGN KEY (id_user) REFERENCES Usuarios(id_user),


  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `classe` varchar(255) NOT NULL,
  -- abilidades do personagem
  `tags` VARCHAR DEFAULT "[]",
  `foto` varchar(128) NOT NULL, -- arquivo de imagem no servidor

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- tabela abilidades

--
-- AUTO_INCREMENT for table `usuarios`
--
-- ALTER TABLE `usuarios`
  -- MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
