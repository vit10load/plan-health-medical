-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 23-Mar-2020 às 18:41
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_xp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE IF NOT EXISTS `consulta` (
  `id_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext,
  `query_date` date NOT NULL,
  `value` double NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`id_consulta`, `description`, `query_date`, `value`, `fk_user_id`) VALUES
(9, 'Uma consulta pro vitor para somar um valor da consulta para o medico pedro honda', '2020-03-18', 2300, 1),
(10, 'Agora um consulta marcada para jose no valor de 300,00.', '2020-03-27', 300, 1);

--
-- Acionadores `consulta`
--
DROP TRIGGER IF EXISTS `salary_medical`;
DELIMITER $$
CREATE TRIGGER `salary_medical` BEFORE INSERT ON `consulta` FOR EACH ROW BEGIN 
	UPDATE user SET user.value = (user.value + NEW.value) WHERE user.user_id = NEW.fk_user_id AND user.user_type = "medico"; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_saude`
--

DROP TABLE IF EXISTS `plano_saude`;
CREATE TABLE IF NOT EXISTS `plano_saude` (
  `id_plano` int(11) NOT NULL AUTO_INCREMENT,
  `acomodacao` varchar(255) DEFAULT NULL,
  `segmentacao` varchar(255) DEFAULT NULL,
  `reembolso` varchar(3) DEFAULT NULL,
  `rede_medica` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_plano`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plano_saude`
--

INSERT INTO `plano_saude` (`id_plano`, `acomodacao`, `segmentacao`, `reembolso`, `rede_medica`) VALUES
(13, 'Outra acomodacao', 'abulatorio', 'sim', 'SUS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_saude_has_user`
--

DROP TABLE IF EXISTS `plano_saude_has_user`;
CREATE TABLE IF NOT EXISTS `plano_saude_has_user` (
  `id_plano_has_user` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_plano_saude_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_plano_has_user`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_plano_saude_id` (`fk_plano_saude_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plano_saude_has_user`
--

INSERT INTO `plano_saude_has_user` (`id_plano_has_user`, `fk_user_id`, `fk_plano_saude_id`) VALUES
(1, 2, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_age` int(11) NOT NULL,
  `user_mobile` int(11) NOT NULL,
  `value` double NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_age`, `user_mobile`, `value`, `user_type`) VALUES
(1, 'Pedro Honda', 'pedro@gmail.com', '202cb962ac59075b964b07152d234b70', 67, 35344646, 2600, 'medico'),
(2, 'Vitor', 'vitoro580@gmail.com', '202cb962ac59075b964b07152d234b70', 21, 232323232, 0, 'paciente'),
(3, 'Jose', 'jose580@gmail.com', '202cb962ac59075b964b07152d234b70', 55, 243543545, 0, 'medico');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
