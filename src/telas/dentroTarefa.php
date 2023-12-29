<?php 
    include './corpo.php'; 

    include '../conexao/conexao.php';

    $id = $_GET["id"];
    $id_aluno = $_SESSION["id"];

    $comandoSql = "select * from tarefa where id = $id";

    $dia_mes = date('d');
    $mes = date('m');
    $ano = date('Y');

    $data_atual = "$ano-$mes-$dia_mes";

    $entrega = "select E.cod, E.comentarios_professor from Aluno as A
                inner join entregue as E on E.id_aluno = A.id
                inner join Tarefa as Ta on E.id_tarefa = Ta.id
                where A.id = $id_aluno and Ta.id = $id";
    $resulEntrega = mysqli_query($con, $entrega);

    $entregue = false;

    $comentProf = "";

    while($dadosEntrega = mysqli_fetch_assoc($resulEntrega)){
        $entregue = true;
        $comentProf = $dadosEntrega["comentarios_professor"];
    }
?>

<link rel='stylesheet' href='/site/public/styles/tarefas.css'>
<link rel='stylesheet' href='/site/public/styles/dentroTarefa.css'>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<body style="background: #E5E5E5">

<div class="divPrincipal">

    <div class="mostrarTarefa">
   
        <?php

            $resultado = mysqli_query($con, $comandoSql);
            $dados = mysqli_fetch_assoc($resultado);
                $nome = $dados["nome"];
                $descricao = $dados["descricao"];
                $dataF = $dados["dataF"];
                $arquivo = $dados["nome_arquivo"];

                $dataform = implode("/",array_reverse(explode("-",$dataF)));

                $ar = "../../public/arquivos/tarefas/$id$arquivo";

                if(!file_exists($ar)){
                    $ar = '';
                } else{
                    $ar = "<br><span class='nomeTarefa'>Arquivo Professor:</span><br><a class='arquivo' href='$ar'>$arquivo</a><br><br>";
                }
        ?>  

        <div class="cima">
            Atividade
            <div class="dataT"><?php echo $dataform?></div>
        </div>
        
        <div class="line"></div>

        <div class="baixo">
            <div class="nomeTarefa"><?php echo $nome ?></div>
            <div class="descricaoTarefa"><?php echo $descricao ?></div> 
            <?php echo $ar?>
            
            <?php
            if($entregue != true){
            ?>
            <div class="entrega">
                <form action="../conexao/salvaTarefa.php?id=<?php echo $id?>&data=<?php echo $data_atual?>" method="post" enctype="multipart/form-data">
                    <div class="botaoArquivo">Selecionar arquivo...</div>
                    <input type="file" id="inputArquivo" name="inputArquivo[]" multiple>

                    <br><br>
                     
                    <div class="cima">
                        <input type="text" class="btn comenta" name="comenta" id="comenta" class="coment" placeholder="Comentários">
                        
                        <input type="submit" class="btn botaoTarefa" value="Entregar Tarefa!!">
                    </div>
                </form>

            </div>
            <?php
            }else{

                echo "<div class='comentProf nomeTarefa'>Comentários do professor: <div class='borda'>$comentProf</div></div>";

                $pegarArquivos = "select nome from arquivo_entregue where id_aluno = $id_aluno and id_tarefa = $id";
                $resulArquivos = mysqli_query($con, $pegarArquivos);

                while ($dadosArquivos = mysqli_fetch_assoc($resulArquivos)) {
                    $arquivo = $dadosArquivos["nome"];
                    $ar = "../../public/arquivos/tarefas/$id_aluno$id$arquivo";
                
                    if(!file_exists($ar)){
                        $ar = '';
                    } else{
                        $ar = "<a href='$ar'>$arquivo</a>";
                    }

                    echo "<div class='arquivoenviado'>$ar</div>";
                }

            }
            ?>
        </div>

    </div>

</div>

<script type="text/javascript">
    var div = document.getElementsByClassName("botaoArquivo")[0];
    var input = document.getElementById("inputArquivo");

    div.addEventListener("click", function(){
        input.click();
    });
    input.addEventListener("change", function(){
        var nome = "Não há arquivo selecionado. Selecionar arquivo...";
        if(input.files.length > 0) {
            if(input.files.length > 1){
                tanto = input.files.length - 1;
                nome = input.files[0].name + ` e outros ${tanto}`;
            }else{
                nome = input.files[0].name;
            }
        }
        div.innerHTML = nome;
    });
</script>

</body>
</html>