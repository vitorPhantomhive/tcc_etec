-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jun-2022 às 22:17
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `studyhome`
--
CREATE DATABASE IF NOT EXISTS `studyhome` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `studyhome`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `ativo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `id_turma`, `nome`, `email`, `senha`, `telefone`, `cpf`, `ativo`) VALUES
(1, 7, 'Batman', 'batman@gmail.com', '53145602837', '44444444444', '53145602837', 'a'),
(2, 5, 'Aluno Teste', 'teste@gmail.com', '34324342342', '99999999999', '34324342342', 'd'),
(3, 5, 'robin', 'robin@gmail.com', '12345678912', '98999999999', '12345678912', 'a'),
(4, 7, 'pedrinho', 'pedrinho@gmail.com', '22222222222', '99999999999', '22222222222', 'a'),
(9, 7, 'Aline', 'aline@gmail.com', '12121212121', '00000000000', '12121212121', 'd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anotacao`
--

CREATE TABLE `anotacao` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `dataNota` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo_entregue`
--

CREATE TABLE `arquivo_entregue` (
  `cod` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_tarefa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `arquivo_entregue`
--

INSERT INTO `arquivo_entregue` (`cod`, `nome`, `id_aluno`, `id_tarefa`) VALUES
(7, 'brendonbosquetigmail.com.pdf', 1, 3),
(8, 'cert.pdf', 1, 3),
(9, 'gramatica_batman.docx', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregue`
--

CREATE TABLE `entregue` (
  `cod` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_tarefa` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `comentarios_aluno` varchar(200) DEFAULT NULL,
  `comentarios_professor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entregue`
--

INSERT INTO `entregue` (`cod`, `id_aluno`, `id_tarefa`, `data_entrega`, `comentarios_aluno`, `comentarios_professor`) VALUES
(4, 1, 3, '2022-06-03', 'Uni du ni te sala me mingue bata asla dwka dwoa dwiad wad wdj awdja wd', 'porque é isso é fiocu asism bla bla sla oaqw bata ae boa MB'),
(5, 1, 5, '2022-06-13', 'Dificl ein prof slk', 'NOTA ZERO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id`, `nome`, `cnpj`, `email`, `senha`) VALUES
(1, 'Escola', '99999999999999', 'escola@gmail.com', '5555');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materia`
--

INSERT INTO `materia` (`id`, `nome`) VALUES
(1, 'Matemática'),
(2, 'História'),
(3, 'Língua Portuguesa'),
(4, 'Língua Inglesa'),
(5, 'Geografia'),
(6, 'Biologia'),
(7, 'Física'),
(8, 'Química'),
(9, 'Artes'),
(10, 'Educação Física'),
(11, 'Filosofia'),
(12, 'Sociologia'),
(13, 'Projeto de Vida'),
(14, 'Eletiva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_professor`
--

CREATE TABLE `materia_professor` (
  `id_materia` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materia_professor`
--

INSERT INTO `materia_professor` (`id_materia`, `id_professor`) VALUES
(1, 1),
(3, 1),
(6, 1),
(7, 2),
(9, 2),
(12, 2),
(6, 5),
(7, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `ativo` char(1) NOT NULL,
  `cpf` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `email`, `senha`, `telefone`, `ativo`, `cpf`) VALUES
(1, 'prof', 'prof@gmail.com', '99999999999', '66666666666', 'a', '99999999999'),
(2, 'prof2', 'prof2@gmail.com', '12345678901', '99999999999', 'a', '12345678901'),
(5, 'humberto vinicius', 'humbertosdadw@gmail.com', '11111111111', '78467435747', 'd', '34929842879'),
(6, 'Humberto Vinicius', 'humberto@gmail.com', '45454545454', '10101010101', 'd', '45454545454');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa`
--

CREATE TABLE `tarefa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(600) NOT NULL,
  `dataPost` date NOT NULL,
  `dataF` date NOT NULL,
  `materia` varchar(100) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `nome_arquivo` char(100) DEFAULT NULL,
  `ativo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tarefa`
--

INSERT INTO `tarefa` (`id`, `nome`, `descricao`, `dataPost`, `dataF`, `materia`, `id_professor`, `nome_arquivo`, `ativo`) VALUES
(1, 'Redação', 'Faz uma redação ae man', '2022-05-26', '2022-06-20', '3', 1, NULL, 'a'),
(2, 'Bhaskara', 'MUDEI DENOVO AGORA VAII', '2022-05-26', '2022-06-17', '1', 1, '', 'a'),
(3, 'Ética', 'Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non', '2022-05-27', '2022-05-31', '3', 1, 'etica_brendon.docx', 'a'),
(4, 'Sla', 'sla tbm', '2022-05-30', '2022-05-30', '3', 1, 'Filosofia.docx', 'd'),
(5, 'Gramatica', 'Uma atividade de gramatica, se vira ai menó FAZ LOGO', '2022-06-13', '2022-06-15', '1', 1, 'gramaticadnvv.docx', 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma`
--

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_professor`
--

CREATE TABLE `turma_professor` (
  `id_turma` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma_professor`
--

INSERT INTO `turma_professor` (`id_turma`, `id_professor`) VALUES
(1, 1),
(2, 1),
(7, 1),
(4, 2),
(5, 2),
(6, 2),
(3, 5),
(4, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_tarefa`
--

CREATE TABLE `turma_tarefa` (
  `id_turma` int(11) DEFAULT NULL,
  `id_tarefa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma_tarefa`
--

INSERT INTO `turma_tarefa` (`id_turma`, `id_tarefa`) VALUES
(7, 1),
(2, 2),
(7, 3),
(2, 4),
(7, 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices para tabela `anotacao`
--
ALTER TABLE `anotacao`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `arquivo_entregue`
--
ALTER TABLE `arquivo_entregue`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_tarefa` (`id_tarefa`);

--
-- Índices para tabela `entregue`
--
ALTER TABLE `entregue`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_tarefa` (`id_tarefa`);

--
-- Índices para tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `materia_professor`
--
ALTER TABLE `materia_professor`
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turma_professor`
--
ALTER TABLE `turma_professor`
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `turma_tarefa`
--
ALTER TABLE `turma_tarefa`
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_tarefa` (`id_tarefa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `anotacao`
--
ALTER TABLE `anotacao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `arquivo_entregue`
--
ALTER TABLE `arquivo_entregue`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `entregue`
--
ALTER TABLE `entregue`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tarefa`
--
ALTER TABLE `tarefa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `arquivo_entregue`
--
ALTER TABLE `arquivo_entregue`
  ADD CONSTRAINT `arquivo_entregue_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `arquivo_entregue_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`);

--
-- Limitadores para a tabela `entregue`
--
ALTER TABLE `entregue`
  ADD CONSTRAINT `entregue_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `entregue_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`);

--
-- Limitadores para a tabela `materia_professor`
--
ALTER TABLE `materia_professor`
  ADD CONSTRAINT `materia_professor_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `materia_professor_ibfk_2` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD CONSTRAINT `tarefa_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `turma_professor`
--
ALTER TABLE `turma_professor`
  ADD CONSTRAINT `turma_professor_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `turma_professor_ibfk_2` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `turma_tarefa`
--
ALTER TABLE `turma_tarefa`
  ADD CONSTRAINT `turma_tarefa_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `turma_tarefa_ibfk_2` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
