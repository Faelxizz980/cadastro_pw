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

/**
 * Exibe um alerta Bootstrap.
 * @param string $tipo
 * @param string $titulo
 * @param string $mensagem
 * @param $string 
 * @return void
 */
function alerta($tipo, $titulo, $mensagem): void {
    $titulo_alert = "<i class='bi bi-check-circle'></i> {$titulo}";
    $class = 'alert alert-success';
    if ($tipo != 'ok') {
        $titulo_alert = "<i class='bi bi-exclamation-triangle'></i> {$titulo}";
        $class = 'alert alert-danger';        
    }
    echo "
        <div class='{$class} alert-dismissible fade show' role='alert'>
            <strong>{$titulo_alert}</strong>
            {$mensagem}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
}

// Função para cadastrar produtos
function cadastro_produtos($dados): void {
    $cx = conectar();
    $sql = "INSERT INTO produtos (nome, marca, categoria, valor) 
                VALUES (:nome, :marca, :categoria, :valor)";
        
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        alerta('ok', 'Cadastro realizado com sucesso!', 'Produto cadastrado com sucesso!');
    } catch (PDOException $e) {
        alerta('erro', 'Erro ao cadastrar produto', 'Erro: ' . $e->getMessage());
    }
}

function alterar_produtos($dados): void {
    $cx = conectar();
    $sql = "UPDATE produtos SET nome = :nome, marca = :marca, categoria = :categoria, valor = :valor WHERE id = :id";
    
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        alerta('ok', 'Alteração realizada com sucesso!', 'Produto alterado com sucesso!');
    } catch (PDOException $e) {
        alerta('erro', 'Erro ao alterar produto', 'Erro: ' . $e->getMessage());
    }
}

function listar_produtos($search = ""): array {
    $cx = conectar();
    if ($search !== "") {
        $sql = "SELECT * FROM produtos WHERE nome LIKE :search";
        $stmt = $cx->prepare($sql);
        $like = "%{$search}%";
        $stmt->bindParam(':search', $like, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $sql = "SELECT * FROM produtos";
        $stmt = $cx->query($sql);
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lista_produtos_id($id): ?array {
    $cx = conectar();
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $cx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function delete_produto($id): void {
    $cx = conectar();
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $cx->prepare($sql);
    try {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        alerta('ok', 'Produto excluído!', 'Produto removido com sucesso!');
    } catch (PDOException $e) {
        alerta('erro', 'Erro ao excluir produto', 'Erro: ' . $e->getMessage());
    }
}
?>

