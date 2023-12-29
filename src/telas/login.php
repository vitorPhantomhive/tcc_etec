<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel='stylesheet' href='/site/public/styles/login.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script>
        function mudarLogin(){
            var select = frmlogin.login.selectedIndex;
            var value = frmlogin.login.options[select].value;

            if(value == "Escola"){
                document.getElementById('nomeLogin').innerHTML = 'CNPJ';
                document.getElementById('user').placeholder = 'CNPJ';
            } else {
                document.getElementById('nomeLogin').innerHTML = 'Usuário';
                document.getElementById('user').placeholder = 'Usuário/E-mail';
            }

        }
    </script>
</head>
<body onload="mudarLogin()">

    <center>
    
    <img src="/site/public/arquivos/img/logo.png">
    <br>
    <h1>Login de Usuário</h1>
    
    <center>

    <br>

    <div class="login">

        <form name="frmlogin" id="frmlogin" action="../conexao/logar.php" method="POST">

            <select class="form-control" name="login" onchange="mudarLogin()">
                <option value="Aluno">Aluno</option>
                <option value="Professor">Professor</option>
                <option value="Escola">Escola</option>
            </select>

            <br>

            <label for="user" id="nomeLogin"></label>
            <input class="btn btn-light" type="text" name="user" id="user">

            <br><br>

            <label for="senha">Senha</label>
            <input class="btn btn-light" type="password" name="senha" id="senha">

            <br><br>

            <input class="btn btn-info" type="submit" value="Entrar">

            <br><br>

        </form>

    </div>
    
</body>
</html>