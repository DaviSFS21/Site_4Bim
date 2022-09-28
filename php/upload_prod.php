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
        if(isset($_FILES['img_prod'])){
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

            /* Movendo a imagem e apresentando-a na tela */
            $novoPath = $pasta . $novoNomeImg . "." . $extensaoImg;
            move_uploaded_file($img_prod['tmp_name'], $novoPath);
        }
        $sql_cadastrar = "INSERT INTO `produto`(`nome_prod`,`desc_prod`,`marca`,`path_img`) 
        VALUES ('$nome_prod','$desc_prod','$marca','$novoPath')";
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
    mysqli_close($conexao);
?>