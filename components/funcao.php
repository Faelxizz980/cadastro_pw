<?php
define('DB_HOST',     'localhost'); // Endereço do servidor MySQL
define('DB_USER',     'root');      // Usuário padrão do MySQL
define('DB_PASS',     '');          // Senha padrão do MySQL
define('DB_NAME',     'techinfo');       // Nome do banco de dados
define('DB_CHARSET',  'utf8mb4');   // Charset do banco de dados

function conectar(): PDO {
    $pdo = new PDO(
          "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
          DB_USER,  
          DB_PASS
        );
    return $pdo;
}


?>
