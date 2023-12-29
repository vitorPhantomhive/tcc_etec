<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Professor</title>

    <link rel='stylesheet' href='/site/public/styles/cadastro.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>

<?php
    include "../../conexao/conexao.php";

    $id = $_GET["id"];

    $comandoSql = "select * from professor where id = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    $dados = mysqli_fetch_assoc($resultado);

    $nome = $dados["nome"];
    $email = $dados["email"];
    $telefone = $dados["telefone"];
    $cpf = $dados["cpf"];

    $comandoTurma = "select id, nome from turma";
    $resulTurma = mysqli_query($con, $comandoTurma);

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

    $excluir = "../../conexao/excluir_professor.php?id=$id";
?>

    <center>
    <img src="/site/public/arquivos/img/logo.png">
    <br>
    <h1>Alteração de Professor</h1>
    <center>

    <br>

    <div class="login">

        <form name="fcadastro" id="fcadastro" action="../../conexao/altera_professor.php?id=<?php echo $id ?>" method="POST">
            <label for="id">ID</label>
            <input class="btn btn-light" type="text" name="id" id="id" disabled value="<?php echo $id ?>">

            <br><br>

            <label for="user">Nome Professor(a)</label>
            <input class="btn btn-light" type="text" name="user" id="user" value="<?php echo $nome ?>">

            <br><br>

            <label for="email">E-mail</label>
            <input class="btn btn-light" type="email" name="email" id="email" value="<?php echo $email ?>">

            <br><br>

            <label for="telefone">Telefone</label>
            <input class="btn btn-light" type="text" name="telefone" id="telefone" maxlength="11" minlength="11" value="<?php echo $telefone ?>">

            <br><br>

            <label for="cpf">CPF</label>
            <input class="btn btn-light" type="text" name="cpf" id="cpf" maxlength="11" minlength="11" value="<?php echo $cpf ?>"> 

            <br><br>

            <label id="labelTurma">Turma</label>
            <select class="btn btn-light" multiple style="width:207px;" name="turmaProf[]" id="turmaProf[]">
                <?php 
                foreach($turmas as $id => $turma){
                    if(in_array($id, $turmaProf)){
                        echo "<option value='$id' selected>$turma</option>";
                        continue;
                    }

                    echo "<option value='$id'>$turma</option>";
                }
                ?>
            </select>

            <br><br>

            <label id="labelGrade">grade Curricular</label>
            <select class="btn btn-light" style="width:207px;" multiple name="grade[]" id="grade[]">
            <?php 
                foreach($materias as $id => $materia){
                    if(in_array($id, $materiaProf)){
                        echo "<option value='$id' selected>$materia</option>";
                        continue;
                    }

                    echo "<option value='$id'>$materia</option>";
                }
                ?>
            </select>      
            
            <br><br>

            <h6 id="ctrl">CTRL para selecionar mais de uma opção</h6>
            
            <br>

            <input class="btn btn-info" type="submit" value="Alterar">
            <a href="<?php echo $excluir?>"><button class="btn btn-danger" type="button">Excluir</button></a>
        </form>

    </div>
 
</body>
</html>