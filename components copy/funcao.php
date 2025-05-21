<?php
define('DB_HOST',     'localhost'); // Endereço do servidor MySQL
define('DB_USER',     'root');      // Usuário padrão do MySQL
define('DB_PASS',     '');          // Senha padrão do MySQL
define('DB_NAME',     'pw2');       // Nome do banco de dados
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
 * Summary of alerta
 * @param string $tipo Aceita 'ok' para sucesso e 'erro' para erro
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
 * Summary of formata_cpf
 * @param string $cpf
 * @return string
 */

function formatar_cpf($cpf): string {
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

/**
 * Summary of cadastrar_pessoa
 * @param array $dados Formato de array [ ':cpf' =>bigint, ':nome' =>string, ':sobrenome' =>string, ':data_nasc' =>string, ':telefone' =>string, ':email' =>string, ':cep' =>int, ':estado' =>string, ':cidade' =>string, ':rua' =>string, ':numero' =>string ]
 */
function cadastrar_pessoa($dados): void {
    $cx = conectar();
    $sql = "INSERT INTO pessoa (cpf, nome, sobrenome, data_nasc, telefone, email, cep, estado, cidade, rua, numero) 
                VALUES (:cpf, :nome, :sobrenome, :data_nasc, :telefone, :email, :cep, :estado, :cidade, :rua, :numero)";
        
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        if ($stmt->rowCount() > 0) {
            alerta('ok', 'Cadastro realizado com sucesso!', 'Pessoa cadastrada com sucesso.');
        }
        else {
            alerta('erro', 'Erro ao cadastrar!', 'Não foi possível cadastrar a pessoa.');
        }
    }
    catch(PDOException $e) {
        alerta('erro', 'Erro ao cadastrar!', $e->getMessage());
    }
}

function alterar_pessoa($dados): bool {
    $cx = conectar();
    $sql = "UPDATE pessoa SET cpf = :cpf, nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, telefone = :telefone, email = :email, cep = :cep, estado = :estado, cidade = :cidade, rua = :rua, numero = :numero WHERE id = :id";
    
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute($dados);
        if ($stmt->rowCount() > 0) {
            alerta('ok', 'Cadastro alterado com sucesso!', 'Pessoa alterada com sucesso.');
            return true;
        }
        else {
            alerta('erro', 'Erro ao alterar!', 'Não foi possível alterar a pessoa.');
            return false;
        }
    }
    catch(PDOException $e) {
        alerta('erro', 'Erro ao alterar!', $e->getMessage());
        return false;
    }
}

function lista_pessoas($search=""): array {
    $cx = conectar();
    $sql = "SELECT * FROM pessoa WHERE pessoa.cpf LIKE :search OR pessoa.nome LIKE :search OR pessoa.sobrenome LIKE :search";
    $search = "%{$search}%";   
    $stmt = $cx->prepare($sql);
    $stmt->execute([":search" => $search]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lista_pessoas_id($id): array {
    $cx = conectar();
    $sql = "SELECT * FROM pessoa WHERE id = :id";
    $stmt = $cx->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete_pessoa($id): void {
    $cx = conectar();
    $sql = "DELETE FROM pessoa WHERE id = :id";
    $stmt = $cx->prepare($sql);
    try{
        $stmt->execute([":id" => $id]);
        if ($stmt->rowCount() > 0) {
            alerta('ok', 'Cadastro excluído com sucesso!', 'Pessoa excluída com sucesso.');
        }
        else {
            alerta('erro', 'Erro ao excluir!', 'Não foi possível excluir a pessoa.');
        }
    }
    catch(PDOException $e) {
        alerta('erro', 'Erro ao excluir!', $e->getMessage());
    }
}