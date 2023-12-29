<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Saindo</title>
</head>
<body>
<?php
  session_start();
  
  $_SESSION["logado"] = false;
  unset($_SESSION["nome"]);
  unset($_SESSION["tipo"]);
  unset($_SESSION["id"]);
  
  header( "refresh:0; url= ../telas/site.php" );
  
 ?>
 
</body>
</html>