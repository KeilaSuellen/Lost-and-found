<?php
require 'includes/bd.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: gerenciamento.php");
exit;
