<?php 
    include '../corpo.php'; 

    include '../../conexao/conexao.php';

    $id = $_GET["id"];
    $id_tarefa = $_GET["tarefa"];

    $comandoSql = "select * from entregue where id_aluno = $id and id_tarefa = $id_tarefa";

    $pegarNomeALuno = "select nome from aluno where id = $id";
    $resulALuno = mysqli_query($con, $pegarNomeALuno);
    $dadoAluno = mysqli_fetch_assoc($resulALuno);
    $nome_aluno = $dadoAluno["nome"];

    $pegarNomeTarefa = "select nome from tarefa where id = $id_tarefa";
    $resulTarefa = mysqli_query($con, $pegarNomeTarefa);
    $dadoTarefa = mysqli_fetch_assoc($resulTarefa);
    $nome_tarefa = $dadoTarefa["nome"];
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="/site/public/styles/dentroAluno.css">

<body style="background: #E5E5E5">

<?php

    $resultado = mysqli_query($con, $comandoSql);
    $dados = mysqli_fetch_assoc($resultado);

    $dataEntregue = $dados["data_entrega"];
    $comentario = $dados["comentarios_aluno"];

    $dataform = implode("/",array_reverse(explode("-",$dataEntregue)));

    $pegarArquivos = "select nome from arquivo_entregue where id_aluno = $id and id_tarefa = $id_tarefa";
    $resulArquivos = mysqli_query($con, $pegarArquivos);
?>


<!--   ############################################################################################################################-->

<div class="divEsquerda">

<?php 
while ($dadosArquivos = mysqli_fetch_assoc($resulArquivos)) {
    $arquivo = $dadosArquivos["nome"];
    $ar = "../../../public/arquivos/tarefas/$id$id_tarefa$arquivo";

    if(!file_exists($ar)){
        $ar = '';
    } else{
        $ar = "<a href='$ar' class='dropdownTaf'><span>Arquivo: $arquivo</span><span>Data entrega: $dataform</span><span><i class='fa-solid fa-download'></i></span></a>";
    }

    echo "<p>$ar<br>";
}
?>

</div>

<div class="divPrincipal">

    <h3>Nome Tarefa</h3>
    <div class="divNome"><?php echo $nome_tarefa ?></div>  

    <h3>Nome Aluno</h3>
    <div class="divAluno"><?php echo $nome_aluno ?></div> 
        
    <h3>Comentário Aluno</h3>
    <div class="divComentAluno"><?php echo $comentario ?></div>

    <form action="../../conexao/addComentProf.php?idAluno=<?php echo $id?>&idTarefa=<?php echo $id_tarefa?>" method="post">
        <input type="text" class="btn comenta" name="comenta" id="comenta" placeholder="Digite para o aluno(a)">

        <br>

        <input type="submit" class="btn tarefaBotao" value="Devolver Tarefa">
    </form>
</div>
<script src="https://kit.fontawesome.com/78b25531ed.js" crossorigin="anonymous"></script>

</body>
</html>