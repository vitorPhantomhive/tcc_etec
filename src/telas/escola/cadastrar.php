<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='stylesheet' href='/site/public/styles/cadastro.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script>
        function mostraGrade(){
            var select = fcadastro.selec.selectedIndex;
            var value = fcadastro.selec.options[select].value;

            if(value == "Aluno"){
                document.getElementById('grade[]').style.display = 'none';
                document.getElementById('turma').style.display = 'block';
                document.getElementById('turmaProf[]').style.display = 'none';
                document.getElementById('labelGrade').style.display = 'none';
                document.getElementById('nome').innerHTML = 'Nome Aluno';
                document.getElementById('titulo').innerHTML = 'Cadastro de Aluno';
                document.getElementById('ctrl').style.display = 'none';
            } else {
                document.getElementById('grade[]').style.display = 'block';
                document.getElementById('turma').style.display = 'none';
                document.getElementById('turmaProf[]').style.display = 'block';
                document.getElementById('labelGrade').style.display = 'block';
                document.getElementById('nome').innerHTML = 'Nome Professor';
                document.getElementById('titulo').innerHTML = 'Cadastro de Professor';
                document.getElementById('ctrl').style.display = 'block';
            }

        }
    </script>
    

</head>
<body onload= "mostraGrade()" style="background: #E5E5E5;">

    <center>
    <img src="/site/public/arquivos/img/logo.png">
    <br>
    <h1 id="titulo"></h1>
    <center>

    <br>

    <div class="login">

        <form name="fcadastro" id="fcadastro" action="../../conexao/cadastro.php" method="POST">

            <select class="btn btn-light" name="selec" id="selec" onchange="mostraGrade()">
                <option value="Aluno">Aluno</option>
                <option value="Professor">Professor</option>
            </select>

            <br><br>

            <label id="nome"></label>
            <input class="btn btn-light" type="text" name="user" id="user" required>

            <br><br>

            <label for="email">E-mail</label>
            <input class="btn btn-light" type="email" name="email" id="email" required>

            <br><br>

            <label for="telefone">Telefone</label>
            <input class="btn btn-light" type="text" name="telefone" id="telefone" maxlength="11" minlength="11" required>

            <br><br>

            <label for="cpf">CPF</label>
            <input class="btn btn-light" type="text" name="cpf" id="cpf" maxlength="11" minlength="11" required> 

            <br><br>

            <label id="labelTurma">Turma</label>
            <select class="btn btn-light" style="width:207px;" name="turma" id="turma">
            <optgroup label="1º EM">
                <option value="1">1º Ano A</option>
                <option value="2">1º Ano B</option>
                <option value="3">1º Ano C</option>
            </optgroup>
            <optgroup label="2º EM">
                <option value="4">2º Ano A</option>
                <option value="5">2º Ano B</option>
                <option value="6">2º Ano C</option>
            </optgroup>
            <optgroup label="3º EM">
                <option value="7">3º Ano A</option>
                <option value="8">3º Ano B</option>
                <option value="9">3º Ano C</option>
            </select>
            <select class="btn btn-light" multiple style="width:207px;" name="turmaProf[]" id="turmaProf[]">
            <optgroup label="1º EM">
                <option value="1">1º Ano A</option>
                <option value="2">1º Ano B</option>
                <option value="3">1º Ano C</option>
            </optgroup>
            <optgroup label="2º EM">
                <option value="4">2º Ano A</option>
                <option value="5">2º Ano B</option>
                <option value="6">2º Ano C</option>
            </optgroup>
            <optgroup label="3º EM">
                <option value="7">3º Ano A</option>
                <option value="8">3º Ano B</option>
                <option value="9">3º Ano C</option>
            </optgroup>
            </select>

            <br>

            <label id="labelGrade">grade Curricular</label>
            <select class="btn btn-light" style="width:207px;" multiple name="grade[]" id="grade[]">
            <optgroup label="Matérias">
                <option value="1">Matemática</option>
                <option value="2">História</option>
                <option value="3">Língua Portuguesa</option>
                <option value="4">Língua Inglesa</option>
                <option value="5">Geografia</option>
                <option value="6">Biologia</option>
                <option value="7">Física</option>
                <option value="8">Química</option>
                <option value="9">Artes</option>
                <option value="10">Educação Física</option>
                <option value="11">Filosofia</option>
                <option value="12">Sociologia</option>
            </optgroup>
            </select>      
            
            <br>

            <h6 id="ctrl">CTRL para selecionar mais de uma opção</h6>
            
            <br>

            <input class="btn btn-info" type="submit" value="Cadastrar">
        </form>

    </div>
</body>
</html>