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

    $comandoSql = "update professor set 
        nome = '$n',
        cpf = '$cpf', 
        email = '$email', 
        telefone = '$telefone'
        where id = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    if($resultado == true){

        $deleteGrade = "delete from materia_professor where id_professor = $id";
        $deleteTurma = "delete from turma_professor where id_professor = $id";

        mysqli_query($con, $deleteGrade);
        mysqli_query($con, $deleteTurma);

        foreach($_POST["grade"] as $valor){
            $comandoGrade="insert into materia_professor(id_materia, id_professor) values($valor, $id)";
            $resulGrade = mysqli_query($con, $comandoGrade);

            if($resulGrade != true){
                $resultado = false;
            }
        }

        foreach($_POST["turmaProf"] as $valor){
            $comandoTurma="insert into turma_professor(id_turma, id_professor) values($valor, $id)";
            $resulTurma = mysqli_query($con, $comandoTurma);

            if($resulTurma != true){
                $resultado = false;
            }
        }
    }

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