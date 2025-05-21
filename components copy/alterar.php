<?php

    require_once(__DIR__ . "/funcao.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados_pessoa = [
            ':id' => $_POST['id'],
            ':cpf' => preg_replace('/\D/', '', $_POST['cpf']),
            ':nome' => $_POST['nome'],
            ':sobrenome' => $_POST['sobrenome'],
            ':data_nasc' => $_POST['data_nasc'],
            ':telefone' => $_POST['telefone'],
            ':email' => $_POST['email'],
            ':cep' => preg_replace('/\D/', '', $_POST['cep']),
            ':estado' => $_POST['estado'],
            ':cidade' => $_POST['cidade'],
            ':rua' => $_POST['rua'],
            ':numero' => $_POST['numero']
        ];
        if(alterar_pessoa($dados_pessoa)) {
            header("Location: /?list");
            exit;
        }       
        
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        header("Location: /?list");
        exit;
    }
    $pessoa = lista_pessoas_id($id);
    if (!$pessoa) {
        header("Location: /?list");
        exit;
    }

?>
<h2 class="mb-4">Alterar cadastro</h2>
    <form method="post">
        <div class="row mb-3">
            <input type="hidden" name="id" value="<?php echo $pessoa['id']; ?>">
            <div class="col-md-4">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo formatar_cpf($pessoa['cpf']); ?>">
            </div>
            <div class="col-md-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $pessoa['nome']; ?>">
            </div>
            <div class="col-md-4">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $pessoa['sobrenome']; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="data_nasc" class="form-label">Data de data_nasc</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="<?php echo $pessoa['data_nasc']; ?>">
            </div>
            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $pessoa['telefone']; ?>">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $pessoa['email']; ?>">
            </div>
        </div>

        <h5 class="mt-4">Endereço</h5>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $pessoa['cep']; ?>">
            </div>
            <div class="col-md-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $pessoa['estado']; ?>">
            </div>
            <div class="col-md-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $pessoa['cidade']; ?>">
            </div>
            <div class="col-md-3">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $pessoa['rua']; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $pessoa['numero']; ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Alterar</button>
    </form>