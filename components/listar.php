<?php
if (isset($_GET["acao"]) && $_GET["acao"] == "excluir") {
    $id = $_GET["id"];
    delete_produto($id); // Corrigido aqui
}
$search = isset($_POST["nome"]) ? $_POST["nome"]:'';

require_once(__DIR__ . "/funcao.php");

$lista_produtos = listar_produtos($search);
?>

<h4>listar cadastro</h4>
<form method="POST" class="mb-3">
    <div class="input-group">
        <input type="text" name="nome" class="form-control" placeholder="Filtrar por nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filtrar</button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th style="padding-inline: 20px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($lista_produtos) {
                    foreach($lista_produtos as $produto) {
                        $id = $produto["id"];
                        $nome = $produto["nome"];
                        $marca = $produto["marca"];
                        $categoria = $produto["categoria"];
                        $valor = $produto["valor"];
                        echo "
                        <tr>
                            <td>{$nome}</td>
                            <td>{$marca}</td>
                            <td>{$categoria}</td>
                            <td>{$valor}</td>
                            <td style='text-align: center;'>
                                <a href='?acao=alterar&id={$id}' class='btn btn-warning btn-sm'><i class='bi bi-pencil'></i> Alterar</a>
                                <a href='?acao=excluir&id={$id}' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i> Excluir</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhum produto encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
</form>