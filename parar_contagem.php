<?php
include("conn.php");
include("menu.php");

// Verifica se o id_supervisor está definido na sessão e se o id do técnico foi passado via GET
if(isset($_SESSION['id_supervisor']) && isset($_GET['id'])) {
    if(isset($_POST['btnParar'])) {
        $id_supervisor = $_SESSION['id_supervisor'];
        $id_tecnico = $_GET['id'];
        // Verifica se a contagem para este técnico já foi iniciada
        $query_check = "SELECT * FROM tbl_entradas WHERE id_tecnico = :id_tecnico AND horaFinal IS NULL";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bindParam(':id_tecnico', $id_tecnico);
        $stmt_check->execute();
        $contagem_finalizada = $stmt_check->rowCount() > 0;

        if (!$contagem_finalizada) {
            // Salva a hora atual como hora inicial no banco de dados para o técnico
            $query_insert = "INSERT INTO tbl_entradas (horaFinal, id_tecnico, id_supervisor) VALUES (NOW(), :id_tecnico, :id_supervisor)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bindParam(':id_tecnico', $id_tecnico);
            $stmt_insert->bindParam(':id_supervisor', $id_supervisor);
            $stmt_insert->execute();

            // Insere o ticket na tabela tbl_ticket
            $query_ticket = "INSERT INTO tbl_ticket (horaFinal, horaFinal2, horaFinal3, id_supervisor) VALUES (NOW(), NOW(), NOW(), :id_supervisor)";
            $stmt_ticket = $conn->prepare($query_ticket);
            $stmt_ticket->execute();
        } else {
            echo "";
        }
    }
} else {
    echo "ID do supervisor ou ID do técnico não definidos.";
}
?>