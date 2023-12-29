<link rel='stylesheet' href='/site/public/styles/tarefas.css'>
<link rel='stylesheet' href='/site/public/styles/dentroSelec.css'>
<script src="https://kit.fontawesome.com/fdb3446050.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78b25531ed.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/becb71d002.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<body style="background: #E5E5E5">

<?php

    include "../../conexao/conexao.php";

    session_start();

    $id_tarefa = $_GET["id"];

    $comandoSql = "select A.id, A.nome from tarefa as T
                    inner join turma_tarefa as TT on TT.id_tarefa = T.id
                    inner join Turma as TU on TU.id = TT.id_turma
                    inner join Aluno as A on A.id_turma = TU.id
                    where T.id = $id_tarefa and A.nome like '%$pesquisa%' order by A.nome asc";

    $resul = mysqli_query($con, $comandoSql);
?>

    <div class="divPrincipal">

    
        <div class="chaves">
            
            <div class="seubarriga"><img src="/site/public/arquivos/img/logo.png"></div>
        </div><!-- o eevee acaba aqui-->

        <div class="divide"> </div>

        <div class="seuMadruga">
            <a href="./alterarTarefa.php?id=<?php echo $id_tarefa?>" class="veia71"><button class="veia17">Alterar</button></a>
        </div>

        <div class="girafales">
            <?php 
                while($dados = mysqli_fetch_assoc($resul)){
                    $id = $dados["id"];
                    $nome = $dados["nome"];

                    $tarefa = "";

                    $tarefa = "<p class='chiquinha'><span class='nome'>Nome: $nome</span><span class='status'>Status: <span class='NaoEntregue'>Não Entregue</span></span></p><br>";

                    $entrega = "select E.cod from Aluno as A
                    inner join entregue as E on E.id_aluno = A.id
                    inner join Tarefa as Ta on E.id_tarefa = Ta.id
                    where A.id = $id and Ta.id = $id_tarefa";
                    $resulEntrega = mysqli_query($con, $entrega);
                    while($pikachu = mysqli_fetch_assoc($resulEntrega)){

                        $tarefa = "<a href='./dentroAluno.php?id=$id&tarefa=$id_tarefa' class='chiquinha'><span class='nome'>Nome: $nome</span><span class='statusEntregue'>Status: <span class='Entregue'>Entregue</span></span></a><br>";
                    }

                    echo "<div class='florinda'>";
                    echo $tarefa;
                    echo "</div>";
                }
            ?>
        </div>

    </div>
</body>
</html>