CREATE DATABASE escola;
USE escola;

CREATE TABLE alunos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    idade INT(3) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;