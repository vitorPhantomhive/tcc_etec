<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/site/public/styles/calendario.css">
</head>

<body>

<?php
    include "../conexao/conexao.php";

    session_start();

    $id = $_GET["id"];

    $comandoSql = "select * from anotacao where cod = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    $dados = mysqli_fetch_assoc($resultado);

    $titulo = $dados["nome"];
    $descricao = $dados["descricao"];
    $data = $dados["dataNota"];

    $dataform = implode("/",array_reverse(explode("-",$data)));

?>

<h1><?php echo $titulo?></h1>
<h3><?php echo $descricao?></h3>
<h4><?php echo $dataform?></h4>

<a class="alterar-nota" href="#bg">Alterar Anotação</a>
<a class="excluir-nota" href="../conexao/excluiNota.php?id='<?php echo $id ?>'">Excluir Anotação</a>

<div id="bg"></div>
<div class="box">
    <a href="" id="close">X</a>
    <form action="../conexao/alteraNota.php?id='<?php echo $id ?>'" method="post">

        <label class="labelData">Data</label><br>
        <input class="data" type="date" name="data" id="data" value="<?php echo $data?>">

        <br><br>

        <label class="labelData">Titulo</label><br>
        <input class="data" type="text" name="titulo" id="titulo" value="<?php echo $titulo?>">

        <br><br>

        <label class="labelData">Desc.</label><br>
        <textarea class="textarea" aria-label="With textarea" type="text" name="descricao" id="descricao" style="resize: none"><?php echo $descricao?></textarea>

        <br><br>

        <input class="altera" type="submit" value="Alterar">
    </form>
</div>
 
</body>
</html>