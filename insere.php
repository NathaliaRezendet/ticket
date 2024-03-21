<?php
include("conn.php");
session_start();

try {
    $id_supervisor = $_SESSION['id_supervisor'];

    if (isset($_POST['notas'])) {
        $notas = $_POST['notas'];
        $id_tecnicos = $_POST['id_tecnico'];

        // Iterar sobre as índices dos arrays
        $count = count($notas);

        for ($i = 0; $i < $count; $i++) {
            $id_tecnico = $id_tecnicos[$i];
            $nota = $notas[$i];

            // Se o valor da nota for diferente de vazio, faça um INSERT ou um UPDATE no database.
            if ($nota !== "") {
                $stmt_check = $conn->prepare("SELECT id, nota_total FROM tblavaliacao WHERE id_tecnico=:id_tecnico AND id_supervisor=:id_supervisor");
                $stmt_check->bindParam(':id_tecnico', $id_tecnico);
                $stmt_check->bindParam(':id_supervisor', $id_supervisor);
                $stmt_check->execute();

                if ($stmt_check->rowCount() > 0) {
            // Se já existe uma nota para determinado técnico, ATUALIZA!
                    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
                    $nota_total = $result['nota_total'] + $nota;

                    $stmt_update = $conn->prepare('UPDATE tblavaliacao SET nota = :nota, nota_total = :nota_total WHERE id_tecnico = :id_tecnico AND id_supervisor = :id_supervisor');
                    $stmt_update->bindParam(':nota', $nota);
                    $stmt_update->bindParam(':nota_total', $nota_total);
                    $stmt_update->bindParam(':id_tecnico', $id_tecnico);
                    $stmt_update->bindParam(':id_supervisor', $id_supervisor);
                    $stmt_update->execute();
                } else {
            // Se não existe nota para o técnico e a nota não está vazia, INSIRA!
                    $stmt_insert = $conn->prepare("INSERT INTO tblavaliacao (id_tecnico, id_supervisor, nota, nota_total) VALUES (:id_tecnico, :id_supervisor, :nota, :nota_total)");
                    $stmt_insert->bindParam(':id_tecnico', $id_tecnico);
                    $stmt_insert->bindParam(':id_supervisor', $id_supervisor);
                    $stmt_insert->bindParam(':nota', $nota);
                    $stmt_insert->bindParam(':nota_total', $nota_total); // Adicionado o bindParam para nota_total
                    $stmt_insert->execute();
                }

                echo "Avaliação inserida com sucesso para o técnico de ID: $id_tecnico <br>";
                $_SESSION['avaliacao_salva'] =  true;
              header('location:lista_tecnico.php');
              }
        }
    }
} catch (PDOException $e) {
    echo "Erro ao inserir avaliação: " . $e->getMessage();
}


?>
