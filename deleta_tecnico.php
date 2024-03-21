<?php
    include('conn.php');

        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $id_tecnico = $_GET['id'];   
        }

try{

    $stmt_del = $conn->prepare('DELETE FROM tblavaliacoes WHERE id_tecnico = :id_tecnico');

    $stmt_del->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
    $stmt_del->execute();

        if ($stmt_del->rowCount() > 0 ){ 
            echo "Tecnico Excluído com sucesso";
            header('location:lista_tecnico.php');
        } else {
            echo "Não há técnico com o ID fornecido";
        }
}catch (PDOException $e){
    echo " Erro ao excluir o técnico:" . $e->getMessage();
}
?>