-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Set-2019 às 16:44
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemadelogin`
--
DROP DATABASE IF EXISTS `sistemadelogin`;
CREATE DATABASE IF NOT EXISTS `sistemadelogin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `sistemadelogin`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `nomeUsuario` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `senha` char(40) COLLATE utf8mb4_bin NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `avatar_url` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `nomeUsuario`, `email`, `senha`, `dataCriacao`, `avatar_url`) VALUES
(1, 'leandro', 'leandro', 'leandro@jooj.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 13:42:04', ''),
(2, 'leandru', 'leandru', 'leandro@jooj', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 16:02:14', ''),
(3, 'leandroZanela', 'Leandro', 'leandro@jooooj', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 16:21:47', 'https://www.google.com.br/url?sa=i&amp;source=images&amp;cd=&amp;cad=rja&amp;uact=8&amp;ved=2ahUKEwi_wbTa8rzkAhWMCrkGHdBJAJsQjRx6BAgBEAQ&amp;url=%2Furl%3Fsa%3Di%26source%3Dimages%26cd%3D%26ved%3D%26ur'),
(4, 'roger', 'roger', 'roger@viado', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 16:28:57', 'https://commons.wikimedia.org/wiki/File:Stonehenge.jpg'),
(5, 'igorGay', 'igorGay', 'igor@gay', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 16:34:08', 'https://pt.wikipedia.org/wiki/Imagem#/media/Ficheiro:Image_created_with_a_mobile_phone.png'),
(6, 'leandrooooo', 'leandro04', 'leandro04@jooj', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-09-06 16:42:00', 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Alvorada_de_outono_na_Imagem_de_Minas.JPG');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
