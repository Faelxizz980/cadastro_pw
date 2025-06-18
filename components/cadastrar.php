<?php
     require_once(__DIR__ . "/funcao.php");

     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $info_Peça = [
            ':nome' => $_POST['nome'],
            ':marca' => $_POST['marca'], 
            ':tipo' => $_POST['tipo'],
            ':valor' => $_POST['valor'],
        ]; 
        cadastro_produtos($info_Peça);
     }
?>
<h1>Cadastro de Produtos</h1>
<form  method="post">
        <div>

            <div>
                <label for="nome" class="form-label" >Nome do Produto</label>
                <input type="text" class="input-text" name="nome" id="nome" placeholder="Digite o nome do produto">
            </div>
          
            <div>
                 <label for="marca" class="form-label" >Qual a marca do Produto</label>
                 <input type="text" class="input-text" name="marca" id="marca" placeholder="Marca do produto">
            </div>
           
            <div>
                 <label for="tipo" class="form-label" >Categoria do produto</label>
                 <input type="text" class="input-text" name="tipo" id="tipo" placeholder="Ex:Processador">
            </div>

            <div>
                <label for="valor" class="form-label" >Qual o valor do produto</label>
                <input type="text" class="input-text" name="valor" id="valor" placeholder="valor">
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>

        </div>
</form>
