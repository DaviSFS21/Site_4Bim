-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2022 às 02:56
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pai_e_filhos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cod_prod` int(11) NOT NULL,
  `nome_prod` varchar(120) NOT NULL,
  `desc_prod` varchar(450) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `path_img` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod_prod`, `nome_prod`, `desc_prod`, `marca`, `path_img`) VALUES
(63, 'Caneta azul com fuzil', 'Manoel Gomi segurando um fuzil 7.62mm', '22333', '../assets/imagens_prod/633b3e959cfe2.jpg'),
(64, 'Mercedes AMG Project One', 'Dirigindo uma Mercedes no Forza Horizon 5', 'Forza Horizon 5', '../assets/imagens_prod/633b3eb946ef6.png'),
(65, 'Kirby e Heisenberg', 'Um fabricante de alucinógenos e um fruto de uma alucinação.', 'Crossplay maluco', '../assets/imagens_prod/633b404879175.jpg'),
(66, 'Calendário', 'Calendário de 2019', 'Sim', '../assets/imagens_prod/633b4f77a891d.jpg'),
(67, 'Victory Royale', 'Na companhia do soldado Matheus, ganhamos uma partida duo no Fortnite.', 'Fortnite', '../assets/imagens_prod/633b86689bb5a.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpf` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tel` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `admin`, `email`, `nome`, `senha`, `tel`) VALUES
(8, 0, 'matheus08@email.com', 'Matheus Schiavão', '5ec0660a4dcecb1b6ff4ca1a1d48ca532deae433', 1208),
(21, 1, 'davi21@email.com', 'Davi Soares', '24a33963e322e89d7dbc4ad6011769adbcfe43a7', 129);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod_prod`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
