<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require 'includes/bd.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido.");
}

$stmt = $pdo->prepare("SELECT * FROM objetos WHERE id = ?");
$stmt->execute([$id]);
$objeto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$objeto) {
    die("Objeto não encontrado.");
}

$titulo = "Detalhes do Objeto";
?>
<?php include 'includes/header.php' ?>
<?php include 'views/edita_content.php' ?>