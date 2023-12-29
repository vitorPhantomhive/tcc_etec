<?php 
    include '../conexao/conexao.php';

    session_start();

    $batata = $_SESSION["id"];

    $pegaTurma = "select id_turma from aluno where id = $batata ";
    $resulTurma = mysqli_query($con, $pegaTurma);
    $dados = mysqli_fetch_assoc($resulTurma);
    $id_turma = $dados["id_turma"];

    $comandoSql = "select Ta.nome, Ta.id, Ta.ativo from Aluno as A
                    inner join Turma as T on A.id_turma = T.id
                    inner join Turma_Tarefa as TT on TT.id_turma = T.id
                    inner join Tarefa as Ta on Ta.id = TT.id_tarefa
                    where A.id_turma = $id_turma and A.id = $batata";
?>

<link rel='stylesheet' type="text/css" href='/site/public/styles/tarefas.css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<body style="background: #E5E5E5">

    <div class="dropdown">
        <button class="btn dropdown-toggle tarefaConc" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tarefas Concluidas
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php
                $entregues = false;
                $resultado = mysqli_query($con, $comandoSql);
                while($dados = mysqli_fetch_assoc($resultado)){
                    $nome = $dados["nome"];
                    $id = $dados["id"];
                    $ativo = $dados["ativo"];

                    if($ativo == "a"){

                        $entrega = "select E.cod from Aluno as A
                        inner join entregue as E on E.id_aluno = A.id
                        inner join Tarefa as Ta on E.id_tarefa = Ta.id
                        where A.id = $batata and Ta.id = $id";
                        $resulEntrega = mysqli_query($con, $entrega);
                        while($pikachu = mysqli_fetch_assoc($resulEntrega)){
                            $entregues = true;
                            echo "<a class='dropdownTaf' href='./dentroTarefa.php?id=$id'>$nome</a>";
                        }
                    }   
                }

                if($entregues == false){
                    echo '<p class="dropdownTaf">Você não possui tarefas concluidas</p>';
                }
            ?>

        </div>
    </div>

    <div class="dropdown">
        <button class="btn dropdown-toggle tarefaAtri" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tarefas Atribuidas
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
                $existe = false;
                $resultado = mysqli_query($con, $comandoSql);
                while($dados = mysqli_fetch_assoc($resultado)){
                    $nome = $dados["nome"];
                    $id = $dados["id"];
                    $ativo = $dados["ativo"];

                    if($ativo == "a"){

                        $existe = true;

                        $entregue = null;

                        $entrega = "select E.cod from Aluno as A
                        inner join entregue as E on E.id_aluno = A.id
                        inner join Tarefa as Ta on E.id_tarefa = Ta.id
                        where A.id = $batata and Ta.id = $id";
                        $resulEntrega = mysqli_query($con, $entrega);
                        while($pikachu = mysqli_fetch_assoc($resulEntrega)){
                            $entregue = $pikachu["cod"];
                        }

                        if($entregue == null){
                    
                ?>

                    <a class="dropdownTaf" href="./dentroTarefa.php?id=<?php echo $id ?>"><?php echo $nome ?></a>

                <?php
                        }
                    }
                }

                if($existe == false){
                    echo '<p class="dropdownTaf">Você não possui tarefas Atribuidas</p>';
                }
                ?>

        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>