<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel='stylesheet' type="text/css" href='/site/public/styles/tarefas.css'>
<link rel='stylesheet' type="text/css" href='/site/public/styles/SelecTarefa.css'>

<style>
      body{
        background: #E5E5E5;
      }
</style>

<script type="text/javascript">
    function buscar(){
    //Pega a pesquisa no formulario e passa como parametro 
    url = "listar.php?pesquisa="+pesquisar.pesquisa.value;
    window.location.href =  url;
    }
</script> 

<?php

    include "../../conexao/conexao.php";

    if(isset($_GET['pesquisa'])){
        $pesquisa = $_GET['pesquisa'];
    }else{
        $pesquisa = "";
    }

    $comandoSql = "select * from aluno where nome like '%$pesquisa%'";
    $comandoSql1 = "select * from professor where nome like '%$pesquisa%'";

    $resultado = mysqli_query($con, $comandoSql);
    
?>
<div class="dropdown">
    <div class="eevee">

    <form name="pesquisar">
        <input class="magikarp" type="text" name="pesquisa" placeholder='Pesquisar Usuário...'>
    </form>

    <div class="lilligant"><img src="/site/public/arquivos/img/logo.png"></div>
    </div>

    <button class="btn dropdown-toggle tarefaConc" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Listagem De Alunos
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        <?php

            $resultado = mysqli_query($con, $comandoSql);
            while($dados = mysqli_fetch_assoc($resultado)){
                $nome = $dados["nome"];
                $id = $dados["id"];
                $ativo = $dados["ativo"];

                if($ativo == 'a'){
        ?>

                <a class="dropdownTaf" href="./frm_altera_aluno.php?id=<?php echo $id ?>"><?php echo $nome ?></a>

        <?php 
                }
            }
        ?>

    </div>
</div>

<div class="dropdown">
    <button class="btn dropdown-toggle tarefaConc" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Listagem De Professor
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        <?php

            $resultado1 = mysqli_query($con, $comandoSql1);
            while($dados = mysqli_fetch_assoc($resultado1)){
                $nome = $dados["nome"];
                $id = $dados["id"];
                $ativo = $dados["ativo"];

                if($ativo == 'a'){

        ?>

                <a class="dropdownTaf" href="./frm_altera_professor.php?id=<?php echo $id ?>"><?php echo $nome ?></a>

        <?php 
                }
            }
        ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>