<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redirecionando</title>

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

    include 'conexao.php';

    session_start();

    $id_aluno = $_GET["idAluno"];
    $id_tarefa = $_GET["idTarefa"];
    $coment = $_POST["comenta"];   

    $comandoSql="update entregue set comentarios_professor = '$coment' where id_aluno = $id_aluno and id_tarefa = $id_tarefa";

    $resul = mysqli_query($con, $comandoSql);
 
    if($resul==true){

        header( "refresh:0.5; url= ../telas/professor/selecTarefa.php");
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Dados gravados com sucesso</p></div>';
           
    }else{

        header( "refresh:0.5; url= ../telas/professor/selecTarefa.php");
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Não foi possivel a gravacao</p></div>';
          
    }
    
?>

</body>
</html>
    