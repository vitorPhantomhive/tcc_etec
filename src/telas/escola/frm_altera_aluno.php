<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='stylesheet' href='/site/public/styles/cadastro.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>

<?php
    include "../../conexao/conexao.php";

    $id = $_GET["id"];

    $comandoSql = "select * from aluno where id = '$id'";

    $resultado = mysqli_query($con, $comandoSql);

    $dados = mysqli_fetch_assoc($resultado);

    $nome = $dados["nome"];
    $email = $dados["email"];
    $telefone = $dados["telefone"];
    $cpf = $dados["cpf"];
    $turma = $dados["id_turma"];
?>

    <center>
    <img src="/site/public/arquivos/img/logo.png">
    <br>
    <h1>Alteração de Aluno</h1>
    <center>

    <br>

    <div class="login">

        <form name="fcadastro" id="fcadastro" action="../../conexao/altera_aluno.php?id=<?php echo $id ?>" method="POST">

            <label for="id">ID</label>
            <input class="btn btn-light" type="text" name="id" id="id" disabled value="<?php echo $id ?>">

            <br><br>

            <label for="user">Nome Aluno</label>
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
            <select class="btn btn-light" style="width:207px;" name="turma" id="turma">
            <optgroup label="1º EM">
                <option value="1" <?php if($turma == 1) echo "selected" ?>>1º Ano A</option>
                <option value="2" <?php if($turma == 2) echo "selected" ?>>1º Ano B</option>
                <option value="3" <?php if($turma == 3) echo "selected" ?>>1º Ano C</option>
            </optgroup>
            <optgroup label="2º EM">
                <option value="4" <?php if($turma == 4) echo "selected" ?>>2º Ano A</option>
                <option value="5" <?php if($turma == 5) echo "selected" ?>>2º Ano B</option>
                <option value="6" <?php if($turma == 6) echo "selected" ?>>2º Ano C</option>
            </optgroup>
            <optgroup label="3º EM">
                <option value="7" <?php if($turma == 7) echo "selected" ?>>3º Ano A</option>
                <option value="8" <?php if($turma == 8) echo "selected" ?>>3º Ano B</option>
                <option value="9" <?php if($turma == 9) echo "selected" ?>>3º Ano C</option>
            </select>

            <br><br>

            <input class="btn btn-info" type="submit" value="Alterar">
            <a href="../../conexao/excluir_aluno.php?id=<?php echo $id ?>"><button class="btn btn-danger" type="button">Excluir</button></a>
        </form>

    </div>
 
</body>
</html>