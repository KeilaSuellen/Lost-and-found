<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require 'includes/bd.php';


$stmt = $pdo->query("SELECT * FROM objetos ORDER BY CAST(SUBSTRING_INDEX(id_objeto, '/', 1) AS UNSIGNED) ASC");
$objetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

//titulo da página
$titulo = "Painel de Objetos";
?>
<?php include 'includes/header.php' ?>
<?php include 'views/painelobjeto_content.php' ?>

