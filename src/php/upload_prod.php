<?php
    /* Condição para só executar o código quando o formulário for enviado */
    if(isset($_FILES['img_prod'])){

        include("connect.php");

        $nome_prod = $_POST['c_nome_prod'];
        $desc_prod = $_POST['c_desc_prod'];
        $marca = $_POST['c_marca'];
    
        $pesquisar_prod = "SELECT * FROM `produto` WHERE nome_prod = '$nome_prod'";
    
        $resultado_prod = mysqli_query($conexao, $pesquisar_prod);
    
        $numero_retorno = mysqli_num_rows($resultado_prod);

        if($numero_retorno == 0){
            /* Declaração da variável da imagem */
            $img_prod = $_FILES['img_prod'];

            /* Declaração do novo caminho da imagem e criação do uniqid() para mudar o local da imagem, do local temporário ao source do servidor */
            $pasta = "../assets/imagens_prod/";
            $novoNomeImg = uniqid();
            $extensaoImg = strtolower(pathinfo($img_prod['name'], PATHINFO_EXTENSION));

            /* Condições caso o upload sofra um erro, caso a extensão seja a errada, ou, caso a imagem seja muito pesada */
            if($img_prod['error']){

                ?>
                <script>
                    alert("Falha ao enviar o arquivo...");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            if($extensaoImg != 'jpg' && $extensaoImg != 'png'){
                ?>
                <script>
                    alert("Extensão não permitida...(Somente .jpg ou .png)");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            if($img_prod['size'] > 4194304){
                ?>
                <script>
                    alert("Arquivo maior que 4MB...");
                    javascript:history.back();
                </script>
                <?php
                die();
            }

            $novoPath = $pasta . $novoNomeImg . "." . $extensaoImg;    
            move_uploaded_file($img_prod['tmp_name'], $novoPath);
    
            /* Movendo a imagem e apresentando-a na tela */
            $path_img = $pasta . $novoNomeImg . "." . $extensaoImg;
    
            move_uploaded_file($img_prod['tmp_name'], $path_img);
    
            $sql_cadastrar = "INSERT INTO `produto`(`nome_prod`,`desc_prod`,`marca`,`path_img`) 
            VALUES ('$nome_prod','$desc_prod','$marca','$path_img')";
            mysqli_query($conexao, $sql_cadastrar);
        
        ?>
            <script>
                alert("Produto cadastrado!");
                window.location.replace("lista_prod.php");
            </script>
        <?php
        }else{
            ?>
                <script>
                    alert("Produto já existe...");
                    javascript:history.back();
                </script>
            <?php
        }
    }
    mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen">
    <title>Pai & Filhos - Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <ul class="nav__links">
        <li><a href="form_cad_prod.html">Cadastrar</a></li>
        <li><a href="form_alt_prod.php">Alterar</a></li>
        <li><a href="form_exc_prod.php">Excluir</a></li>
        <li><a href="form_pesq_prod.html">Pesquisar</a></li>
        <li><a class="cta" href="index.html">Início</a></li>
    </ul>
    <form enctype="multipart/form-data" method="post" action="php/upload_prod.php">		
		Nome: <input name="c_nome_prod" type=text size=130 maxlength=120><br>
        Descrição: <br><textarea name="c_desc_prod" type=text size=460 maxlength=450 rows=3 cols=80></textarea><br>
        Marca: <input name="c_marca" type=text size=30 maxlength=20><br>
        Imagem: <input type="file" name="img_prod"><br>
		<input type=submit value=Enviar>
	</form>
</body>
</html>