<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera-gx">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../css/style_lista.css">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <ul class="nav__links">
        <li><a href="../form_cad_prod.html">Cadastrar</a></li>
        <li><a href="form_alt_prod.php">Alterar</a></li>
        <li><a href="form_exc_prod.php">Excluir</a></li>
        <li><a href="form_pesq_prod.html">Pesquisar</a></li>
        <li><a class="cta" href="index.html">Início</a></li>
    </ul>
    <div class='row'>
        <?php
            //Conexão com o banco
            require("connect.php");

            //Gerando a SQL de PESQUISA das categorias existentes no BD
            $pesquisar_prod = "SELECT * FROM `produto`";

            //Executando a SQL e armazenando o resultado em uma variavel
            $resultado_prod = mysqli_query($conexao, $pesquisar_prod);

            //Obtendo o numero de linhas retornadas na pesquisa
            $numero_resultado = mysqli_num_rows($resultado_prod);

            if($numero_resultado == 0)
            {
                ?>
                    <!-- Aqui tem Javascript!-->
                    <script>
                        alert("Não existem produtos cadastrados...");
                        window.location.replace("../index.html");
                    </script>
                <?php
            }
            else
            {

                //Existe categorias cadastradas!
                for($i = 0  ; $i < $numero_resultado; $i++){
                    //Gerando um vetor com as categorias
                    $vetor_prod = mysqli_fetch_array($resultado_prod);
                    echo "
                        <div class='card' style='width: 18rem;'>
                            <img class='card-img-top' src='$vetor_prod[4]' alt='Imagem de capa do card'>
                            <div class='card-body'>
                                <h5 class='card-title'>$vetor_prod[1]</h5>
                                <p class='card-text'>$vetor_prod[2]</p>
                                <a href='' class='btn btn-primary'>Editar</a>
                            </div>
                        </div>
                        ";
                }
            }                
        ?>     
    </div>
</body>
</html>