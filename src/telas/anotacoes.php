<?php 
    include '../conexao/conexao.php';

    session_start();

    $id = $_SESSION["id"];
    $tipo = $_SESSION["tipo"];

    $comandoSql = "select cod, nome from anotacao where id_usuario = '$id' and tipo_usuario = '$tipo'";

    $resultado = mysqli_query($con, $comandoSql);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<body style="background: #E5E5E5">

<style>
    .dropdownTaf{
    display: block;
    width: 650px;
    height: 40px;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: white;

    margin-top: 1%;
    margin-left: 23.5%;
    
    box-shadow: 0px 7px 8px rgba(0, 0, 0, 0.25);
    border-radius: 8px;

    transition: 800ms;
}
</style>

<div>
    <h1 class="text-center">SUAS ANOTAÇÕES</h1>

    <br><br>

    <?php
        $existe = false;
        while($dados = mysqli_fetch_assoc($resultado)){
            $nome = $dados["nome"];
            $id = $dados["cod"];

            $existe = true;

            echo '<a class="dropdownTaf" href="./dentroAnotacoes.php?id='.$id.'">'.$nome.'</a>';

        }

        if($existe == false){
            echo '<h5 class="dropdownTaf">Você não possui anotações</h5>';
        }
    ?>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>