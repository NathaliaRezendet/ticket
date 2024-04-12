<?php
include("conn.php");
include("menu.php");

// Verifica se o id_supervisor está definido na sessão e se o id do técnico foi passado via GET
if(isset($_SESSION['id_supervisor']) && isset($_GET['id'])) {
    if(isset($_POST['iniciar_contagem'])) {
        $id_supervisor = $_SESSION['id_supervisor'];
        $id_tecnico = $_GET['id'];
        // Verifica se a contagem para este técnico já foi iniciada
        $query_check = "SELECT * FROM tbl_entradas WHERE id_tecnico = :id_tecnico AND horaFinal IS NULL";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bindParam(':id_tecnico', $id_tecnico);
        $stmt_check->execute();
        $contagem_iniciada = $stmt_check->rowCount() > 0;

        if (!$contagem_iniciada) {
            // Salva a hora atual como hora inicial no banco de dados para o técnico
            $query_insert = "INSERT INTO tbl_entradas (horaIni, id_tecnico, id_supervisor) VALUES (NOW(), :id_tecnico, :id_supervisor)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bindParam(':id_tecnico', $id_tecnico);
            $stmt_insert->bindParam(':id_supervisor', $id_supervisor);
            $stmt_insert->execute();

            // Gera um número aleatório de 5 dígitos para o numTicket
            $numTicket = mt_rand(10000, 99999);

            // Insere o ticket na tabela tbl_ticket
            $query_ticket = "INSERT INTO tbl_ticket (horaIni, id_supervisor, numTicket, manualTicket) VALUES (NOW(), :id_supervisor, :numTicket, :manualTicket)";
            $stmt_ticket = $conn->prepare($query_ticket);
            $stmt_ticket->bindParam(':id_supervisor', $id_supervisor);
            $stmt_ticket->bindParam(':numTicket', $numTicket);
            $stmt_ticket->bindParam(':manualTicket', $manualTicket);
            $stmt_ticket->execute();
        } else {
            echo "";
        }
    }
} else {
    echo "ID do supervisor ou ID do técnico não definidos.";
}
?>
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
    
    function atualizarCronometro(segundosDecorridos) {
        segundosDecorridos++;
        document.getElementById("tempoDecorrido").innerHTML = formatarTempo(segundosDecorridos);
        setTimeout(function() {
            atualizarCronometro(segundosDecorridos);
        }, 1000);
    }

    // Verifica se a contagem já foi iniciada, se sim, exibe o cronômetro
    <?php if($contagem_iniciada): ?>
        document.getElementById("cronometro").style.display = "block";
        atualizarCronometro(<?php echo $segundosDecorridos; ?>);
    <?php endif; ?>
    
</script>
</body>
</html>
