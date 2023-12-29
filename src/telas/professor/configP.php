<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/site/public/styles/config.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script>
        function mostrarSenha(){
            var tipo = document.getElementById("senha");
            var botao = document.getElementById("mostrar");

            if(tipo.type == "password"){
                tipo.type = "text";
                botao.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>';
            } else {
                tipo.type = "password";
                botao.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
            }
        }
    </script>
</head>

<?php

session_start();

include "../../conexao/conexao.php";

$id = $_SESSION["id"];

$comandoSql = "select * from professor where id = '$id'";

$resultado = mysqli_query($con, $comandoSql);

$dados = mysqli_fetch_assoc($resultado);

$nome = $dados["nome"];
$email = $dados["email"];
$senha = $dados["senha"];
$telefone = $dados["telefone"];
$cpf = $dados["cpf"];

$img = '../../../public/arquivos/img/'.$_SESSION["id"].'professor';

if(!file_exists($img)){
    $img = '../../../public/arquivos/img/camera.png';
}

?>


<body style="background: #E5E5E5">
    <div class="principal">
        <div class="conta">
            <form action="../../conexao/alteraDadosProfessor.php" method="post" enctype="multipart/form-data">

                <label style="font-weight: bold;">Imagem de perfil</label><br>
                <div class="max-width">
                    <img src="<?php echo $img ?>" alt="Selecione uma imagem" id="imgPhoto">
                </div>
                <input class="btn btn-light" type="file" name="Arquivo" id="Arquivo" accept=".png, .jpg, .jpeg"><br>

                <label style="font-weight: bold;">Nome de Usuário</label><br>
                <input class="btn btn-light" type="text" name="user" id="user" disabled value="<?php echo $nome ?>"><br><br>

                <label style="font-weight: bold;">E-mail</label><br>
                <input class="btn btn-light" type="text" name="email" id="email" disabled value="<?php echo $email ?>"><br><br>
                
                <label style="font-weight: bold;">Senha</label><br>
                <input class="btn btn-light" type="password" name="senha" id="senha" value="<?php echo $senha ?>">
                <p onClick="mostrarSenha()" id="mostrar"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg></p>

                <label style="font-weight: bold;">Telefone</label><br>
                <input class="btn btn-light" type="text" name="telefone" id="telefone" maxlength="11" minlength="11" value="<?php echo $telefone ?>"><br><br>

                <input class="btn btn-info" type="submit" value="Alterar">
            </form>
        </div>
    </div>

    <script src="../../scripts/config.js"></script>
</body>
</html>