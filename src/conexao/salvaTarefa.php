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
    $dataPost = $_GET["data"];
    $coment = $_POST["comenta"];  

    function salvaArquivo($conexao, $id, $id_tarefa){
        $countt = count($_FILES["inputArquivo"]["name"]);

        for ($indice=0; $indice < $countt; $indice++) { 

            $nomeDoArquivo = $_FILES["inputArquivo"]["name"][$indice];
            $nomeDoArquivoTemp = $_FILES["inputArquivo"]["tmp_name"][$indice];
            $tamanho = $_FILES["inputArquivo"]["size"][$indice];

            if($tamanho > (1024 * 1024)){
                die("Arquivo muito grande, tente compactar (-_-') ");
            }

            copy($nomeDoArquivoTemp, "../../public/arquivos/tarefas/$id$id_tarefa$nomeDoArquivo");

            // TODO registrar o arquivo no bd
            $comandoSql="insert into arquivo_entregue(nome, id_aluno, id_tarefa) values ('$nomeDoArquivo', '$id', '$id_tarefa')";

            mysqli_query($conexao, $comandoSql);
        }
    }

    $comandoSql="insert into entregue(id_aluno, id_tarefa, data_entrega, comentarios_aluno) values('$id','$id_tarefa', '$dataPost', '$coment')";

    $resul = mysqli_query($con, $comandoSql);
 
    if($resul==true){

        salvaArquivo($con, $id, $id_tarefa);
		
        header( "refresh:0.5; url= ../telas/tarefas.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Dados gravados com sucesso</p></div>';
           
    }else{

        header( "refresh:0.5; url= ../telas/tarefas.php" );
        echo '<div class="centro"><div class="c-loader"></div><br><h2>Redirecionando...</h2><p>Não foi possivel a gravacao</p></div>';
          
    }
    
?>

</body>
</html>
    