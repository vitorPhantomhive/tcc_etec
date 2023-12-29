<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redirecionando</title>
</head>
<body>

<?php

    $tipo = $_POST["login"];

    $user = $_POST["user"];
    $senha = $_POST["senha"];

    include "./conexao.php";

    if($tipo == "Aluno"){
        $comandoSql = "select * from aluno where nome='$user' and senha='$senha'";
    }else if($tipo == "Professor"){
        $comandoSql = "select * from professor where nome='$user' and senha='$senha'";
    }else if($tipo == "Escola"){
        $comandoSql = "select * from escola where cnpj='$user' and senha='$senha'";
    }

    $result = mysqli_query($con,$comandoSql);

    if(mysqli_num_rows($result) <= 0) {

        if($tipo == "Aluno"){
            $comandoSql = "select * from aluno where email='$user' and senha='$senha'";
        }else if($tipo == "Professor"){
            $comandoSql = "select * from professor where email='$user' and senha='$senha'";
        }

        $result = mysqli_query($con,$comandoSql);

        if(mysqli_num_rows($result) <= 0) {
            header ("location:../telas/login.php");
        }

    }

    if ($dados = mysqli_fetch_assoc($result)){

        if($tipo != "Escola"){
            $ativo = $dados["ativo"];

            if($ativo == "d"){
                header ("location:../telas/login.php");
            }
        }
        
        session_start();

        $_SESSION["nome"] = $dados["nome"];
        $_SESSION["logado"] = true;
        $_SESSION["tipo"] = $_POST["login"];
        $_SESSION["id"] = $dados["id"];

        if($tipo == "Aluno"){
            header( "refresh:0; url= ../telas/inicio.php" );
        }else if($tipo == "Professor"){
            header( "refresh:0; url= ../telas/professor/telaProfessor.php" );
        }else if($tipo == "Escola"){
            header( "refresh:0; url= ../telas/escola/inicioEscola.php" );
        }

    }   

?>
    
</body>
</html>

