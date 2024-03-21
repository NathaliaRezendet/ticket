<?php 
include ("conn.php");

$query = $conn->prepare("SELECT id_tecnico, nome_tecnico FROM tbltecnicos ORDER BY nome_tecnico ASC");
$query->execute();
$tecnicos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sistema Avaliativo</title>

      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-nvaBv9QUjQIo7UlszluBq4lF5FfRfwBQsAxIaY53XrrA01buP5zD1q/Z2e9Q5fOW" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

      <!-- CSS personalizado -->
      <link rel="stylesheet" href="css/style.css">

        <script>
          $(document).ready(function(){
              $('#avaliacaoForm').submit(function(){
                return confirm("Deseja salvar a nota?");
              });
          });
        </script>
  </head>
<body>
    <!-- NAV BAR-->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="lista_tecnico_.php">
            <img src="img/312860882_567125738551129_7490135894950538800_n.png" id="imgplayfibraNav" class="d-inline-block align-top">
            PLAYFIBRA
        </a>

    <form id="selecionaTecnicoForm" class="ml-auto">
      <div class="form-group d-flex">
        <select name="id_tecnico" id="id_tecnico" class="form-control" onchange="redirecionarAvaliacao(); salvarSelecaoAtual()">
            <option value="">Selecione o técnico</option>
                <?php foreach ($tecnicos as $tecnico) : ?>
                  <option value="<?php echo $tecnico['id_tecnico']; ?>"><?php echo $tecnico['nome_tecnico']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- BOTÃO DE SAIR -->
            <input type="submit" value="IR" class="btn btn-primary ml-2">
            <span style="margin-right: 10px;">&nbsp;</span>

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                Sair
            </button>
      </div>  
  </form>

<script>
    function redirecionarAvaliacao() {
        var idTecnico = document.getElementById('id_tecnico').value;
        window.location.href = 'avaliacao_tecnico_' + idTecnico + '.php';
    }
</script>
 </div>    
</form>

         <!--modal para  questionar saída -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tem certeza que deseja sair?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Ao sair, você será desconectado do sistema.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="logout.php" class="btn btn-warning">Sair</a>
      </div>
    </div>
  </div>
</div>
</nav>
<script>
    // Função para carregar a última seleção do dropdown
    function carregarUltimaSelecao() {
        var ultimaSelecao = localStorage.getItem('ultimaSelecao');
        if (ultimaSelecao) {
            document.getElementById('id_tecnico').value = ultimaSelecao;
        }
    }

    // Função para salvar a seleção atual no armazenamento local
    function salvarSelecaoAtual() {
        var idTecnico = document.getElementById('id_tecnico').value;
        localStorage.setItem('ultimaSelecao', idTecnico);
    }
    // Chame a função para carregar a última seleção ao carregar a página
    document.addEventListener('DOMContentLoaded', carregarUltimaSelecao);

    // Adicione um evento de mudança ao dropdown para salvar a seleção atual
    document.getElementById('id_tecnico').addEventListener('change', salvarSelecaoAtual);
</script>

<script>	
    $(function () {
            $('.dropdown-toggle').dropdown();
       }); 
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

