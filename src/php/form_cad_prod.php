<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="opera">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen">
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
    <form enctype="multipart/form-data" method="post" action="upload_prod.php">		
		Nome: <input name="c_nome_prod" type=text size=130 maxlength=120><br>
        Descrição: <br><textarea name="c_desc_prod" type=text size=460 maxlength=450 rows=3 cols=80></textarea><br>
        Marca: <input name="c_marca" type=text size=30 maxlength=20><br>
        Imagem: <input type="file" name="img_prod"><br>
		<input type=submit value=Enviar>
	</form>
</body>
</html>