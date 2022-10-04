<?php

    if(isset($_POST['c_email'])){
        $email = $_POST;
        $senha = $_POST['c_senha'];
        $cripto = sha1($senha);
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