-- Excluindo o banco de dados caso ele já exista (comentar essa linha de código quando necessário)
DROP DATABASE IF EXISTS todo_list;

-- Criando o banco de dados 'todo_list' (o banco de dados deverá garantir suporte total a caracteres especiais e emojis.)
CREATE DATABASE todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Selecionando o banco de dados para uso
USE todo_list;

-- Criando tabela de usuários
CREATE TABLE usuario (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);