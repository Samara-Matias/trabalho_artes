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
) ENGINE=InnoDB;

-- Criando tabela das lista de tarefas
CREATE TABLE lista (
    lista_id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(200),
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario(userId) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Criando tabela das tarefas de cada lista de tarefas

CREATE TABLE tarefa (
    tarefa_id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(200),
    lista_id INT NOT NULL,
    prioridade ENUM ('Alta', 'Média', 'Baixa', 'Nenhuma') NOT NULL,
    status_tarefa ENUM ('Pendente', 'Em endamento', 'Concluída') NOT NULL,
    FOREIGN KEY (lista_id) REFERENCES lista (lista_id) ON DELETE CASCADE
) ENGINE=InnoDB;