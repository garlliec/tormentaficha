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

DROP DATABASE `tormentasite_db`;
CREATE DATABASE `tormentasite_db`;
USE `tormentasite_db`;

CREATE TABLE `Usuarios` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_user),

  `username` VARCHAR(128) NOT NULL,
  `email_user` VARCHAR(255) NOT NULL,
  `senha_hash` VARCHAR(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `Combate` (
  `id_combate` INT NOT NULL,
  PRIMARY KEY (id_combate),

  `dano` FLOAT NOT NULL DEFAULT '0.0', -- mudar
  `critico` INT NOT NULL DEFAULT '0.0',
  `multiplicador` INT  NOT NULL DEFAULT '0.0',
  `bonus` INT  NOT NULL DEFAULT '0.0',
  `pericia` INT NOT NULL DEFAULT '0.0'
);


CREATE TABLE `Inventario` (
  `id_inventario` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_inventario),

  `peso_atual` FLOAT NOT NULL DEFAULT '0.0',
  `peso_maximo` FLOAT NOT NULL DEFAULT '0.0',
  `dinheiro` FLOAT NOT NULL DEFAULT '0.0'
  -- `quantidade_maximo` FLOAT NOT NULL DEFAULT '0.0',
  -- `nome_inventario` VARCHAR(60) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

----------------------------------------------------------------

CREATE TABLE `Item_armadura` (
  `id_item` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_item),

  `id_inventario` INT NOT NULL,
  FOREIGN KEY (id_inventario) REFERENCES Inventario(id_inventario),

  `nome_armadura` VARCHAR(60) NOT NULL,
  `desc` VARCHAR(2048) DEFAULT "eu acho isso no lixo :D",
  -- ^^^ mudar

  `peso` FLOAT NOT NULL DEFAULT '0.0', -- mudar
  `defesa` FLOAT NOT NULL DEFAULT '0.0'
  -- `volume` FLOAT NOT NULL DEFAULT '0.0', -- mudar

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Item_arma` (
  `id_item` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_item),

  `id_inventario` INT NOT NULL,
  FOREIGN KEY (id_inventario) REFERENCES Inventario(id_inventario),

  `id_combate` INT NOT NULL,
  FOREIGN KEY (id_inventario) REFERENCES Inventario(id_inventario),

  `peso` FLOAT NOT NULL DEFAULT '0.0', -- mudar
  `desc` VARCHAR(2048) DEFAULT "eu acho isso no lixo :D",
  -- ^^^ mudar

  `nome_arma` VARCHAR(60) NOT NULL,
  -- `volume` FLOAT NOT NULL DEFAULT '0.0', -- mudar

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Item_outros` (
  `id_item` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_item),

  `id_inventario` INT NOT NULL,
  FOREIGN KEY (id_inventario) REFERENCES Inventario(id_inventario),

  `peso` FLOAT NOT NULL DEFAULT '0.0', -- mudar
  `volume` FLOAT NOT NULL DEFAULT '0.0', -- mudar
  `nome_outros` VARCHAR(60) NOT NULL,
  `desc` VARCHAR(2048) DEFAULT "eu acho isso no lixo :D",
  -- ^^^ mudar

  `tipo` VARCHAR(64) DEFAULT "Outros"

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

------------------------------------------------------------




CREATE TABLE `Racas` (
  `id_raca` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_raca),

  `nome_raca` VARCHAR(64) NOT NULL,
  -- `modificador_raca` INT

  `id_atributo` INT NOT NULL,
  FOREIGN KEY (id_atributo)

  -- ^^^ mudar
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Origens` (
  `id_origens` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_origens),

  `nome_origem` VARCHAR(64) NOT NULL,
  -- `itens_origem` VARCHAR(64) NOT NULL,
  -- `beneficios_origem` VARCHAR(64) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Atributos` (
  `id_atributo` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_atributo),

  `forca` INT NOT NULL,
  `des` INT NOT NULL, -- mudar
  `con` INT NOT NULL, -- mudar
  `intelecto` INT NOT NULL,
  `sab` INT NOT NULL, -- mudar
  `carisma` INT NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `Pericias` (
  `id_pericias` INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_pericias),

  `acrobacia` SMALLINT NOT NULL DEFAULT "0",
  `adestramento` SMALLINT NOT NULL DEFAULT "0",
  `atletismo` SMALLINT NOT NULL DEFAULT "0"

  -- etc

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `Habilidades` (
  -- chave composta
  `id_hab` INT NOT NULL,
  PRIMARY KEY (id_hab), -- composta, mudar depois

  `id_personagem` INT NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (id_personagem),

  `nome_hab` VARCHAR(64) NOT NULL,
  `desc_hab` VARCHAR(384) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `Magia` (
  -- chave composta
  `id_magia` INT NOT NULL,
  PRIMARY KEY (id_hab), -- composta, mudar depois

  `id_personagem` INT NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (id_personagem),

  `nome_magia` VARCHAR(64),
  `informacao_magia` VARCHAR(100),
  `desc_magia` VARCHAR(512)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `Personagens` (
  `id_personagem` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_personagem),

  `id_user` INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES Usuarios(id_user),

  `id_inventario` INT,
  FOREIGN KEY (id_inventario) REFERENCES Usuarios(id_user),

  `id_raca` INT,
  FOREIGN KEY (id_raca) REFERENCES Racas(id_raca),

  `id_atributo` INT,
  FOREIGN KEY (id_atributo) REFERENCES Atributos(id_atributo),

  `id_pericias` INT,
  FOREIGN KEY (id_pericias) REFERENCES Pericias(id_pericias),

  `id_origens` INT,
  FOREIGN KEY (id_origens) REFERENCES Origens(id_origens),

  `nome` VARCHAR(64) NOT NULL,
  `classe` VARCHAR(64) NOT NULL,
  `nivel` INT NOT NULL,
  `divindade` VARCHAR(64) NOT NULL,
  -- habilidades do personagem
  -- `tags` VARCHAR DEFAULT "[]",

  `foto` VARCHAR(128) NOT NULL -- arquivo de imagem no servidor

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
