<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de aluno</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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

<div class="container">

<?php

    $id = $_GET["id"];
    $n = $_POST["user"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $turma = $_POST["turma"];

    $comandoSql = "update aluno set 
        nome = '$n',
        cpf = '$cpf', 
        email = '$email', 
        telefone = '$telefone',
        id_turma = '$turma'
        where id = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    if($resultado == true){
        

        header( "refresh:0.5; url= ../telas/escola/listar.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Alterando...</h2></div>';
    } else {
        header( "refresh:0.5; url= ../telas/escola/listar.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Erro na alteração</h2></div>';
    }
?>

</div>

</body>
</html>