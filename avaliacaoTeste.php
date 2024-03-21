
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Avaliativo</title>

  <!-- bootstrap -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- css -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php
    include('valida-sessao.php');
    include('menu.php');
    include("conn.php");
?>



        <!-- IMAGEM -->
<img src="img/312860882_567125738551129_7490135894950538800_n.png" id="imgplayfibra">
<h2 id="tituloPlay">FORMULÁRIO DE AVALIAÇÃO TÉCNICA</h2>
<h2 id="tituloPlay"></h2>

        <!-- INÍCIO  DO FORMULÁRIO -->
<form action="avaliacaoteste.php" method="post">
    <input type="hidden" name="id_tecnico" value="<?php echo $dados[0]['id']; ?>">
    <tr>
        <th scope="col">1</th>
        <th scope="col">Estava trajando uniforme completo e com crachá visível?</th>
        <th scope="col">
            <input style="width: 80px; text-align: center; height: 37px; border-radius: 5px;" 
                   type="number" name="nota" placeholder="Nota">
        </th>
        <th scope="col">
            <button type="submit" class="btn btn-success">Salvar</button>
        </th>
        <th scope="col">
            <a href="conceito/conceito2.php">
                <button type="button" class="btn btn-info">Leia o Conceito</button>
            </a>
        </th>
    </tr>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>