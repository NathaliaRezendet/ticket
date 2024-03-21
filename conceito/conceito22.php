
    
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Avaliativo</title>

  <!-- css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   <!-- bootstrap -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php 
   include("menu.php"); 
?>
    <div class="container">
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading text-center">Entenda a Avaliação</h4>
  <p> 
  # CONCEITO: Neste item avaliar se técnico testou todos os
produtos identificou a reclamação do cliente efetuo os teste de
velocímetro via CLI, via navegador, ping, tracert para o ip ou
domínio do conteúdo que o cliente relata o problema aplicando
comandos como tracert para um serviço de conteúdo ix.br (Netflix,
facebook, google ...) e IP transito (Mikrotik, sites fora do brasil)
observando os resultados se existe latência fora da normalidade,
coletando informações como ip de origem (IP do cliente via site:
https://www.dialhost.com.br/meuip/), IP de destino (IP do conteúdo
que o cliente está informando exemplo: ping para facebook.com.br
IP [31.13.90.23] esse servidor está na Holanda), após coletar todas
essas evidências não conseguir identificar a possível falha na
comunicação e rotas do cliente efetuar contato com NOC
informando e postando cada teste realizado juntamente com o ID do
cliente e a vlan PPPoE no qual o cliente se conectou e qual ip de
CGNAT o cliente se conectou (essa infomação está no status do
Router -  ONT) após isso observar e efetuar todos os novos testes
solicitados pelo NOC e aplicas as devidas correções. se certificando
que todos os serviços contratados estão em perfeito funcionamento.
Obs: em casos de latência alta e o conteúdo for fora do brasil é
extremamente normal devido a distância física entre as conexões
lembre ao cliente que a internet não é virtual e sim uma malha física
composta por cabos de fibra conectando o mundo através deles.

</div>
<a href="../avaliacao.php">
  <button type="submit" class="btn btn-warning" id="btVoltar">VOLTAR</button>
  </a>
</div></div>
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
<script>
  $(function () {
    $('.dropdown-toggle').dropdown();
  }); 
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </body>
</html>
   
   

 

   