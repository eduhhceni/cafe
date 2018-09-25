CREATE DATABASE  IF NOT EXISTS cafe;
USE cafe;

/* Criando Tabela café */

DROP TABLE IF EXISTS cafe;
CREATE TABLE cafe (
  id int(11) NOT NULL AUTO_INCREMENT,
  tipo varchar(100) NOT NULL,
  permissao tinyint(1) NOT NULL,
  PRIMARY KEY (id)
);

LOCK TABLES cafe WRITE;
ALTER TABLE cafe DISABLE KEYS;
INSERT INTO cafe VALUES (1,'Pingado',1),(2,'Cappuccino',1),(3,'Mochaccino',1),(4,'Normal',0);
ALTER TABLE cafe ENABLE KEYS;
UNLOCK TABLES;


/* Criando Tabela Funcionário */

DROP TABLE IF EXISTS funcionario;
CREATE TABLE funcionario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  cargo varchar(255) NOT NULL,
  permissao tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nome_UNIQUE (nome)
);

LOCK TABLES funcionario WRITE;
ALTER TABLE funcionario DISABLE KEYS;
INSERT INTO funcionario VALUES (1,'Eduardo Henrique Ceni Marquardt','Desenvolvedor Web',0),(2,'Jefferson Henrique Ramos','Desenvolvedor Web',1),(3,'John Doe','Desenvolvedor Front-End',0);
ALTER TABLE funcionario ENABLE KEYS;
UNLOCK TABLES;


/* Criando Tabela Registro */

DROP TABLE IF EXISTS registro;
CREATE TABLE registro (
  id int(11) NOT NULL AUTO_INCREMENT,
  funcionario varchar(100) NOT NULL,
  cafe varchar(255) NOT NULL,
  data_pedido timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

LOCK TABLES registro WRITE;
ALTER TABLE registro DISABLE KEYS;
INSERT INTO registro VALUES (1,'Eduardo Henrique Ceni Marquardt','Normal','2018-09-25 15:55:43');
ALTER TABLE registro ENABLE KEYS;
UNLOCK TABLES;