<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechInfo</title>
</head>
<body>
      <?php
       if(isset($_GET['acao']) && $_GET['acao'] == 'alterar') {
        require_once(__DIR__ . "/components/alterar.php");
    }
        ?>

    <?php
        require_once(__DIR__."/components/cadastrar.php")
    ?>
    <?php
        require_once(__DIR__."/components/listar.php")
    ?>

</body>
</html>