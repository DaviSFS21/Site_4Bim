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

        //SQL de pesquisa de Telefone
        $sql_pesq_tel = "select * from `usuario` where `tel` = '$tel'";
        $result_tel = mysqli_query($conexao,$sql_pesq_tel);
        
        //tranformando em numero o resultado da pesquisa
        $verif_tel = mysqli_num_rows($result_tel);

        //Se não houver dados iguais, realizar o cadastro
        if($verif_email == 0 && $verif_cpf == 0 && $verif_tel == 0){

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
            if($verif_cpf == 1) $valor_rep = "CPF; ";
            if($verif_email == 1) $valor_rep = $valor_rep . "Email; ";
            if($verif_tel == 1) $valor_rep = $valor_rep . "Telefone; ";
            ?>
                <script>
                    alert("Já cadastrados: <?php echo trim($valor_rep,"; "); ?>");
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
                <?php if(isset($valor_rep)) 
                echo '<div class="alerta error"><i class="fas fa-exclamation-circle" style="margin-right: 10px;">
                    </i>CPF, Email, ou Telefone inválidos</div>'; ?>
                <div class="form-outline mb-4">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="n_email" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="n_nome" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" onkeypress="$(this).mask('000.000.000-00');" maxlength="15" name="n_cpf" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" onkeypress="$(this).mask('(00) 00000-0000');" maxlength="15" name="n_tel" required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label">Senha</label>
                    <input type="password" oninput="check_senha()" class="form-control" id="n_senha" minlength=8 required>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label">Repita a senha</label>
                    <input type="password" oninput="check_senha()" class="form-control" id="n_rep_senha" minlength=8 required>
                </div>
                <button type="submit" id="confirm_button" class="btn btn-primary btn-block mb-4">Continuar</button>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="../js/confirm_senha.js" text="text/javascript"></script>
</body>
</html>