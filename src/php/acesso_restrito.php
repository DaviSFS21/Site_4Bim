<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen">
    <title>Pai & Filhos - Acesso de administrador</title>
</head>
<body class="fundo">
    <header>
        <nav>
            <ul class="nav__links">
                <li><a href="../form_cad_prod.html">Cadastrar</a></li>
                <li><a href="form_alt_prod.php">Alterar</a></li>
                <li><a href="lista_prod.php">Visualizar</a></li>
                <li><a href="form_exc_prod.php">Excluir</a></li>
                <li><a class="cta" href="../index.html">Início</a></li>
                <li><a class="cta" href="exit.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <?php
        //Iniciando ou mantendo a session
        session_start();
        
        if(isset($_SESSION["nome"])){
            if($_SESSION["verif_admin"] = 0){
                ?>
                    <script>
                        window.location.replace("index.html");
                    </script>
                <?php
            }
            //mostrando o valor da session
            echo "Você está logado ".$_SESSION["nome"];    
        }else{
            ?>
                <script>
                    window.location.replace("login.php");
                </script>
            <?php
        }
    ?>
</body>
</html>