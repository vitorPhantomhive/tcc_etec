<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='stylesheet' href='/site/public/styles/cadastro.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastrar Tarefas</title>
</head>
<body>

<?php
    include "../../conexao/conexao.php";

    session_start();

    $id = $_SESSION["id"];
    $id_tarefa = $_GET["id"];

    $comandoSql = "select * from tarefa where id = $id_tarefa";

    $resultselec= mysqli_query($con,$comandoSql);

    $dados = mysqli_fetch_assoc($resultselec);
    $nomeTarefa = $dados["nome"];
    $descricaoTarefa = $dados["descricao"];
    $dataF = $dados["dataF"];
    $arquivo = $dados["nome_arquivo"];
    $materiaTarefa = $dados["materia"];

    $comandoTurma = "select id, nome from turma";
    $resulTurma = mysqli_query($con, $comandoTurma);

    $comandoTurmaTarefa = "select id_turma from turma_tarefa where id_tarefa = $id_tarefa";
    $resulTurmaTarefa = mysqli_query($con, $comandoTurmaTarefa);
    $dadosTurmaTarefa = mysqli_fetch_assoc($resulTurmaTarefa);
    $idTurmaTarefa = $dadosTurmaTarefa["id_turma"];

    while ($dadosTurma = mysqli_fetch_assoc($resulTurma)) {
        $turmas[$dadosTurma["id"]] = $dadosTurma["nome"];
    }

    $comandoTurmaProf = "select Tp.id_turma from professor as P
                    inner join turma_professor as Tp on P.id = Tp.id_professor
                    inner join turma as T on T.id = Tp.id_turma
                    where P.id = $id";

    $resulTurmaProf = mysqli_query($con, $comandoTurmaProf);

    while ($dadosTurmaProf = mysqli_fetch_assoc($resulTurmaProf)) {
        $turmaProf[] = $dadosTurmaProf["id_turma"];
    }

    $comandoMateria = "select id, nome from materia";
    $resulMateria = mysqli_query($con, $comandoMateria);

    while ($dadosMateria = mysqli_fetch_assoc($resulMateria)) {
        $materias[$dadosMateria["id"]] = $dadosMateria["nome"];
    }

    $comandoMateriaProf = "select Mp.id_materia from professor as P
                    inner join materia_professor as Mp on P.id = Mp.id_professor
                    inner join materia as M on M.id = Mp.id_materia
                    where P.id = $id";

    $resulMateriaProf = mysqli_query($con, $comandoMateriaProf);

    while ($dadosMateriaProf = mysqli_fetch_assoc($resulMateriaProf)) {
        $materiaProf[] = $dadosMateriaProf["id_materia"];
    }

    $ar = "../../../public/arquivos/tarefas/$id_tarefa$arquivo";

    if(!file_exists($ar)){
        $ar = '<p class="btn btn-light">Nenhum Arquivo</p>';
    } else{
        $ar = "<a class='btn btn-light' href='$ar'>$arquivo</a><br><br>";
    }
?>

    <center>
    <img src="/site/public/arquivos/img/logo.png">
    <br>
    <h1>Cadastro de Tarefas</h1>
    <center>
<div class="login">

<form name="fcadastro" id="fcadastro" action="/site/src/conexao/alterarTarefa.php?id=<?php echo $id_tarefa ?>" method="POST" enctype="multipart/form-data">

    <label for="user">Nome da Tarefa</label>
    <input class="btn btn-light" type="text" name="user" id="user" value="<?php echo $nomeTarefa?>">

    <br><br>

    <label for="descricao">Descrição</label>
    <textarea class="form-control" aria-label="With textarea" type="text" name="descricao" id="descricao" style="resize: none"><?php echo $descricaoTarefa?></textarea>

    <br>

    <label>Arquivo Selecionado</label>
    <?php echo $ar?>

    <label for="inputArquivo">Novo Arquivo</label>
    <div class="botaoArquivo btn btn-light">Selecionar arquivo...</div>
    <input type="file" id="inputArquivo" name="inputArquivo">

    <br><br>

    <label for="dataF">Data Finalização</label>
    <input class="btn btn-light" type="date" name="dataF" id="dataF" value="<?php echo $dataF?>">

    <br><br>

    <label id="labelTurma">Turma</label>
    <select class="btn btn-light" style="width:207px;" name="turma" id="turma">
        <?php 
        foreach($turmas as $id => $turma){
            if(in_array($id, $turmaProf)){
                if($id == $idTurmaTarefa){
                    echo "<option value='$id' selected>$turma</option>";
                } else {
                    echo "<option value='$id'>$turma</option>";
                }
            }
        }
        ?>
    </select>

    <br><br>

    <label id="labelGrade">Disciplina</label>
    <select class="btn btn-light" style="width:207px;" name="grade" id="grade">
    <?php 
        foreach($materias as $id => $materia){
            if(in_array($id, $materiaProf)){
                if($id == $materiaTarefa){
                    echo "<option value='$id' selected>$materia</option>";
                } else {
                    echo "<option value='$id'>$materia</option>";
                }
            }
        }
    ?>
    </select>      
    
    <br><br>

    <input class="btn btn-info" type="submit" value="Alterar">
    <a href="../../conexao/deletarTarefa.php?id=<?php echo $id_tarefa ?>"><button class="btn btn-danger" type="button">Excluir</button></a>

</form> 

<script type="text/javascript">
    var div = document.getElementsByClassName("botaoArquivo")[0];
    var input = document.getElementById("inputArquivo");

    div.addEventListener("click", function(){
        input.click();
    });
    input.addEventListener("change", function(){
        var nome = "Não há arquivo selecionado. Selecionar arquivo...";
        if(input.files.length > 0) nome = input.files[0].name;
        div.innerHTML = nome;
    });
</script>

</div>
    
</body>
</html>