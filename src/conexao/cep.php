<html>
    <head>
    <title>TESTE CEP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script>
    
    function limpa_formulário_cep() {
        document.getElementById('rua').value=("");
        document.getElementById('bairro').value=("");
        document.getElementById('cidade').value=("");
        document.getElementById('uf').value=("");
    }

    function insere_valor(conteudo) {
        if (!("end" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        }
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        var cep = valor.replace(/\D/g, '');

        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com a função insere_valor.
                script.src = `https://viacep.com.br/ws/${cep}/json/?callback=insere_valor`;

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            }
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        }
        else {
            //cep sem valor
            limpa_formulário_cep();
        }
    };

    </script>
    </head>

    <body>
      <form method="get" action=".">
        <label>Cep:
            <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);"/>
        </label>
               
        <br/>

        <label>Rua:
            <input name="rua" type="text" id="rua" size="60"/>
        </label>
        
        <br/>

        <label>Bairro:
            <input name="bairro" type="text" id="bairro" size="40"/>
        </label>
        
        <br/>

        <label>Cidade:
            <input name="cidade" type="text" id="cidade" size="40"/>
        </label>
        
        <br/>

        <label>Estado:
            <input name="uf" type="text" id="uf" size="2"/>
        </label>

      </form>
    </body>

    </html>