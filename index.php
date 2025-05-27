<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>TechInfo</title>
</head>
<body>
      <div class="container mt-5">

        <?php
            if(isset($_GET['acao']) && $_GET['acao'] == 'alterar') {
                require_once(__DIR__ . "/components/alterar.php");

            }
        ?>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="/" class="text-decoration-none">
                    <button class="nav-link <?php echo isset($_GET["list"])?'':'active'?>" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Cadastrar</button>
                </a>
                <a href="?list" class="text-decoration-none">
                    <button class="nav-link <?php echo isset($_GET["list"])?'active':''?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Listar</button>
                </a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?php echo isset($_GET["list"])?'':'show active'?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <?php
                    require_once(__DIR__."/components/cadastrar.php");
                ?>
            </div>
            <div class="tab-pane fade <?php echo isset($_GET["list"])?'show active':''?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <?php
                    require_once(__DIR__ ."/components/listar.php");
                ?>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>