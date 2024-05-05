
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `administrador` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `administrador` (`ID`, `nome_usuario`, `senha`, `email`, `nome_completo`, `data_criacao`) VALUES
(0, 'silva_maria.admin', 'maria123', 'maria.silva@gmail.com', 'Maria da Silva', NULL),
(0, 'santos_joao.admin', 'joao123', 'joao.santos@gmail.com', 'João Santos', NULL),
(0, 'oliveira_andre.admin', 'andre123', 'andre.oliveira@gmail.com', 'André Oliveira', NULL);

CREATE TABLE `vaga` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(100) DEFAULT NULL,
  `vagas_livres` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `vaga` (`ID`, `nome`, `vagas_livres`) VALUES
(1, 'Engenheiro de Energia Solar', 5),
(2, 'Consultor de Eficiência Energética', 3),
(3, 'Técnico em Instalação de Energia Solar', 4),
(4, 'Analista de Marketing Verde', 2),
(5, 'Auxiliar de Instalação de Energia Solar Fotovoltaica', 6);


CREATE TABLE `candidato` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) DEFAULT NULL,
  `CPF` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numero_telefone` varchar(20) DEFAULT NULL,
  `paths` varchar(100) NOT NULL,
  `situacao` varchar(20) NOT NULL DEFAULT 'não definida',
  `data_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `administrador_vaga` (
  `ID_administrador` int(11) DEFAULT NULL,
  `ID_vaga` int(11) DEFAULT NULL,
    FOREIGN KEY ('ID_administrador') REFERENCES administrador('ID'),
  FOREIGN KEY ('ID_vaga') REFERENCES vaga('ID')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 


CREATE TABLE `candidato_vaga` (
  `ID_candidato` int(11) NOT NULL,
  `ID_vaga` int(11) NOT NULL,
  FOREIGN KEY ('ID_candidato') REFERENCES candidato('ID'),
  FOREIGN KEY ('ID_vaga') REFERENCES vaga('ID')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 

