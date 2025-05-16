<?php
require 'includes/bd.php';

$erro = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmarSenha'] ?? '';
    $nivel = $_POST['nivel'] ?? '';

    // validar senha
    if ($senha !== $confirmarSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        // Verifica se o usuário já existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);

        if ($stmt->rowCount() > 0) {
            $erro = "Usuário já existe.";
        } else {
            // cadastrar o usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, nivel) VALUES (?, ?, ?)");
            $stmt->execute([$usuario, $senha_hash, $nivel]);

            // redireciona para login após cadastro
            header("Location: login.php");
            exit;
        }
    }
}

// Inclui o layout e a view para mostrar o formulário e erros
$conteudo = 'views/cadastro_content.php';
include 'includes/layout_cadastro.php';
?>