<?php
    //Caso existam dados nas caixas de texto, executar o código
    if(isset($_POST['n_email'])){
        $email = $_POST['n_email'];
        $cpf = $_POST['n_cpf'];
        $nome = $_POST['n_nome'];
        $senha = $_POST['n_senha'];
        $tel = $_POST['n_tel'];
        $cripto = sha1($senha);

        //Conectando com o banco para fazer a consulta do usuario
        require('connect.php');
        
        //SQL de pesquisa de email
        $sql_pesq_email = "select * from `usuario` where `email` = '$email'";
        $result_email = mysqli_query($conexao,$sql_pesq_email);
        
        //tranformando em numero o resultado da pesquisa
        $verif_email = mysqli_num_rows($result_email);

        //SQL de pesquisa de CPF
        $sql_pesq_cpf = "select * from `usuario` where `cpf` = '$cpf'";
        $result_cpf = mysqli_query($conexao,$sql_pesq_cpf);
        
        //tranformando em numero o resultado da pesquisa
        $verif_cpf = mysqli_num_rows($result_cpf);

        //Se não houver dados iguais, realizar o cadastro
        if($verif_email == 0 && $verif_cpf == 0){

            //Iniciando a session com os dados inseridos
            session_start();
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;

            ?>
                <script>
                    alert("Cadastrado com sucesso!");
                    window.location.replace("acesso_restrito.php");
                </script>
            <?php

            //Comando e função de execução para o insert do usuário no BD
            $sql_cadastrar = "INSERT INTO `usuario`(`cpf`, `email`, `nome`, `senha`, `tel`) 
            VALUES ('$cpf','$email','$nome','$cripto','$tel')";

            mysqli_query($conexao, $sql_cadastrar);
        }
        //Caso já existam registros inseridos, criar condicionais para mostrar o que foi repetido
        else{
            if($verif_cpf == 1) $valor_rep = "CPF já cadastrado...";
            if($verif_email == 1){
                if ($valor_rep) $valor_rep = "CPF e ";
                $valor_rep = $valor_rep . "Email já cadastrado...";
            }
            ?>
                <script>
                    alert("<?php echo $valor_rep; ?>");
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
                    <input type="text" id="loginName" class="form-control" name="n_email" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Nome</label>
                    <input type="text" id="loginPassword" class="form-control" name="n_nome" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">CPF</label>
                    <input type="text" id="loginPassword" class="form-control" name="n_cpf" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Telefone</label>
                    <input type="text" id="loginPassword" class="form-control" name="n_tel" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Senha</label>
                    <input type="password" class="form-control" name="n_senha" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Repita a senha</label>
                    <input type="password" class="form-control" name="n_rep_senha" required>
                </div>
                <button type="submit" id="confirm_button" class="btn btn-primary btn-block mb-4">Continuar</button>
            </div>
        </div>
    </form>

</body>
</html>