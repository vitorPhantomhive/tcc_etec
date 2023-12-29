create database studyHome;

use studyHome;

create table turma(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(200) not null
);

create table materia(
    id int PRIMARY KEY not null AUTO_INCREMENT,
    nome varchar(200) not null
);

create table aluno(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_turma int null,
    nome varchar(200) not null,
    email varchar(200) not null unique,
    senha varchar(50) not null,
    telefone varchar(11) not null,
    cpf varchar(11) not null unique,
    ativo char(1) not null,
    FOREIGN key (id_turma) REFERENCES Turma(id)
);

create table professor(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(200) not null,
    email varchar(200) not null unique,
    senha varchar(50) not null,
    telefone varchar(11) not null,
    ativo char(1) not null,
    cpf varchar(11) not null unique
);

create table escola(
    id int PRIMARY KEY not null AUTO_INCREMENT,
    nome varchar(100) not null,
    cnpj varchar(14) not null unique,
    email varchar(200) not null unique,
    senha varchar(50) not null
);

create table tarefa(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(100) not null,
    descricao varchar(600) not null,
    dataPost date not null,
    dataF date not null,
    materia varchar(100) not null,
    id_professor int not null,
    nome_arquivo varchar(100),
    ativo char(1) not null,
    FOREIGN key (id_professor) REFERENCES Professor(id)
);

/*select from turma_professor where id_turma = id and id_professor = id*/

create table turma_professor (
    id_turma int,
    id_professor int,
    FOREIGN key (id_turma) REFERENCES Turma(id),
    FOREIGN key (id_professor) REFERENCES Professor(id)
);

create table materia_professor (
    id_materia int,
    id_professor int,
    FOREIGN key (id_materia) REFERENCES materia(id),
    FOREIGN key (id_professor) REFERENCES Professor(id)
);

create table turma_tarefa(
    id_turma int,
    id_tarefa int,
    FOREIGN key (id_turma) REFERENCES Turma(id),
    FOREIGN key (id_tarefa) REFERENCES tarefa(id)
);

create table entregue(
    cod int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_aluno int not null,
    id_tarefa int not null,
    data_entrega date not null,
    comentarios_aluno varchar(200),
    comentarios_professor varchar(200),
    FOREIGN key(id_aluno) REFERENCES aluno(id),
    FOREIGN key(id_tarefa) REFERENCES tarefa(id)
);

create table arquivo_entregue(
    cod int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(200) not null,
    id_aluno int not null,
    id_tarefa int not null,
    FOREIGN key(id_aluno) REFERENCES aluno(id),
    FOREIGN key(id_tarefa) REFERENCES tarefa(id)
);

create table anotacao(
    cod int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(100) not null,
    descricao varchar(500) not null,
    dataNota date not null,
    id_usuario int not null,
    tipo_usuario varchar(20) not null
);

/*
CODIGOS SQL PARA EXECUTAR

insert into escola (nome, cnpj, email, senha) VALUES ("Escola", 99999999999999, "escola@gmail.com", 1234);

insert into tarefa(nome, descricao, dataPost, dataF, materia) values ("Curso", "Faz ae", 2022-05-18, 2022-05-20, "Alguma");

insert into turma(nome)
VALUES
("1º Ano A"),
("1º Ano B"),
("1º Ano C"),
("2º Ano A"),
("2º Ano B"),
("2º Ano C"),
("3º Ano A"),
("3º Ano B"),
("3º Ano C");

insert into materia(nome)
VALUES
("Matemática"),
("História"),
("Língua Portuguesa"),
("Língua Inglesa"),
("Geografia"),
("Biologia"),
("Física"),
("Química"),
("Artes"),
("Educação Física"),
("Filosofia"),
("Sociologia"),
("Projeto de Vida"),
("Eletiva");


insert into turma_tarefa(id_turma, id_tarefa) values (2, 1);
*/

/*create table Endereco(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    logradouro VARCHAR(255),
    numero VARCHAR(10),
    bairro VARCHAR(50),
    cidade int(11),
    UF INT,
    cep varchar(11),
    codDoAluno int,
    FOREIGN key(codDoAluno) REFERENCES aluno(id)
);*/