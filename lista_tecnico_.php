<?php
include("conn.php");
include("menu.php");

// Consulta SQL com JOIN
$query = "SELECT t.id, t.nome, a.nota_total
          FROM tbltecnicos t
          LEFT JOIN tblavaliacao a ON t.id = a.id_tecnico
          ORDER BY a.nota_total ASC, t.nome ASC";



$result = $conn->query($query);
$tecnicos = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sistema Avaliativo</title>
   <!-- bootstrap -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <!-- css -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container" style="margin-top: 40px;">
        <ul class="list-group">
            <?php foreach ($tecnicos as $tecnico) : ?>
                <li class="list-group-item d-flex flex-column align-items-center text-center" style="margin-top: 10px; font-size: 18pt; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold; margin-left: 100px;">
                <div>
                        <?php echo $tecnico['nome']; ?>
                        <!-- adicionando campo nota -->
                        <span class="badge badge-secondary"><?php echo $tecnico['nota_total']; ?></span>
                </div>

                    <!-- Adicionando botões -->
                <div class="btn-group mt-2">
                        <!-- Botão para avaliar o técnico -->
                        <a href="avaliacao_tecnico_<?php echo $tecnico['id']; ?>.php" class="btn btn-info">Avalie o Técnico</a>

                        <a href="avaliacao_tecnico_<?php echo $tecnico['id']; ?>.php" class="btn btn-warning">Aqui Entra outra Tela</a>
                        <!-- Botão para excluir o técnico (falta criar 'arquivo_excluir.php') -->
                        <a href="#" class="btn btn-danger" onclick="confirmarExclusao(<?php echo $tecnico['id']; ?>)">Excluir</a>
                </div>
            </li>
         <?php endforeach ?>
     </ul>
</div>

    <script>
        function confirmarExclusao(id) {
            // Aqui você pode adicionar a lógica para confirmar a exclusão
            if (confirm("Deseja realmente excluir o técnico?")) {
                // Adicione a lógica de exclusão aqui
                // Por exemplo, redirecione para a página de exclusão passando o ID como parâmetro
                window.location.href = 'arquivo_excluir.php?id=' + id;
            }
        }
    </script>
</body>


<script>
function confirmarExclusao(idTecnico) {
    var confirmacao = confirm("Deseja realmente excluir este técnico?");
    if (confirmacao) {
        window.location.href = "deleta_tecnico.php?id=" + idTecnico;
    }
}
</script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd
