CREATE DATABASE `sunsage_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
CREATE DATABASE `sunsage_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

CREATE DATABASE sunsage_db

USE sunsage_db


CREATE TABLE `administrador` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `vaga` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `administrador_vaga` (
  `ID_administrador` int DEFAULT NULL,
  `ID_vaga` int DEFAULT NULL,
  KEY `ID_vaga` (`ID_vaga`),
  KEY `ID_administrador` (`ID_administrador`),
  CONSTRAINT `administrador_vaga_ibfk_1` FOREIGN KEY (`ID_vaga`) REFERENCES `vaga` (`ID`),
  CONSTRAINT `administrador_vaga_ibfk_2` FOREIGN KEY (`ID_administrador`) REFERENCES `administrador` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `curriculo` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `curriculo` blob,
  `data_envio` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `candidato` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `CPF` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numero_telefone` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `candidato_vaga` (
  `ID_candidato` int DEFAULT NULL,
  `ID_vaga` int DEFAULT NULL,
  KEY `ID_candidato` (`ID_candidato`),
  KEY `ID_vaga` (`ID_vaga`),
  CONSTRAINT `candidato_vaga_ibfk_1` FOREIGN KEY (`ID_candidato`) REFERENCES `candidato` (`ID`),
  CONSTRAINT `candidato_vaga_ibfk_2` FOREIGN KEY (`ID_vaga`) REFERENCES `vaga` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `candidato_curriculo` (
  `ID_candidato` int DEFAULT NULL,
  `ID_curriculo` int DEFAULT NULL,
  KEY `ID_candidato` (`ID_candidato`),
  KEY `ID_curriculo` (`ID_curriculo`),
  CONSTRAINT `candidato_curriculo_ibfk_1` FOREIGN KEY (`ID_candidato`) REFERENCES `candidato` (`ID`),
  CONSTRAINT `candidato_curriculo_ibfk_2` FOREIGN KEY (`ID_curriculo`) REFERENCES `curriculo` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



