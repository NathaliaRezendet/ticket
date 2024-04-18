<?php
session_start();

include("conn.php");
include("menu.php");

// Ticket aleatório de 5 dígitos
function generateRandomTicket() {
    return rand(10000, 99999);
}

// Função para buscar clientes do banco de dados
function getClientes() {
    global $conn;
    $query = "SELECT id, razao_social FROM tbl_clientes"; // Corrigido o nome do campo
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Busca por clientes
$clientes = getClientes();

// Função para buscar funcionários do banco de dados
function getAtendentes() {
    global $conn;
    $query = "SELECT id_atendentes, nome_atendentes FROM tbl_atendentes";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$atendentes = getAtendentes();

// Função para buscar tipos do banco de dados
function getTipo() {
    global $conn;
    $query = "SELECT id_tipo, nome_tipo FROM tbl_tipo";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$tipos = getTipo();

$numTicket = null; 

if(isset($_POST['btnIniciar'])) {
    $horaIni = date('Y-m-d H:i:s');
    $id_supervisor = isset($_SESSION['id_supervisor'])? $_SESSION['id_supervisor'] : null;

    if($id_supervisor) {
        $numTicket = generateRandomTicket(); // Define $numTicket aqui
        $manualTicket = isset($_POST['manualTicket'])? $_POST['manualTicket'] : null;
        $solicitante = isset($_POST['solicitante'])? $_POST['solicitante'] : null;
        $tipo = isset($_POST['tipo'])? $_POST['tipo'] : null;
        $tipo_problema = isset($_POST['tipo_problema'])? $_POST['tipo_problema'] : null;
        $solucao = isset($_POST['solucao'])? $_POST['solucao'] : null;
        $observacao = isset($_POST['observacao'])? $_POST['observacao'] : null;
        $nome_cliente = isset($_POST['nome_cliente'])? $_POST['nome_cliente'] : null; // Salvar o ID do cliente selecionado

        if(isset($_POST['contagem'])) {
            switch($_POST['contagem']) {
                case 1:
                    $nome_cliente = isset($_POST['nome_cliente'])? $_POST['nome_cliente'] : null; // Corrigir nome do campo
                    $query = "INSERT INTO tbl_ticket (numTicket, manualTicket, solicitante, id_supervisor, horaIni, observacao, tipo, solucao, tipo_problema, nome_cliente, manual_ticket_2) VALUES (:numTicket, :manualTicket, :solicitante, :id_supervisor, :horaIni, :observacao, :tipo, :solucao, :tipo_problema, :nome_cliente, :manual_ticket_2)"; // Adicionado :nome_cliente
                    break;
                case 2:
                    $manual_ticket_2 = isset($_POST['manual_ticket_2'])? $_POST['manual_ticket_2'] : null;
                    $query = "UPDATE tbl_ticket SET manual_ticket_2 = :manual_ticket_2 WHERE numTicket = :numTicket";
                    break;
                default:
                    echo "Contagem inválida.";
                    break;
            }
        
            try {
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':horaIni', $horaIni);
                $stmt->bindParam(':id_supervisor', $id_supervisor);
                $stmt->bindParam(':numTicket', $numTicket);
                $stmt->bindParam(':manualTicket', $manualTicket);
                $stmt->bindParam(':manual_ticket_2', $manual_ticket_2);
                $stmt->bindParam(':observacao', $observacao);
                $stmt->bindParam(':solicitante', $solicitante);
                $stmt->bindParam(':tipo', $tipo);
                $stmt->bindParam(':tipo_problema', $tipo_problema);
                $stmt->bindParam(':solucao', $solucao);
                $stmt->bindParam(':nome_cliente', $nome_cliente);
                

                $stmt->execute();
                echo "Contagem iniciada com sucesso.";
            } catch(PDOException $e) {
                echo "Erro ao iniciar a contagem: ". $e->getMessage();
            }
        } else {
            echo "Contagem não especificada.";
        }
    }
}        

if(isset($_POST['btnIniciar2'])) {
    $manual_ticket_2 = isset($_POST['manual_ticket_2'])? $_POST['manual_ticket_2'] : null;

    $query = "UPDATE tbl_ticket SET manual_ticket_2 = :manual_ticket_2 WHERE numTicket = :numTicket";

    try {
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':manual_ticket_2', $manual_ticket_2);
        $stmt->execute();
        echo "Manual ticket 2 atualizado com sucesso.";
    } catch(PDOException $e) {
        echo "Erro ao atualizar manual ticket 2: ". $e->getMessage();
    }
}


if(isset($_POST['btnParar'])) {
    $horaFinal = date('Y-m-d H:i:s');

    if(isset($_POST['numTicket'])) {
        $numTicket = $_POST['numTicket'];
        if(isset($_POST['contagem-parar'])) {
            switch($_POST['contagem-parar']) {
                case 1:
                    $query = "UPDATE tbl_ticket SET horaFinal = :horaFinal WHERE numTicket = :numTicket";
                    break;
                default:
                    echo "Contagem inválida.";
                    break;
            }

            try {
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':horaFinal', $horaFinal);
                $stmt->bindParam(':numTicket', $numTicket);
                $stmt->execute();

                unset($numTicket);
                unset($horaIni);
                echo "Contagem parada com sucesso.";
            } catch(PDOException $e) {
                echo "Erro ao parar a contagem: ". $e->getMessage();
            }
        } else {
            echo "Contagem para parar não especificada.";
        }
    } else {
        echo "Número de ticket não especificado.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <!-- Formulário 1 -->
        <div class="geral">
            <p class="mt-3">Clique no botão abaixo para iniciar a contagem:</p>
            <p class="tarefa1">Iniciar tarefa 1?</p>

            <form method="post">
                <div class="ticket"> 
                    <label for="ticket">Ticket:</label>
                    <input class="ticket-control" type="text" name="manualTicket">
                </div>

                <div class="solicitante">
                    <label for="solicitante">Solicitante:</label>
                    <select class="form-control" id="$atendente" name="solicitante">
                        <?php foreach ($atendentes as $atendente) { ?>
                            <option value="<?php echo $atendente['id_atendentes']; ?>"><?php echo $atendente['nome_atendentes']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="tipo">
                    <label for="tipo">Tipo:</label>
                    <select class="form-control" id="$tipo" name="tipo">
                        <?php foreach ($tipos as $tipo) { ?>
                            <option value="<?php echo $tipo['id_tipo']; ?>"><?php echo $tipo['nome_tipo']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="tipo-de-problema">
                    <label for="assunto1">Tipo de Problema:</label>
                    <select class="form-control" id="assunto1" name="tipo_problema" onchange="mostrarFiltroCliente()">
                        <option value="flap">Flap</option>
                        <option value="oscilacao">Oscilação</option>
                        <option value="camera" id="camera">Câmera</option>
                        <option value="suporte">Suporte</option>
                    </select>
                </div> 

                <div id="filtroCliente" style="display: none;">
                    <label for="filtroCliente">Filtrar Cliente:</label>
                    <input type="text" id="filtroInputCliente" oninput="filtrarClientes()" placeholder="Digite o nome do cliente">
                    <select class="form-control" id="cliente" name="nome_cliente" onchange="salvarNomeCliente()">
                        <?php foreach ($clientes as $cliente) { ?>
                            <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['razao_social']; ?></option>
                        <?php } ?>
                    </select>
                </div>  
                
                
                <div class="solucao">
                    <label for="solucao">Solução:</label>
                    <textarea class="form-control" id="solucao" name="solucao"></textarea>
                </div>

                <div class="observacao">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" id="observacao" name="observacao"></textarea>
                </div>

                <div class="icons">
                    <button type="submit" class="btn-contagem" name="btnIniciar" value="1"><img class="play" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAAAsTAAALEwEAmpwYAAACDklEQVR4nO2YPU/bUBSGo5IhMDedi2Dhl3SJFAnxG9oUWR27AANh61qp/6BEhLGZOrdNoBIfpSkL7VZaiJRGYkmk2A864qii1HF8c6/tDLzSXWz5+pHPue85x7ncvTISsAhUgQbQBNrAD11tvSb3NoGFtKDygAd8BDrE16U+swrMJAW3AhwBAybXQPdYdgk2B9SBHu7UA3aAWVu4R8BnIMC9AmAPKNrAfSF5HRtDaljly6WlfaBgAlhPKKyjJO+qm5xWlwcirv4A5Tg+JzaQlQ4jfVKNNJbP+a+fEPw8cQ0o765EAYrbx9LQyzN8UcCvVeBKCoUzfYiqrR0jQE/XyyLB+1cwtCkyf3UBzIcBbpns8g+gp6u6RHCw6wJyPQywYQ3o3SwH+fkuDLDlCnBon5+fwgC/OQX0rPKzHQZ4lgigN1F+nmUDeNKwApz6EDen/ZA0nNrM+Vdc28ymNWDVKM+itBYGuKDTV9al7jfw+D/AqW8WbrVb/Ti7+G9K8OsUx5IQPMuNkjSLGTesB2MHexmqtf1OW12gFAl3C1KGaj9FOB/YjgWngLM6VKelltHYqZBFHaqT1jHw0AjuDuReQjOyr19usl8fd8Jdc3xwusBb47COAS3r3GpTLvpqJfFO6wSQ4pPPxe11+jIpX/LMU+BBInAhsPPAhnQe0h7pb9/vutp6Te6tj6yt98olr2tgXtNiNcp/gwAAAABJRU5ErkJggg=="></button>
                    <input type="hidden" name="contagem" value="1">
                    <input type="hidden" name="numTicket" value="<?php echo $numTicket; ?>">
                    <input type="hidden" name="contagem-parar" value="1">
                    <button type="submit" class="btn-contagem" name="btnParar"><img class="pause" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAAAsTAAALEwEAmpwYAAABuklEQVR4nO2Y20oCURSGpbzIrrPrxJ4kJHqCDta9oL1SYeF9pxcxrBAsMaMX0BlBEr7YsISy7Zz3zA78YW5mNjMf87PX2v/K5VbKSMAu0AAegDfABWZyOXLvHqgD5bSg8sAp8ARMBMpPrqztAFVg3RTcAfAJjIiuEfAB7CcJtgm0xLak5ADXQCEu3DbQFYuSlgu8AMU4cENgijlN5RvFKLZ2DcPNNZU/uREGsGXIVi+7m2F2a5IbIqjUNytB6pwqJVlp6FkngTNg7PeW2Xn+1xV33UKdPPYCVNWeDAGVHr1668QCwAlQ0gE2AvZW04AuUNMBqlMJFgAq3eoA+9gD2NMBOhYBjnWAM4sAv/4loGO7xX3bN8mdRYA3OsC6JYXaWVaoyxa1up0/gBYdFtpaOAGsBomVho9bh16A65Jbs9LAN9irUJ3hkX/PE+4H5FXKkC5wGQhOAAsSBdOKnZ1QsVMgiykF93dgKxTcAuRz0AIeUq78uWijjwW7mwaGRxehbfUBrYjlccdvg8C7NQKkqpMnKhqGGGA6srYNHAFrRuA0sCXV1FXAAV4FZD4CVuG/J89qS3vrSjnz+gaX1L1KDHaILQAAAABJRU5ErkJggg=="></button>
                </div>
            </form>
        </div>

        <!-- Formulário 2 -->
        <div class="geral">
            <p class="mt-3">Clique no botão abaixo para iniciar a contagem:</p>
            <p class="tarefa1">Iniciar tarefa 2?</p>
            <form method="post">
                <div class="ticket"> 
                    <label for="ticket">Ticket:</label>
                    <input class="ticket-control" type="text" name="manual_ticket_2">
                </div>

                <div class="icons">
                    <button type="submit" class="btn-contagem" name="btnIniciar2" value="1"><img class="play" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAAAsTAAALEwEAmpwYAAACDklEQVR4nO2YPU/bUBSGo5IhMDedi2Dhl3SJFAnxG9oUWR27AANh61qp/6BEhLGZOrdNoBIfpSkL7VZaiJRGYkmk2A864qii1HF8c6/tDLzSXWz5+pHPue85x7ncvTISsAhUgQbQBNrAD11tvSb3NoGFtKDygAd8BDrE16U+swrMJAW3AhwBAybXQPdYdgk2B9SBHu7UA3aAWVu4R8BnIMC9AmAPKNrAfSF5HRtDaljly6WlfaBgAlhPKKyjJO+qm5xWlwcirv4A5Tg+JzaQlQ4jfVKNNJbP+a+fEPw8cQ0o765EAYrbx9LQyzN8UcCvVeBKCoUzfYiqrR0jQE/XyyLB+1cwtCkyf3UBzIcBbpns8g+gp6u6RHCw6wJyPQywYQ3o3SwH+fkuDLDlCnBon5+fwgC/OQX0rPKzHQZ4lgigN1F+nmUDeNKwApz6EDen/ZA0nNrM+Vdc28ymNWDVKM+itBYGuKDTV9al7jfw+D/AqW8WbrVb/Ti7+G9K8OsUx5IQPMuNkjSLGTesB2MHexmqtf1OW12gFAl3C1KGaj9FOB/YjgWngLM6VKelltHYqZBFHaqT1jHw0AjuDuReQjOyr19usl8fd8Jdc3xwusBb47COAS3r3GpTLvpqJfFO6wSQ4pPPxe11+jIpX/LMU+BBInAhsPPAhnQe0h7pb9/vutp6Te6tj6yt98olr2tgXtNiNcp/gwAAAABJRU5ErkJggg=="></button>
                    <input type="hidden" name="contagem" value="1">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- JavaScript para o cronômetro -->
<script>
    function formatarTempo(segundos) {
        var horas = Math.floor(segundos / 3600);
        var minutos = Math.floor((segundos % 3600) / 60);
        var segundos = segundos % 60;
        
        return pad(horas) + ":" + pad(minutos) + ":" + pad(segundos);
    }
    
    function pad(numero) {
        return numero < 10 ? "0" + numero : numero;
    }
    
    function atualizarCronometro1() {
        segundosDecorridos1++;
        document.querySelector(".tempoDecorrido1").innerHTML = formatarTempo(segundosDecorridos1);
    }
    
    var segundosDecorridos1 = 0;
    var cronometroInterval1;

    document.querySelector("button[name='btnIniciar'][value='1']").addEventListener("click", function() {
        var cronometro1 = this.parentNode.querySelector("#cronometro");
        cronometro1.style.display = "block";
        cronometroInterval1 = setInterval(atualizarCronometro1, 1000);
    });

    document.querySelector("form[name='btnParar']").addEventListener("submit", function() {
        clearInterval(cronometroInterval1);
    });
</script>

<script>
    function filtrarClientes() {
        var input, filter, select, option, i;
        input = document.getElementById("filtroInputCliente");
        filter = input.value.toUpperCase();
        select = document.getElementById("cliente");
        option = select.getElementsByTagName("option");
        for (i = 0; i < option.length; i++) {
            if (option[i].text.toUpperCase().indexOf(filter) > -1) {
                option[i].style.display = "";
            } else {
                option[i].style.display = "none";
            }
        }
    }      

    function salvarNomeCliente() {
        var clienteSelecionado = document.getElementById("cliente").value;
        document.getElementById("nomeClienteSelecionado").value = clienteSelecionado;
    }

    function mostrarFiltroCliente() {
        var tipoProblemaSelecionado = document.getElementById("assunto1").value;
        var filtroCliente = document.getElementById("filtroCliente");
        if (tipoProblemaSelecionado === "camera") {
            filtroCliente.style.display = "block";
        } else {
            filtroCliente.style.display = "none";
        }
    }
</script>
</body>
</html>
