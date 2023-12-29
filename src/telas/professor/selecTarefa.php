<link rel='stylesheet' href='/site/public/styles/tarefas.css'>
<link rel='stylesheet' href='/site/public/styles/selecTarefa.css'>
<script src="https://kit.fontawesome.com/fdb3446050.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78b25531ed.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/becb71d002.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<body style="background: #E5E5E5">

<script type="text/javascript">
    function buscar(){
    //Pega a pesquisa no formulario e passa como parametro 
    url = "selecTarefa.php?pesquisa="+pesquisar.pesquisa.value;
    window.location.href =  url;
    }
</script> 

<?php

    include "../../conexao/conexao.php";

    session_start();

    $id_professor = $_SESSION["id"];

    if(isset($_GET['pesquisa'])){
        $pesquisa = $_GET['pesquisa'];
    }else{
        $pesquisa = "";
    }

    $comandoSql = "select id, nome, dataF, ativo from tarefa where id_professor = '$id_professor' and nome like '%$pesquisa%'";

    $resul = mysqli_query($con, $comandoSql);
?>

    <div class="divPrincipal">

        <div class="eevee">

            <form name="pesquisar">
                <input class="magikarp" type="text" name="pesquisa" placeholder='Pesquisar Tarefa...'>
            </form>
            
            <div class="lilligant"><img src="/site/public/arquivos/img/logo.png"></div>
        </div>

        <div class="divide"> </div>

        <div class="haxorus">

        <a href="./cadastrarTarefa.php" class="cubchoo"><button class="cubcho"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg></button></a>
        </div>

        <div class="ivysaur">
            <?php 
                $existe = false;
                while($dados = mysqli_fetch_assoc($resul)){
                    $id = $dados["id"];
                    $nome = $dados["nome"];
                    $dataF = $dados["dataF"];
                    $ativo = $dados["ativo"];

                    if($ativo == 'a'){
                        $dataform = implode("/",array_reverse(explode("-",$dataF)));

                        $existe = true;
    
                        echo "<div class='pikachu'>";
                        echo "<a href='./dentroSelecTarefa.php?id=$id' class='charmander'><span class='nome'>$nome</span><span class='data'>$dataform</span></a><br>";
                        echo "</div>";
                    }
                }

                if($existe == false){
                    echo "<div class='pikachu'>";
                    echo "<p class='charmander naopossui'>Você não possui tarefas atribuidas</p><br>";
                    echo "</div>";
                }
            ?>
        </div>

    </div>
</body>
</html>