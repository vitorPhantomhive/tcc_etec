-- Tempo de geração: 13-Jun-2022 às 22:17 primeira vez reproduzido ainda quando eu estava no curso que engraçado
-- executa nessa ordem que da certo!
--
-- Banco de dados: `studyhome`
--
CREATE DATABASE IF NOT EXISTS `studyhome` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `studyhome`;

CREATE TABLE `escola` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cnpj` VARCHAR(14) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`cnpj`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `professor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `ativo` BOOLEAN NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `materia_professor` (
  `id_materia` INT(11) DEFAULT NULL,
  `id_professor` INT(11) DEFAULT NULL,
  KEY `id_materia` (`id_materia`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `materia_professor_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`),
  CONSTRAINT `materia_professor_ibfk_2` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `turma` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `turma_professor`
CREATE TABLE `turma_professor` (
  `id_turma` INT(11) DEFAULT NULL,
  `id_professor` INT(11) DEFAULT NULL,
  KEY `id_turma` (`id_turma`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `turma_professor_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  CONSTRAINT `turma_professor_ibfk_2` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `turma_tarefa`
CREATE TABLE `turma_tarefa` (
  `id_turma` INT(11) DEFAULT NULL,
  `id_tarefa` INT(11) DEFAULT NULL,
  KEY `id_turma` (`id_turma`),
  KEY `id_tarefa` (`id_tarefa`),
  CONSTRAINT `turma_tarefa_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  CONSTRAINT `turma_tarefa_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `turma_professor`
CREATE TABLE `turma_professor` (
  `id_turma` INT(11) DEFAULT NULL,
  `id_professor` INT(11) DEFAULT NULL,
  KEY `id_turma` (`id_turma`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `turma_professor_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  CONSTRAINT `turma_professor_ibfk_2` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `turma_tarefa`
CREATE TABLE `turma_tarefa` (
  `id_turma` INT(11) DEFAULT NULL,
  `id_tarefa` INT(11) DEFAULT NULL,
  KEY `id_turma` (`id_turma`),
  KEY `id_tarefa` (`id_tarefa`),
  CONSTRAINT `turma_tarefa_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  CONSTRAINT `turma_tarefa_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `aluno` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_turma` INT(11) DEFAULT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `ativo` BOOLEAN NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tarefa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` VARCHAR(600) NOT NULL,
  `dataPost` DATE NOT NULL,
  `dataF` DATE NOT NULL,
  `materia` VARCHAR(100) NOT NULL,
  `id_professor` INT(11) NOT NULL,
  `nome_arquivo` VARCHAR(100) DEFAULT NULL,
  `ativo` BOOLEAN NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_professor` (`id_professor`),
  CONSTRAINT `tarefa_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `anotacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  `dataNota` DATE NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  `tipo_usuario` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `entregue`
CREATE TABLE `entregue` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` INT(11) NOT NULL,
  `id_tarefa` INT(11) NOT NULL,
  `data_entrega` DATE NOT NULL,
  `comentarios_aluno` VARCHAR(200) DEFAULT NULL,
  `comentarios_professor` VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_tarefa` (`id_tarefa`),
  CONSTRAINT `entregue_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `entregue_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela `arquivo_entregue`
CREATE TABLE `arquivo_entregue` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `id_aluno` INT(11) NOT NULL,
  `id_tarefa` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `arquivo_entregue_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `arquivo_entregue_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `turma` (`id`, `nome`) VALUES
(1, '1º Ano A'),
(2, '1º Ano B'),
(3, '1º Ano C'),
(4, '2º Ano A'),
(5, '2º Ano B'),
(6, '2º Ano C'),
(7, '3º Ano A'),
(8, '3º Ano B'),
(9, '3º Ano C');