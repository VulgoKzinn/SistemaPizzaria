CREATE DATABASE db_pizzaria;
USE db_pizzaria;



CREATE TABLE tb_pizza (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sabor VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    ingredientes TEXT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    preco DECIMAL(6,2) NOT NULL,
    imagem VARCHAR(255),
    ativo BOOLEAN DEFAULT TRUE
);

CREATE TABLE tb_tipo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

CREATE TABLE tb_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    ativo BOOLEAN DEFAULT TRUE
);

INSERT INTO tb_usuario (usuario, senha) 
VALUES ('admin', 'admin');