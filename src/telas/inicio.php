<head>
    <meta charset="UTF-8">
    <title>Inicio</title>

    <link rel='stylesheet' href='/site/public/styles/inicio.css'>
    <script src="https://kit.fontawesome.com/becb71d002.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='/site/public/styles/site.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<?php 
    include './corpo.php';

    $img = '../../public/arquivos/img/'.$_SESSION["id"];

    if(!file_exists($img)){
        $img = '../../public/arquivos/img/icon.png';
    }
?>

<body>

<div class="principal">

    <div class="menu">
        <?php echo '<image class="img" src="'.$img.'">'?>
        <?php echo '<h5 class="perfil">Olá, ' . $_SESSION["nome"] . '</h5>'?>

        <div class="line"></div>

        <a href="./tarefas.php" target="Caixa" class="tarefas"><i class="fa-solid fa-sliders icons"></i>Tarefas</a>
        
        <a href="./atualidades.php" target="Caixa" class="atualidades"><i class="fa-solid fa-user-graduate icons"></i>Atualidades</a>

        <a href="./calendario.html" target="Caixa" class="calendario"><i class="fa-solid fa-calendar-days icons"></i>Calendário</a>

        <a href="./config.php" target="Caixa"><button class="config">Configurações</a>

        <a href="./help.php" target="Caixa"><button class="contato">Contate-nos</button></a>

        <a href="../conexao/sair.php"><button class="sair">Sair</button></a>
    </div>
    
    <div class="iframe">
        <iframe class="formataiframe" src="./tarefas.php" name="Caixa"></iframe>
    </div>
    
</div>

</body>
</html>