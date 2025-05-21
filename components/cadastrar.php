<?php
     require_once(__DIR__ . "/funcao.php");

     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $info_Peça = [
            ':nome' => $_POST['nome'],
            ':marca' => $_POST['marca'],
            ':categoria' => $_POST['categoria'],
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
                 <label for="categoria" class="form-label" >Categoria do produto</label>
                 <input type="text" class="input-text" name="categoria" id="categoria" placeholder="Ex:Processador">
            </div>

            <div>
                <label for="preço" class="form-label" >Qual o valor do produto</label>
                <input type="text" class="input-text" name="preço" id="valor" placeholder="valor">
            </div>

            <button type="submit" class="btn btn-primary">Cadatrar</button>

        </div>
</form>
