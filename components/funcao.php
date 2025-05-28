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
 * @return string
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

/**
 * Summary of cadastrar_produtos
 * @param array $dados Formato de array [':nome' => Varchar, ':marca' => Varchar, ':tipo' => Varchar, ':valor' => Float]
 */
// Função para cadastrar produtos
function cadastro_produtos($dados): void {
    $cadastro = conectar();
    $sql = "INSERT INTO produto (nome, marca, tipo, valor) 
                VALUES (:nome, :marca, :tipo, :valor)";
        
    $preparar = $cadastro->prepare($sql);
    try{
        $preparar->execute($dados);
        if($preparar ->rowCount() > 0){
            alerta('ok', 'Produto Cadastrado com sucesso!', 'Cadastrado com sucesso com sucesso!');
        }
        else {
            alerta('erro', 'Erro ao cadastrar!', 'Não foi possível cadastrar a pessoa.');
        }
    }
        catch (PDOException $e) {
        alerta('erro', 'Erro ao cadastrar produto',  $e->getMessage());
    }
}

function alterar_produtos($dados): bool {
    $cadastro = conectar();
    $sql = "UPDATE produtos SET nome = :nome, marca = :marca, categoria = :categoria, valor = :valor WHERE id = :id";
    
    $preparar = $cadastro->prepare($sql);
    try{
        $preparar->execute($dados);
        if ($preparar->rowCount() > 0) {
            alerta('ok', 'Cadastro alterado com sucesso!', 'Pessoa alterada com sucesso.');
            return true;
        }
        else {
            alerta('erro', 'Erro ao alterar!', 'Não foi possível alterar a pessoa.');
            return false;
        }
    } catch (PDOException $e) {
        alerta('erro', 'Erro ao cadastrar o produto',  $e->getMessage());
    }
}

function listar_produtos($search = ""): array {
    $cadastro = conectar();
        $sql = "SELECT * FROM produto WHERE nome LIKE :search";
        $prepare = $cadastro->prepare($sql);
        $search = "%{$search}%";
        $prepare->execute([":search" => $search]);
        return $prepare->fetchAll(PDO::FETCH_ASSOC);
}

function lista_produtos_id($id): array {
    $lista = conectar();
    $sql = "SELECT * FROM produto WHERE id = :id_produto";
    $preparo = $lista->prepare($sql);
    $preparo->execute([":id" => $id]);
    return $preparo->fetch(PDO::FETCH_ASSOC);
}

function delete_produto($id): void {
    $cadastro = conectar();
    $sql = "DELETE FROM produto WHERE id_produto = :id_produto";
    $preparar = $cadastro->prepare($sql);
    try {
       $preparar -> execute([":id_produto" => $id]);
       if($preparar -> rowCount() >0){
        alerta('ok', 'Cadastro excluído com sucesso!', 'Pessoa excluída com sucesso.');
       }
       else{
        alerta('erro', 'Erro ao excluir!', 'Não foi possível excluir a pessoa.');
       }
    } catch (PDOException $e) {
        alerta('erro', 'Erro ao excluir produto',$e->getMessage());
    }
}
?>

