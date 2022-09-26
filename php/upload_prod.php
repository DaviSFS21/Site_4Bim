<?php
    require("connect.php");

    $nome_prod = $_POST['c_nome_prod'];
    $desc_prod = $_POST['c_desc_prod'];
    $marca = $_POST['c_marca'];

    $pesquisar_prod = "SELECT * FROM `produto` WHERE nome_prod = '$nome_prod'";

    $resultado_prod = mysqli_query($conexao, $pesquisar_prod);

    $numero_retorno = mysqli_num_rows($resultado_prod);


    if($numero_retorno == 0)
    {
        if(isset($_FILES['imagem_prod'])){
            $imagem_prod = $_FILES['imagem_prod'];

            if($imagem_prod['error']){
                die();
                ?>
                <script>
                    alert("Falha ao enviar o arquivo...");
                    javascript:history.back();
                </script>
                <?php
            }
            if(arquivo['size'] > 4194304){
                die();
                ?>
                <script>
                    alert("Arquivo maior que 4MB...");
                    javascript:history.back();
                </script>
                <?php
            }

            $pasta = "arquivos/";
            $nomeImg = $imagem_prod['name'];
            $novoNomeImg = uniqid();
            $extensaoImg = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));
        }

        $sql_cadastrar = "INSERT INTO `produto`(`nome_prod`,`desc_prod`,`marca`,`img_prod`) VALUES ('$nome_prod','$desc_prod','$marca','$imagem_prod')";
        mysqli_query($conexao, $sql_cadastrar);
        ?>
            <script>
                alert("Produto cadastrado!");
                window.location.replace("../php/lista_prod.php");
            </script>
        <?php
    }else{
        ?>
            <script>
                alert("Produto já cadastrado...");
                javascript:history.back();
            </script>
        <?php
    }     
?>