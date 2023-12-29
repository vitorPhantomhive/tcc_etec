
<head>
    <link rel='stylesheet' href='/public/styles/site.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="imagem/png" href="/site/public/arquivos/img/logo.png"/>
    <title>Study Home</title>
    
    <script>
      function mudarLogin(){
          var select = frmlogin.login.selectedIndex;
          var value = frmlogin.login.options[select].value;

          if(value == "Escola"){
              document.getElementById('user').placeholder = 'CNPJ';
          } else {
              document.getElementById('user').placeholder = 'Usuário/E-mail';
          }

      }
    </script>
</head>

<?php 
    include './corpo.php';
?>

<body onload="mudarLogin()">

<div class="principal">
  <div class="logo">
    <img class="rounded mx-auto d-block" src="/public/arquivos/img/logo_maior.png" width="260px">

    <h1>Study Home</h1>
    <h2>Plataforma para tarefas e estudos online</h2>

    <div class="form">
      <form name="frmlogin" id="frmlogin" action="../conexao/logar.php" method="POST">
        <select class="select" name="login" onchange="mudarLogin()">
            <option value="Aluno">Aluno</option>
            <option value="Professor">Professor</option>
            <option value="Escola">Escola</option>
        </select>

        <input class="usersenha" type="text" name="user" id="user" placeholder="Usuário/E-mail">
        <input class="usersenha" type="password" name="senha" id="senha">
        <br>
        <input class="botaoentrar" type="submit" value="entrar">
      </form>
    </div>
  </div>

  <div class="line"></div>
  <p class="text-center">© 2022 Copyright: Study Home</p>
</div>

</body>
</html>