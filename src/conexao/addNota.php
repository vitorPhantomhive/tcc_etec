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

    include 'conexao.php';

    session_start();

    $tipo = $_SESSION["tipo"];
    $id = $_SESSION["id"];

    $data = $_POST["data"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];

    $comandoSql = "insert into anotacao(nome, descricao, dataNota, id_usuario, tipo_usuario) values ('$titulo', '$descricao', '$data', $id, '$tipo')";

    $resul = mysqli_query($con, $comandoSql);
 
    if($resul==true){
					 
        header( "refresh:0.5; url= ../telas/anotacoes.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Dados gravados com sucesso</p></div>';
           
    }else{

        header( "refresh:0.5; url= ../telas/calendario.html" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Não foi possivel a gravacao</p></div>';
          
    }
    
?>

</body>
</html>