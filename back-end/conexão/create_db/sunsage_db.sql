-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/04/2024 às 01:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sunsage_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `ID` int(11) NOT NULL,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador_vaga`
--

CREATE TABLE `administrador_vaga` (
  `ID_administrador` int(11) DEFAULT NULL,
  `ID_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidato`
--

CREATE TABLE `candidato` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `CPF` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numero_telefone` varchar(20) DEFAULT NULL,
  `paths` varchar(100) NOT NULL,
  `situacao` varchar(20) NOT NULL DEFAULT 'não definida',
  `data_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `candidato`
--

INSERT INTO `candidato` (`ID`, `nome`, `CPF`, `email`, `numero_telefone`, `paths`, `situacao`, `data_envio`) VALUES
(16, 'Felipe Bochini', 2147483647, 'bochinifelipe@gmail.com', '15997741530', 'curriculos/6623cb02621e5.pdf', 'não definida', '2024-04-20 11:02:42'),
(17, '56629851896', 2147483647, 'bochinifelipe@gmail.com', '15997741530', 'curriculos/6626ec922dfa9.pdf', 'não definida', '2024-04-22 20:02:42'),
(18, '56629851896', 2147483647, 'bochinifelipe@gmail.com', '15997741530', 'curriculos/6628300f5c39f.pdf', 'não definida', '2024-04-23 19:02:55'),
(19, '56629851896', 2147483647, 'bochinifelipe@gmail.com', '15997741530', 'curriculos/662832d51516e.pdf', 'não definida', '2024-04-23 19:14:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidato_vaga`
--

CREATE TABLE `candidato_vaga` (
  `ID_candidato` int(11) DEFAULT NULL,
  `ID_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaga`
--

CREATE TABLE `vaga` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `administrador_vaga`
--
ALTER TABLE `administrador_vaga`
  ADD KEY `ID_vaga` (`ID_vaga`),
  ADD KEY `ID_administrador` (`ID_administrador`);

--
-- Índices de tabela `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `candidato_vaga`
--
ALTER TABLE `candidato_vaga`
  ADD KEY `ID_candidato` (`ID_candidato`),
  ADD KEY `ID_vaga` (`ID_vaga`);

--
-- Índices de tabela `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `candidato`
--
ALTER TABLE `candidato`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `administrador_vaga`
--
ALTER TABLE `administrador_vaga`
  ADD CONSTRAINT `administrador_vaga_ibfk_1` FOREIGN KEY (`ID_vaga`) REFERENCES `vaga` (`ID`),
  ADD CONSTRAINT `administrador_vaga_ibfk_2` FOREIGN KEY (`ID_administrador`) REFERENCES `administrador` (`ID`);

--
-- Restrições para tabelas `candidato_vaga`
--
ALTER TABLE `candidato_vaga`
  ADD CONSTRAINT `candidato_vaga_ibfk_1` FOREIGN KEY (`ID_candidato`) REFERENCES `candidato` (`ID`),
  ADD CONSTRAINT `candidato_vaga_ibfk_2` FOREIGN KEY (`ID_vaga`) REFERENCES `vaga` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
