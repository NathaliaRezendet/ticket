<?php
session_start();

if (!isset($_SESSION['id_supervisor'])) {
    header('location: index.php?msg=erro');
    exit;
}

?>
