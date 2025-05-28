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
    </form>
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
                        $id = $produto["id_produto"];
                        $nome = $produto["nome"];
                        $marca = $produto["marca"];
                        $tipo = $produto["tipo"];
                        $valor = $produto["valor"];
                        echo "
                        <tr>
                            <td>{$nome}</td>
                            <td>{$marca}</td>
                            <td>{$tipo}</td>
                            <td>{$valor}</td>
                            <td style='text-align: center;'>
                            <a class='btn btn-sm btn-warning' title='Alterar' href='?list&acao=alterar&id={$id}'>
                            <i class='bi bi-pencil-square'></i>
                             </a>
                             <button class='btn btn-sm btn-danger' title='Excluir' onclick='delete_pessoa({$id})'>
                            <i class='bi bi-trash-fill'></i>
                             </button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhum produto encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        const delete_pessoa = (id)=>{
            if(confirm("Deseja realmente excluir?")) {
                window.location.href="?list&acao=excluir&id=" + id;
            }
        }
    </script>