<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <style>
        .c-loader {
            animation: is-rotating 1s infinite;
            border: 6px solid #e5e5e5;
            border-radius: 50%;
            border-top-color: #51d4db;
            height: 50px;
            width: 50px;
        }

        .centro {
            margin-top: 20%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        @keyframes is-rotating {
            to {
                transform: rotate(1turn);
            }
        }
    </style>
</head>
<body>

<?php
    include "./conexao.php";
?>

<?php

session_start();

$id = $_SESSION["id"];

if(file_exists($_FILES["Arquivo"]['tmp_name'])){
    $nomeDoArquivo = $_FILES["Arquivo"]["name"];
    $nomeDoArquivoTemp = $_FILES["Arquivo"]["tmp_name"];
    $tamanho = $_FILES["Arquivo"]["size"];

    if($tamanho > (1024 * 1024)){
        die("Foto muito grande");
    }
    
    copy($nomeDoArquivoTemp, "../../public/arquivos/img/{$id}professor");
}

$senha = $_POST["senha"];
$telefone = $_POST["telefone"];

$comandoSql = "update professor set
        telefone = '$telefone',
        senha = '$senha'
        where id = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    if($resultado == true){
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Dados alterados</h2></div>';
        echo '<script type="text/JavaScript"> setTimeout(() => {parent.location.reload();},1000);</script>';
    } else {
        header( "refresh:0.5; url= ../telas/professor/configP.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Erro na alteração</h2></div>';
    }
?>

</div>

</body>
</html>