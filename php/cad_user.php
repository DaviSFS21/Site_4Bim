<?php

    if(isset($_POST['n_email'])){
        $email = $_POST['n_email'];
        $cpf = $_POST['n_cpf'];
        $nome = $_POST['n_nome'];
        $senha = $_POST['n_senha'];
        $tel = $_POST['n_tel'];
        $cripto = sha1($senha);

        //Conectando com o banco para fazer a consulta do usuario
        require('connect.php');
        
        //SQL de pesquisa de usuario e senha
        $sql_pesquisa = "select * from `usuario` where `email` = '$email'";
        $resultado_usuario = mysqli_query($conexao,$sql_pesquisa);
        
        //tranformando em numero o resultado da pesquisa
        $numero_resultado = mysqli_num_rows($resultado_usuario);

        if($numero_resultado == 0){
            $vetor_user = mysqli_fetch_array($resultado_usuario);            
            if($email != $vetor_user[2]){
                session_start();

                $_SESSION['nome'] = $vetor_user[3];
                $_SESSION['senha'] = $vetor_user[4];
                $_SESSION['verif_admin'] = $vetor_user[1];

                ?>
                    <script>
                        alert("Login com sucesso!");
                        window.location.replace("acesso_restrito.php");
                    </script>
                <?php
            }

            $sql_cadastrar = "INSERT INTO `usuario`(`cpf`, `email`, `nome`, `senha`, `tel`) VALUES ('$cpf','$email','$nome','$cripto','$tel')";
        }else{
        ?>
            <script>
                alert("Falhou fi");
                window.location.replace("cad_user.php");
            </script>
        <?php
        }
        mysqli_close($conexao);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../css/style_login.css" media="screen">
    <title>Cadastro do Admin</title>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="login.php" role="tab"
                    aria-controls="pills-login" aria-selected="false">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="cad_user.php" role="tab"
                    aria-controls="pills-register" aria-selected="true">Cadastrar</a>
                </li>
            </ul>
            <div class="tab-content">
                <p class="text-center">Insira o usuário do administrador:</p>

                <div class="form-outline mb-4">
                    <label class="form-label" for="loginName">Email</label>
                    <input type="email" id="loginName" class="form-control" name="n_email"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Nome</label>
                    <input type="text" id="loginPassword" class="form-control" name="n_nome"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">CPF</label>
                    <input type="text" id="loginPassword" class="form-control" name="n_cpf"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Senha</label>
                    <input type="password" class="form-control" name="n_senha"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Repita a senha</label>
                    <input type="password" class="form-control" name="n_rep_senha"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Continuar</button>
            </div>
        </div>
    </form>

    <script>
        var password = document.getElementById("n_senha")
        , confirm_password = document.getElementById("n_rep_senha");

        function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Senhas diferentes!");
        } else {
            confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</body>
</html>