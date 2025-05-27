<?php
require_once(__DIR__ . "/funcao.php");

     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $info_Peça = [
            ':nome' => $_POST['nome'],
            ':marca' => $_POST['marca'],
            ':categoria' => $_POST['categoria'],
            ':valor' => $_POST['valor'],
        ];

        if(cadastro_produtos($info_Peça)) {
            header("Location: /?list");
            exit;
        }
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        header("Location: /?list");
        exit;
    }
    $produto = lista_produtos_id($id);
    if (!$produto) {
        header("Location: /?list");
        exit;
    }
?>

<h2>Alterar produto</h2>
<form method="post">
    <div class="row mb-3">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
        <div class="col-md-4">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto['nome']; ?>">
        </div>
        <div class="col-md-4">
            <label for="marca" class="form-label">Marca do Produto</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $produto['marca']; ?>">
        </div>
        <div class="col-md-4">
            <label for="categoria" class="form-label">Categoria do Produto</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $produto['categoria']; ?>">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="valor" class="form-label">Valor do Produto</label>
            <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto['valor']; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Alterar</button>
</form>