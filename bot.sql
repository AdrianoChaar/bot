-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/09/2019 às 02:10
-- Versão do servidor: 10.4.6-MariaDB
-- Versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bot`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_acesso`
--

CREATE TABLE `tbl_acesso` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entrada` int(11) NOT NULL,
  `dt_entrada` date NOT NULL,
  `hr_entrada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tbl_acesso`
--

INSERT INTO `tbl_acesso` (`id`, `user_id`, `entrada`, `dt_entrada`, `hr_entrada`) VALUES
(1, 1, 1, '2019-09-29', '08:00:00'),
(2, 1, 2, '2019-09-29', '12:00:00'),
(3, 1, 3, '2019-09-29', '13:00:00'),
(4, 1, 4, '2019-09-29', '18:39:37'),
(5, 2, 1, '2019-09-28', '18:45:28'),
(6, 2, 2, '2019-09-28', '18:45:39'),
(7, 2, 3, '2019-09-28', '18:45:50'),
(8, 2, 4, '2019-09-28', '18:46:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_colaborador`
--

CREATE TABLE `tbl_colaborador` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tbl_colaborador`
--

INSERT INTO `tbl_colaborador` (`id`, `nome`, `login`, `senha`) VALUES
(1, 'Adriano Souto Chaar', 'adriano', 'brl100'),
(2, 'Rafaella Maggiotti Chaar', 'rafaella', '123456'),
(3, 'Lucas Maggiotti Chaar', 'lucas', '123456');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tbl_acesso`
--
ALTER TABLE `tbl_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_colaborador`
--
ALTER TABLE `tbl_colaborador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tbl_acesso`
--
ALTER TABLE `tbl_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbl_colaborador`
--
ALTER TABLE `tbl_colaborador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
