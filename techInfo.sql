CREATE DATABASE techInfo;

use techInfo;

drop table produto;
CREATE table produto(
    id_produto INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (100) DEFAULT NULL,
    marca VARCHAR(100) DEFAULT NULL,
    tipo VARCHAR (100) DEFAULT NULL,
    preço FLOAT DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO produto (nome, marca, tipo, preço) VALUES ('RTX 5090 TI', 'Asus', 'Placa de Vídeo', 26888);

SELECT * FROM produto;