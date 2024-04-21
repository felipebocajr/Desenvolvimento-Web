
CREATE TABLE `administrador` (
  `ID` int(11) NOT NULL,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador_vaga`
--

CREATE TABLE `administrador_vaga` (
  `ID_administrador` int(11) DEFAULT NULL,
  `ID_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidato`
--

CREATE TABLE `candidato` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `CPF` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numero_telefone` int(11) DEFAULT NULL,
  `paths` varchar(100) NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

--
-- Despejando dados para a tabela `candidato`
--

INSERT INTO `candidato` (`ID`, `nome`, `CPF`, `email`, `numero_telefone`, `paths`, `data_envio`) VALUES
(1, 'Felipe Bochiniteste', 2147483647, 'bochinifelipe@gmail.com', 2147483647, '', '2024-04-20 00:52:01'),
(2, 'Felipe Bochinitestee', 2147483647, 'bochinifelipe@gmail.com', 2147483647, 'curriculos/66233d35d627a.pdf', '2024-04-20 00:57:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidato_vaga`
--

CREATE TABLE `candidato_vaga` (
  `ID_candidato` int(11) DEFAULT NULL,
  `ID_vaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaga`
--

CREATE TABLE `vaga` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
