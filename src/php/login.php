<?php
    session_start();

    if(!isset($_SESSION['email']))
    if(isset($_POST['c_email'])){
        $email = $_POST['c_email'];
        $senha = $_POST['c_senha'];
        $cripto = sha1($senha);

        //Conectando com o banco para fazer a consulta do usuario
        require('connect.php');
        
        //SQL de pesquisa de usuario e senha
        $sql_pesquisa = "select * from `usuario` where `email` = '$email' AND `senha` = '$cripto'";
        $resultado_usuario = mysqli_query($conexao,$sql_pesquisa);
        
        //tranformando em numero o resultado da pesquisa
        $numero_resultado = mysqli_num_rows($resultado_usuario);

        if($numero_resultado == 1){
            $vetor_user = mysqli_fetch_array($resultado_usuario);            
            if($email = $vetor_user[2]){

                $_SESSION['nome'] = $vetor_user[3];
                $_SESSION['email'] = $vetor_user[2];
                $_SESSION['verif_admin'] = $vetor_user[1];

                ?>
                    <script>
                        alert("Login com sucesso!");
                        window.location.replace("acesso_restrito.php");
                    </script>
                <?php
            }
        }else{
        ?>
            <script>
                alert("Falhou fi");
                window.location.replace("login.php");
            </script>
        <?php
        }
        mysqli_close($conexao);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera-gx">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../css/style_login.css" media="screen">
    <title>Login - Pai & Filhos</title>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="login.php" role="tab"
                    aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="cad_user.php" role="tab"
                    aria-controls="pills-register" aria-selected="false">Cadastrar</a>
                </li>
            </ul>
            <div class="tab-content">
                <p class="text-center">Insira o usuário do administrador:</p>

                <div class="form-outline mb-4">
                    <label class="form-label" for="loginName">Email do Admin</label>
                    <input type="email" id="loginName" class="form-control" name="c_email"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Senha</label>
                    <input type="password" id="loginPassword" class="form-control" name="c_senha"/>
                </div>
                <div class="row mb-4 justify-content-center">
                    <a href="#!">Esqueceu a senha?</a>
                </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Continuar</button>
            </div>
        </div>
    </form>
</body>
</html>