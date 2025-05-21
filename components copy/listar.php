<?php    
    // Verifica se a ação é excluir
    if (isset($_GET["acao"]) && $_GET["acao"] == "excluir") {
        $id = $_GET["id"];
        delete_pessoa($id);
    }
    // Verifica se um dados da pessoa foi enviado via POST para consultar
    $search = isset($_POST["nome"]) ? $_POST["nome"]:'';

    require_once(__DIR__ . "/funcao.php");

    $lista_pessoas = lista_pessoas($search);   
?>
<h4>Pessoas Cadastradas</h4>
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
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Data Nasc.</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th style="padding-inline: 20px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($lista_pessoas) {
                        foreach($lista_pessoas as $pessoa) {
                            $id = $pessoa["id"];
                            $cpf  = formatar_cpf($pessoa["cpf"]); 
                            $nome  = $pessoa["nome"]; 
                            $sobrenome  = $pessoa["sobrenome"]; 
                            $data_nasc  = $pessoa["data_nasc"]; 
                            $telefone  = $pessoa["telefone"]; 
                            $email  = $pessoa["email"]; 
                            $cep  = $pessoa["cep"]; 
                            $estado  = $pessoa["estado"]; 
                            $cidade  = $pessoa["cidade"]; 
                            $rua  = $pessoa["rua"]; 
                            $numero  = $pessoa["numero"]; 
                            echo "
                            <tr>
                                <td>{$cpf}</td>
                                <td>{$nome}</td>
                                <td>{$sobrenome}</td>
                                <td>{$data_nasc}</td>
                                <td>{$telefone}</td>
                                <td>{$email}</td>
                                <td>{$cep}</td>
                                <td>{$estado}</td>
                                <td>{$cidade}</td>
                                <td>{$rua}</td>
                                <td>{$numero}</td>
                                <td >
                                    <a class='btn btn-sm btn-warning' title='Alterar' href='?list&acao=alterar&id={$id}'>
                                        <i class='bi bi-pencil-square'></i>
                                    </a>
                                    <button class='btn btn-sm btn-danger' title='Excluir' onclick='delete_pessoa({$id})'>
                                        <i class='bi bi-trash-fill'></i>
                                    </button>
                                </td>
                            </tr>
                            ";
                        }
                    }
                    else {
                        echo "
                            <tr>
                                <td colspan='12' class='text-center'>Nenhum registro encontrado</td>
                            </tr>
                        ";
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