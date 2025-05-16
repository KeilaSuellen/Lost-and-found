<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require 'includes/bd.php';

$stmt = $pdo->query("SELECT * FROM objetos ORDER BY data_cadastro DESC");
$objetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

//titulo da página
$titulo = "Objetos Cadastrados";
?>
<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>
<?php include 'views/objeto_content.php' ?>
<?php include 'includes/script.php' ?>

