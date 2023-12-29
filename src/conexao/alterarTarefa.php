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

    $id = $_SESSION["id"];
    $id_tarefa = $_GET["id"];

    $nome = $_POST["user"];
    $descricao = $_POST["descricao"];
    $dataF = $_POST["dataF"];
    $materia = $_POST["grade"];

    $nomeDoArquivo = "";
    $nomeDoArquivoTemp = "";

    $comandoArquivo = "select nome_arquivo from tarefa where id = $id_tarefa";
    $resultselec= mysqli_query($con,$comandoArquivo);
    $dadosArquivo = mysqli_fetch_assoc($resultselec);
    $arquivo = $dadosArquivo["nome_arquivo"];

    $arquivoPasta = "../../public/arquivos/tarefas/$id_tarefa$arquivo";

    if(file_exists($_FILES["inputArquivo"]['tmp_name'])){
        $nomeDoArquivo = $_FILES["inputArquivo"]["name"];
        $nomeDoArquivoTemp = $_FILES["inputArquivo"]["tmp_name"];
        $tamanho = $_FILES["inputArquivo"]["size"];

        if(file_exists($arquivoPasta)){
            unlink($arquivoPasta);
        }

        if($tamanho > (1024 * 1024)){
            die("Arquivo muito grande, tente compactar (-_-') ");
        }
    }else{
        $nomeDoArquivo = $arquivo;
    }

    $comandoSql="update tarefa set 
        nome = '$nome',
        descricao = '$descricao',
        dataF = '$dataF',
        materia = '$materia',
        nome_arquivo = '$nomeDoArquivo'
        where id = '$id_tarefa'";

    $resul = mysqli_query($con, $comandoSql);

    if($resul==true){

        $turma = $_POST["turma"];

        if(file_exists($_FILES["inputArquivo"]["tmp_name"])){
            copy($nomeDoArquivoTemp, "../../public/arquivos/tarefas/$id_tarefa$nomeDoArquivo");
        }

        $addTarefaTurma = "update turma_tarefa set
            id_turma = '$turma'
            where id_Tarefa = '$id_tarefa'";

        $resulTarefaTurma = mysqli_query($con, $addTarefaTurma);

        if($resulTarefaTurma == false) $resul = false;

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