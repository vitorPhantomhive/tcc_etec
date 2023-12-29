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

    $nomeDoArquivo = "";
    $nomeDoArquivoTemp = "";

    if(file_exists($_FILES["inputArquivo"]['tmp_name'])){
        $nomeDoArquivo = $_FILES["inputArquivo"]["name"];
        $nomeDoArquivoTemp = $_FILES["inputArquivo"]["tmp_name"];
        $tamanho = $_FILES["inputArquivo"]["size"];

        if($tamanho > (1024 * 1024)){
            die("Arquivo muito grande, tente compactar (-_-') ");
        }
    }

    include 'conexao.php';

    session_start();

    $id = $_SESSION["id"];

    $user = $_POST["user"];
    $descricao = $_POST["descricao"];
    $dataPost = $_GET["data"];
    $dataF = $_POST["dataF"];
    $materia = $_POST["grade"];

    $comandoSql="insert into tarefa(nome, descricao, dataPost,  dataF, materia, id_professor, nome_arquivo, ativo) values('$user','$descricao', '$dataPost', '$dataF', '$materia', '$id', '$nomeDoArquivo', 'a')";

    $resul = mysqli_query($con, $comandoSql);

    if($resul==true){

        $puxarTarefa = "select id from tarefa where nome = '$user' and descricao = '$descricao' and dataPost = '$dataPost' and dataF = '$dataF' and materia = '$materia' and id_professor = $id";

        $resulId = mysqli_query($con, $puxarTarefa);

        if($resulId == true){
            $dados = mysqli_fetch_assoc($resulId);

            $idTarefa = $dados["id"];
            $turma = $_POST["turma"];

            if(file_exists($_FILES["inputArquivo"]["tmp_name"])){
                copy($nomeDoArquivoTemp, "../../public/arquivos/tarefas/$idTarefa$nomeDoArquivo");
            }

            $addTarefaTurma = "insert into turma_tarefa(id_turma, id_Tarefa) values ($turma, $idTarefa)";

            $resulTarefaTurma = mysqli_query($con, $addTarefaTurma);

            if($resulTarefaTurma == false) $resul = false;
        }

    }
 
    if($resul==true){
					 
        header( "refresh:0.5; url= ../telas/professor/selecTarefa.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Dados gravados com sucesso</p></div>';
           
    }else{

        header( "refresh:0.5; url= ../telas/professor/selecTarefa.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Não foi possivel a gravacao</p></div>';
          
    }
    
?>

</body>
</html>
    