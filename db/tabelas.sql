CREATE DATABASE IF NOT EXISTS projetophp_joaolucas
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use projetophp_joaolucas;

CREATE TABLE IF NOT EXISTS produtos(
    idprod INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL,
    cor VARCHAR(200) NOT NULL,
    preco DECIMAL(8,2) NOT NULL
);
