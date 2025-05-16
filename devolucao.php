<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$titulo = "Devolução de Objetos";

include 'includes/header.php';
include 'views/devolucao_content.php';
include 'includes/script.php';
