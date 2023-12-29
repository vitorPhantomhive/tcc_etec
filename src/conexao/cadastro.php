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

    $tipo = $_POST["selec"];

    $user = $_POST["user"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];

    //validando cpf
    $comandoCpfAluno = "select cpf from aluno where cpf = '$cpf'";
    $comandoCpfProfessor = "select cpf from professor where cpf = '$cpf'";

    $resultadoAluno = mysqli_query($con, $comandoCpfAluno);
    $resultadoProfessor = mysqli_query($con, $comandoCpfProfessor);

    $dadosAluno = mysqli_fetch_assoc($resultadoAluno);
    $dadosProfessor = mysqli_fetch_assoc($resultadoProfessor);

    $cpfAluno = isset($dadosAluno["cpf"]);
    $cpfProfessor = isset($dadosProfessor["cpf"]);

    if($cpfAluno == null && $cpfProfessor == null) {

        if($tipo == "Aluno"){
            $turma = $_POST["turma"];

            $comandoSql="insert into aluno(nome, email, senha, telefone, cpf, id_turma, ativo) values('$user','$email', '$cpf', '$telefone', '$cpf', '$turma', 'a')";

            $resul = mysqli_query($con, $comandoSql);
        } else if($tipo == "Professor"){
            $comandoSql="insert into professor(nome, email, senha, telefone, cpf, ativo) values('$user','$email', '$cpf', '$telefone', '$cpf', 'a')";

            $resul = mysqli_query($con, $comandoSql);

            if($resul == true){

                $idProf = "select id from professor where cpf = '$cpf'";
                $resulId = mysqli_query($con, $idProf);

                if($resulId == true){

                    $dadosId =  mysqli_fetch_assoc($resulId);

                    $id = $dadosId["id"];

                    foreach($_POST["grade"] as $valor){
                        $comandoGrade="insert into materia_professor(id_materia, id_professor) values($valor, $id)";
                        $resulGrade = mysqli_query($con, $comandoGrade);

                        if($resulGrade != true){
                            $resul = false;
                        }
                    }
        
                    foreach($_POST["turmaProf"] as $valor){
                        $comandoTurma="insert into turma_professor(id_turma, id_professor) values($valor, $id)";
                        $resulTurma = mysqli_query($con, $comandoTurma);

                        if($resulTurma != true){
                            $resul = false;
                        }
                    }
                }
            }
        }

    } else {
        $resul = false;
    }
 
    if($resul==true){
					 
        header( "refresh:0.5; url= ../telas/escola/listar.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Dados gravados com sucesso</p></div>';
           
    }else{

        header( "refresh:0.5; url= ../telas/escola/cadastrar.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Não foi possivel a gravacao</p></div>';
          
    }
    
?>

</body>
</html>
    