-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Set-2022 às 16:38
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cursophp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `tel` int(13) NOT NULL,
  `cel` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produtos` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(30) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `quant` int(11) NOT NULL,
  `dt_atualizada` date NOT NULL,
  PRIMARY KEY (`id_produtos`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `senha` text NOT NULL,
  `perfil` int(10) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `perfil`, `cargo`) VALUES
(1, 'Administrador', 'MTIzYWRtaW4=', 10, 'Vedendor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id_vendas` int(11) NOT NULL AUTO_INCREMENT,
  `id_produtos` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_vendas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
