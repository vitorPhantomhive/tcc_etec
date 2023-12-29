<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entre em contato</title>

    <link rel="stylesheet" href="/site/public/styles/ajuda.css">
</head>
<body style="background: #E5E5E5;">
<div class="container">  
  <form id="contact" action="https://formsubmit.co/vitorhunter27@gmail.com" method="POST">
    <h3>Contato Study Home</h3>
    <h4>Contato para suporte</h4>
    <fieldset>
      <input class="inputs"  placeholder="Nome completo" type="text" name ="nome"tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input class="inputs" placeholder="Seu e-mail" type="email" name ="email"tabindex="2" required>
    </fieldset>
    <fieldset>
      <textarea class="inputs" name="message" placeholder="Diga o motivo de sua solicitação" tabindex="5" required></textarea>
    </fieldset>
    <fieldset>

    <input type="hidden" name="_next" value="http://localhost/site/obrigado.html">

      <button type="submit">Enviar</button>
    </fieldset>
  </form>
</div>
</body>